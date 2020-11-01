<?php

require_once "./session.php";

//PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//////////////////////////////////////////////////////////////

//HANDLE NEW NOTE AJAX REQUEST
if (isset($_POST['action']) && $_POST['action'] == "add_note") {
    $title = $cuser->test_input($_POST['title']);
    $note = $cuser->test_input($_POST['note']);

    //ingresar en la BD la nota
    $cuser->add_new_note($cid, $title, $note);
    //añadir una notificación
    $cuser->notification($cid, "admin", "New Note added");
}

//HANDLE DISPLAY ALL NOTES OF AN USER. Recorrer las notas del usuario
if (isset($_POST['action']) && $_POST['action'] == "display_notes") {
    $output = '';
    $notes = $cuser->get_notes($cid);
    $iter = 1;

    if ($notes) {
        $output .= '<table class="table table-striped table-hover table-sm text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($notes as $row) {
            $output .= '<tr>
            <td>' . $iter . '</td>
            <td>' . $row["title"] . '</td>
            <td>' . substr($row["note"], 0, 75) . '...</td>
            <td>
                <a href="#" id="' . $row["id"] . '" title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;

                <a href="#" id="' . $row["id"] . '" title="Edit Note" class="text-warning editBtn" data-toggle="modal" data-target="#editNoteModal"><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                <a href="#" id="' . $row["id"] . '" title="Delete Note" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td>
        </tr>';
            $iter++;
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">:( You have not written any note yet! Write your first note now.</h3>';
    }
}

//Editar nota del usuario
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];

    $row = $cuser->edit_note($id);
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == "update_note") {
    $id = $cuser->test_input($_POST['id']);
    $title = $cuser->test_input($_POST['title']);
    $note = $cuser->test_input($_POST['note']);

    $cuser->update_note($id, $title, $note);
    //agregar notificación
    $cuser->notification($cid, "admin", "Note updated");
}

//Delete Note of an user Ajax Request
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $cuser->delete_note($id);
    //agregar notificación de eliminar note
    $cuser->notification($cid, "admin", "Note deleted");
}

//mostrar info de la nota del user Ajax request
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];
    $row = $cuser->edit_note($id);
    echo json_encode($row);
}

//Handle Profile update ajax request
if (isset($_FILES['image'])) {
    $name = $cuser->test_input($_POST['name']);
    $gender = $cuser->test_input($_POST['gender']);
    $dob = $cuser->test_input($_POST['dob']);
    $phone = $cuser->test_input($_POST['phone']);

    $oldImage = $_POST['oldimage'];
    $folder = "uploads/";

    if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
        $newImage = $folder . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

        // $newImage = $folder.basename($_FILES['image']['name']);
        // $uploadOK = 1;
        // $imgFileType = strtolower(pathinfo($newImage,PATHINFO_EXTENSION));

        // if(isset($_POST['submit'])){
        //     $check = getimagesize($_FILES['image']['tmp_name']);
        //     if($check !== false){
        //         print_r($check);
        //         echo 'File is an image - '.$check['mime'];
        //         $uploadOK = 1;
        //     }else{
        //         echo "File is not an image";
        //         $uploadOK = 0;
        //     }
        // }

        // //validar si el archivo ya existe
        // if(file_exists($newImage)){
        //     echo "Sorry, file already exists.";
        //     $uploadOK = 0;
        // }

        // //validar el tamaño de la img, menor a 500KB
        // if($_FILES['image']['size'] > 5000000){
        //     echo 'Sorry, el archivo es muy grande.';
        //     $uploadOK = 0;
        // }

        // if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg"
        // && $imgFileType != "gif" ){
        //     echo 'Sorry, sólo es válido JPG,PNG,JPEG,GIF.';
        //     $uploadOK = 0;
        // }

        // if ($uploadOK == 0) {
        //     echo "Sorry, your file was not uploaded.no se sube.";
        //   // if everything is ok, try to upload file
        //   } else {
        //     if (move_uploaded_file($_FILES["image"]["tmp_name"], $newImage)) {
        //       echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        //     } else {
        //       echo "Sorry, there was an error uploading your file.";
        //     }
        //   }

        if ($oldImage != null) {
            unlink($oldImage);
        }
    } else {
        $newImage = $oldImage;
    }
    $cuser->update_profile($name, $gender, $dob, $phone, $newImage, $cid);
    //agregar notificación de actualización de perfil
    $cuser->notification($cid, "admin", "Profile updated");
}

if (isset($_POST['action']) && $_POST['action'] == "change_pass") {
    $currentPass = $_POST['curpass'];
    $newPass = $_POST['newpass'];
    $cnewPass = $_POST['cnewpass'];

    $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

    if ($newPass != $cnewPass) {
        echo $cuser->showMessage("danger", "Password did not matched!");
    } else {
        if (password_verify($currentPass, $cpass)) {
            $cuser->change_password($hnewPass, $cid);
            echo $cuser->showMessage("success", "Password Changed Successfully!");
            //agregar notificación
            $cuser->notification($cid, "admin", "Password changed");
        } else {
            echo $cuser->showMessage("danger", "Current Password is wrong!");
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "verify_email") {

    //enviar el email
    try {
        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = Database::USER_EMAIL;
        $mail->Password = Database::PASSWORD_EMAIL;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        // $mail->setFrom(Database::USER_EMAIL,'Project Admin by ACD6');
        $mail->From = Database::USER_EMAIL;
        $mail->FromName = "Admin Project by ACD6";
        $mail->addAddress($cemail);

        $mail->isHTML(true);
        $mail->Subject = "E-Mail Verification";
        $mail->Body = "<h3>Click the below link to verify your E-Mail.<br><a href='http://localhost/user-system/verify-email.php?email=" . $cemail . "'>http://localhost/user-system/verify-email.php?email=" . $cemail . "</a><br>Regards<br>USER SYSTEM BY ACD6</h3>";

        $mail->send();
        echo $cuser->showMessage("success", "Verification link sent to your E-Mail. Please check your mail.");
    } catch (Exception $e) {
        echo $cuser->showMessage("danger", "Something went wrong, please try again later!");
    }
}

//send feedback al admin ajax request
if (isset($_POST['action']) && $_POST['action'] == "feedback") {
    $subject = $cuser->test_input($_POST['subject']);
    $feedback = $cuser->test_input($_POST['feedback']);

    $cuser->send_feedback($subject, $feedback, $cid);
    //agregar notificación
    $cuser->notification($cid, "admin", "Feedback written");
}

//handle fetch notification
if (isset($_POST['action']) && $_POST['action'] == "fetchNotification") {

    $notification = $cuser->fetchNotification($cid);
    $output = '';

    if ($notification) {
        foreach ($notification as $row) {
            $output .= '<div class="alert alert-danger" role="alert">
            <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">New Notification</h4>
            <p class="mb-0 lead">'.$row['message'].'</p>
            <hr class="my-2">
            <p class="mb-0 float-left">Reply of feedback from Admin</p>
            <p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
            <div class="clearfix"></div>
        </div>';
        }
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary mt-5">No any new notification</h3>';
    }
}

//CHECK NOTIFICATION. Añade un círculo al lado de la pestaña Notifications (en el header) cuando el usuario tiene notificaciones
if(isset($_POST['action']) && $_POST['action'] == "checkNotification"){
    if($cuser->fetchNotification($cid)){
        echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }else{
        echo '';
    }
}

//remove notification
if(isset($_POST['notification_id'])){
    $id = $_POST['notification_id'];
    $cuser->removeNotification($id);
}
