s<?php

require_once "admin-db.php";
$admin = new Admin();
session_start();

//ADMIN LOGIN AJAX REQUEST
if(isset($_POST['action']) && $_POST['action'] == "adminLogin"){
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);
    $hpassword = sha1($password);
    $loggedInAdmin = $admin->admin_login($username,$hpassword);

    if($loggedInAdmin != null){
        echo 'admin_login';
        $_SESSION['username'] = $username;
    }else{
        echo $admin->showMessage('danger','Username or Password is incorrect');
    }
}

//LISTADO DE USUARIOS AJAX REQUEST
if(isset($_POST['action']) && $_POST['action'] == "fetchAllUsers"){
    $output = '';
    $data = $admin->fetchAllUsers(0);
    $path = "../assets/php/";
    $num=1;

    if($data){
        $output .= '<table class="table table-striped table-bordered table-hover text-center">
        <thead>
        <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Verified</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($data as $row) {
            // MOSTRAR SI O NO SI EL USUARIO A VERIFICADO SU CUENTA
            if($row['verified'] == 1){
                $verif = '<span class="badge badge-success">Yes</span>';
            }else{
                $verif = '<span class="badge badge-danger">No</span>';
            }
            //SI EL USUARIO SUBIÓ UNA IMAGEN DE PERFIL MOSTRARLA SINO MOSTRAR OTRA IMG
            if($row['photo'] != ''){
                $uphoto = $path.$row['photo'];
            }else{
                $uphoto = "../assets/img/avatar2.png";
            }
            $output .= '<tr>
            <td>'.$num.'</td>
            <td><img src="'.$uphoto.'" alt="'.$row['name'].'" class="rounded-circle" width="40px" /></td>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$verif.'</td>
            <td>
            <a href="#" id="'.$row['id'].'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
            <a href="#" id="'.$row['id'].'" title="Delete User" class="text-warning deleteUserIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td>
            </tr>';
            $num++;
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary">:( No any user registered yet!</h3>';
    }
}

//MOSTRAR DETALLES DEL USUARIO AJAX REQUEST
if(isset($_POST['details_id'])){
    $id = $_POST['details_id'];

    $data = $admin->fetchUserDetailsByID($id);
    echo json_encode($data);
}

//ELIMINAR UN USUARIO AJAX REQUEST
if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $admin->userAction($id,0);
}

//LISTA DE USUARIOS ELIMINADOS
if(isset($_POST['action']) && $_POST['action'] == "fetchAllDeletedUsers"){
    $output = '';
    $data = $admin->fetchAllUsers(1);
    $path = "../assets/php/";
    $num=1;

    if($data){
        $output .= '<table class="table table-striped table-bordered table-hover text-center">
        <thead>
        <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Verified</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($data as $row) {
            // MOSTRAR SI O NO SI EL USUARIO A VERIFICADO SU CUENTA
            if($row['verified'] == 1){
                $verif = '<span class="badge badge-success">Yes</span>';
            }else{
                $verif = '<span class="badge badge-danger">No</span>';
            }
            //SI EL USUARIO SUBIÓ UNA IMAGEN DE PERFIL MOSTRARLA SINO MOSTRAR OTRA IMG
            if($row['photo'] != ''){
                $uphoto = $path.$row['photo'];
            }else{
                $uphoto = "../assets/img/avatar2.png";
            }
            $output .= '<tr>
            <td>'.$num.'</td>
            <td><img src="'.$uphoto.'" alt="'.$row['name'].'" class="rounded-circle" width="40px" /></td>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$verif.'</td>
            <td>
            <a href="#" id="'.$row['id'].'" title="Restore User" class="text-white restoreUserIcon badge badge-dark p-2">Restore</a>
            </td>
            </tr>';
            $num++;
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary">:( No any user deleted yet!</h3>';
    }
}
