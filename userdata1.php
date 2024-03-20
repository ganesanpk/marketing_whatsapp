<?php
// Database connection
include "database.php";


try {
    // Create connection
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])){
        // File upload path
        $targetDir = "uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats (Excel)
        $allowedTypes = array('xls','xlsx');
        if(in_array($fileType, $allowedTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Load Excel file
                require './vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
                $objPHPExcel = PHPExcel_IOFactory::load($targetFilePath);
                $sheet = $objPHPExcel->getActiveSheet();
                $highestRow = $sheet->getHighestDataRow();

                // Prepare statement to insert data
                $stmt = $conn->prepare("INSERT INTO bulk_user (username, email, mobile, address) VALUES (:username, :email, :mobile, :address)");

                // Initialize array to store duplicates
                $duplicates = array();

                // Iterate through each row in Excel file
                for ($row = 2; $row <= $highestRow; $row++) {
                    $username = $sheet->getCellByColumnAndRow(0, $row)->getValue();
                    $email = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mobile = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                    $address = $sheet->getCellByColumnAndRow(3, $row)->getValue();

                    // Check if mobile number already exists
                    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM bulk_user WHERE mobile = :mobile");
                    $checkStmt->bindParam(':mobile', $mobile);
                    $checkStmt->execute();
                    $count = $checkStmt->fetchColumn();

                    // If mobile number does not exist, insert the data
                    if ($count == 0) {
                        $stmt->bindParam(':username', $username);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':mobile', $mobile);
                        $stmt->bindParam(':address', $address);
                        $stmt->execute();
                    } else {
                        // If mobile number exists, add to duplicates array
                        $duplicates[] = array($username, $email, $mobile, $address);
                    }
                }

                // Generate Excel file for duplicates
                if (!empty($duplicates)) {
                    $duplicateFileName = 'duplicate_' . time() . '.xlsx';
                    $duplicateFilePath = 'uploads/' . $duplicateFileName;
                    $duplicateExcel = new PHPExcel();
                    $sheet = $duplicateExcel->getActiveSheet();
                    $sheet->fromArray($duplicates);
                    $objWriter = PHPExcel_IOFactory::createWriter($duplicateExcel, 'Excel2007');
                    $objWriter->save($duplicateFilePath);
                    echo "<a href='$duplicateFilePath'>Download Duplicates Excel File</a><br>";
                }

                echo "File uploaded and data inserted successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format. Please upload a valid Excel file.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
