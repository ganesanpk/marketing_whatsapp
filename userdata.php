<?php
// Database connection
include "database.php";
try {
    // Create PDO connection
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // // Set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])){
        // File upload path
        $targetDir = "uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = array('xls', 'xlsx');
        if(in_array($fileType, $allowedTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Load Excel file
                require 'vendor/autoload.php'; // Include PhpSpreadsheet autoload.php file
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFilePath);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                // Prepare and execute SQL insert statements
                $stmt = $conn->prepare("INSERT INTO bulk_user (username, mobile, address) VALUES (:username, :mobile, :address)");
                foreach ($sheetData as $row) {
                    $stmt->bindParam(':username', $row['A']);                    
                    $stmt->bindParam(':mobile', $row['B']);
                    $stmt->bindParam(':address', $row['C']);
                    $stmt->execute();
                }
                echo "File uploaded and data inserted successfully.";
            } else{
                echo "Error uploading file.";
            }
        } else{
            echo "Invalid file format. Please upload a valid Excel file.";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close connection
$conn = null;
?>
