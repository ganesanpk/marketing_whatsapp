<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Excel File</title>
</head>
<body>
    <form action="userdata1.php" method="post" enctype="multipart/form-data">
        Select Excel file to upload:
        <input type="file" name="file" required>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>
