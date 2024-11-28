<?php

$target_dir = "uploads/"; // Directory where files will be uploaded
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Initialize an error message variable
$error_message = "";

// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Check if the file is a PDF
    if ($fileType != "pdf") {
        $error_message .= "Sorry, only PDF files are allowed.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $error_message .= "Sorry, the file already exists.<br>";
    $uploadOk = 0;
}

// Check file size (limit to 5MB for example)
if ($_FILES["fileToUpload"]["size"] > 6000000) {
    $error_message .= "Sorry, your file is too large. Maximum allowed size is 6MB.<br>";
    $uploadOk = 0;
}

// Check if the uploads directory exists and is writable
if (!is_dir($target_dir) || !is_writable($target_dir)) {
    $error_message .= "Upload directory does not exist or is not writable.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "File upload failed due to the following reasons:<br>" . $error_message;
} else {
    // Try to upload the file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
    } else {
        // Log the error details for debugging
        error_log("File upload error: " . print_r($_FILES, true), 3, "error.log");
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

// Log detailed errors to the error log
if (!empty($error_message)) {
    error_log("File upload validation error: " . $error_message, 3, "error.log");
}

?>
