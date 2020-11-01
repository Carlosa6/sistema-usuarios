<?php

//BD
require_once "assets/php/config.php";

if (isset($_POST['submit'])) {
    $file = $_FILES['fileUpload'];
    
    $fileName = $_FILES['fileUpload']['name'];
    $fileType = $_FILES['fileUpload']['type'];
    $fileTmpName = $_FILES['fileUpload']['tmp_name'];
    $fileError = $_FILES['fileUpload']['error'];
    $fileSize = $_FILES['fileUpload']['size'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','png','jpeg','gif');

    if(in_array($fileActualExt,$allowed)){
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                //renombrar el nombre de la img
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                print_r($_FILES);
                echo "File uploaded successfully";
            } else {
                echo "El archivo es muy grande, intenta subir otro";
            }
            
        } else {
            echo "Hubo un error al subir el archivo";
        }
        
    }else{
        echo "No se puede subir archivos de ese tipo";
    }

    // $folder = "uploads/";
    // $newImg = $folder . basename($_FILES['fileUpload']['name']);
    // // Get file extension
    // $imageExt = strtolower(pathinfo($newImg, PATHINFO_EXTENSION));

    // // Allowed file types
    // $allowd_file_ext = array("jpg", "jpeg", "png");

    // if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
    //     $resMessage = array(
    //         "status" => "alert-danger",
    //         "message" => "Select image to upload."
    //     );
    // } else if (!in_array($imageExt, $allowd_file_ext)) {
    //     $resMessage = array(
    //         "status" => "alert-danger",
    //         "message" => "Allowed file formats .jpg, .jpeg and .png."
    //     );
    // } else if ($_FILES["fileUpload"]["size"] > 2097152) {
    //     $resMessage = array(
    //         "status" => "alert-danger",
    //         "message" => "File is too large. File size should be less than 2 megabytes."
    //     );
    // } else if (file_exists($newImg)) {
    //     $resMessage = array(
    //         "status" => "alert-danger",
    //         "message" => "File already exists."
    //     );
    // } else {
    //     $tmpname = $_FILES["fileUpload"]["tmp_name"];
    //     if (move_uploaded_file($tmpname, $newImg)) {
    //         $sql = "UPDATE users SET photo=:photo WHERE id=10";
    //         $stmt->$this->conn->prepare($sql);
    //         if ($stmt->execute(['photo' => $newImg])) {
    //             $resMessage = array(
    //                 "status" => "alert-success",
    //                 "message" => "Image uploaded successfully."
    //             );
    //         }
    //     } else {
    //         $resMessage = array(
    //             "status" => "alert-danger",
    //             "message" => "Image coudn't be uploaded."
    //         );
    //     }
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CDN CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
</head>

<body>

    <div class="container p-4 mt-4">
        <h3 class="text-center mb-5">Upload File in PHP 7</h3>
        <div class="user-image mb-3 text-center">
                <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                    <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                </div>
            </div>
        <form action="prueba.php" method="post" enctype="multipart/form-data" class="mb-3">

            <div class="custom-file">
                <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload File
            </button>
        </form>

        <!-- Display response messages -->
        <!-- <?php if (!empty($resMessage)) { ?>
            <div class="alert <?php echo $resMessage['status'] ?>">
                <?php echo $resMessage['message'] ?>
            </div>
        <?php } ?> -->
    </div>

</body>

</html>