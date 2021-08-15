<?php
include "sesion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login "TerraFertil"</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="estilo/css/style.css" th:href="@{/css/style.css}">
    
</head>

<body class="body">

    <div class="modal-dialog text-center">
    
        <div class="col-sm-8 main-section">
            <div class="modal-content">
          
                <div class="col-12 user-img">
                    <img src="sistema/img/userlogin.png" th:src="@{/img/userlogin.png}"/>
                </div>

                <form class="col-12" action="" method="post">

                <div class="form-group" id="user-group">
                    <input type="usuario" class="form-control" placeholder="Nombre de Usuario" name="user" required maxlength="50"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                    <input type="password" class="form-control" placeholder="Contrasena" name="password" maxlength="10" required />
                    </div>
                  
                     <input type="hidden" value="login" name="opcion">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Ingresar </button>

                </form>
             
                <?php echo isset($alert) ? $alert : ''; ?>

            </div>
           
        </div>
        
    </div>

</body>
</html>
