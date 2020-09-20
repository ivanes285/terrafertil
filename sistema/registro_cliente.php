
<?php
session_start();
  include "../conexion.php";
  include ("validar.php");
if (!empty($_POST)) {
        $alert = '';
          $cedula=$_POST['cedula'];
          $nombre=$_POST['nombre'];
          $apellido=$_POST['apellido'];
          $telefono=$_POST['telefono'];
          $direccion=$_POST['direccion'];
          $correo=$_POST['correo'];
          $fechacumple=$_POST['fechacumple'];
          $idusuario= $_SESSION['idusuario'];

            $query = mysqli_query($conection, "SELECT * FROM cliente  WHERE  cedula='$cedula'");
            $result= mysqli_fetch_array($query);


            if(is_numeric($cedula)&& validarCedula($cedula)){

          if ($result > 0) {
            $alert = '<p class="msg_error">YA existe un cliente con este numero de Cédula</p>';  
          } else {
            $query_insert= mysqli_query($conection, "INSERT INTO cliente(cedula,nombre,apellido,telefono,
            direccion,correo,fechacumple,idusuario) VALUES ('$cedula','$nombre','$apellido','$telefono'
            ,'$direccion','$correo','$fechacumple','$idusuario')");
           
           if($query_insert){
              $alert = '<p class="msg_save">Cliente Creado CORRECTAMENTE!</p>';
            }else{
              $alert = '<p class="msg_error">ERROR! al Crear el Cliente</p>';
            }
          } 
        }else{
          $alert = '<p class="msg_error">La cedula es incorrecta</p>';
        }
          mysqli_close($conection);
        
    }      
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro Clientes</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

	<div class="form_register">
  <h1 style="text-align: center">Registro Clientes</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="POST">

<label for="cedula">Cedula</label>
<input type="text" name="cedula" id="cedula" placeholder="Ingrese cedula del cliente" required > 

<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" required > 

<label for="apellido">Apellido</label>
<input type="text" name="apellido" id="apellido" placeholder="Ingrese  apellido" required > 

<label for="telefono">Telefono</label>
<input type="number" name="telefono" id="telefono" placeholder="Ingrese telefono/celular" required > 

<label for="direccion">Direccion</label>
<input type="text" name="direccion" id="direccion" placeholder="Ingrese  Direccionr" required > 

<label for="correo">Correo</label>
<input type="email" name="correo" id="correo" placeholder="Ingrese Correo " required >

<label for="fechacumple">Fecha de Nacimieto</label>
<input type="date" id="fechacumple" name="fechacumple" min="1960-01-01" max="2005-12-31">


<input type="submit" value="Guardar Cliente" class="btn_save"> 

</form>
</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>