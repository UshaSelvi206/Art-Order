<?php
$conn = mysqli_connect("localhost", "root", "Lous@2006", "art_orders");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$type = $_POST['type'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$frameSize = $_POST['frameSize'];
$price = $_POST['price'];
$state = $_POST['state'];
$district = $_POST['district'];
$city = $_POST['city'];
$address = $_POST['address'];

// Handle file upload
$targetDir = "uploads/";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$fileName = time() . "_" . basename($_FILES["fileUpload"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

$allowedTypes = array("jpg","jpeg","png","gif","pdf","doc","docx");

if (in_array($fileType, $allowedTypes)) {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFilePath)) {

        // Save to DB
        $sql = "INSERT INTO orders 
                (form_type, name, email, phone, frameSize, Price, state, district, city, address, filePath, orderDateTime)
                VALUES 
                ('$type', '$name', '$email', '$phone', '$frameSize', '$price', '$state', '$district', '$city', '$address', '$targetFilePath', NOW())";

        if (mysqli_query($conn, $sql)) {
            echo "<h2>✅ Order submitted successfully!</h2>";
        } else {
            echo "❌ Database Error: " . mysqli_error($conn);
        }

    } else {
        echo "❌ File upload failed!";
    }
} else {
    echo "❌ Only JPG, JPEG, PNG, GIF, PDF, DOC, DOCX allowed!";
}

mysqli_close($conn);
?>
