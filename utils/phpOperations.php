<?php
function fileUpload($file, $uploadDir ,$isMultiple=false){
    $fileName = $file["name"];
    $tmpFilePath = $file["tmp_name"];
    // Define the upload directory path
    // $uploadDir = "uploads/profile/";
    // echo ($uploadDir);
    // Generate a unique filename to avoid overwriting existing files
    $uploadedFileName = $_SESSION['id'] . '_' . uniqid() . '.' . pathinfo($fileName)['extension'];
    // print_r($uploadedFileName);
    // print_r($_FILES);
    // Move the uploaded file to the specified directory
    // print_r($_FILES);
    $destination = $uploadDir . $uploadedFileName;
    move_uploaded_file($tmpFilePath, $destination);
    // if (move_uploaded_file($tmpFilePath, $destination)) {
        return $destination;
}
