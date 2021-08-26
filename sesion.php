<?php

$alert = '';
session_start();
if (!empty($_SESSION['activo'])) {
    header('location: sistema/');
    
} else {

    if (!empty($_POST)) {

        if (!empty($_POST['user']) && !empty($_POST['password'])) {
            require_once "conexion.php";

            $user = mysqli_real_escape_string($conection, $_POST['user']); // usuario de la base 
            $password = md5 (mysqli_real_escape_string($conection, $_POST['password'])); //password de la base de 
            
            $query = mysqli_query($conection, "SELECT * FROM usuario  WHERE  user='$user' AND password= '$password' AND estatus=1"); //consulta
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                $_SESSION['activo'] = true;
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['user'] = $data['user'];
                $_SESSION['rol'] = $data['rol'];
                header('location: sistema/');
            
            } else {
                
                $alert = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                El usuario o clave son incorrectos 
                <button style="text-align: right" type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button> </div>';
                session_destroy();
            }

        }

    }
}
?>