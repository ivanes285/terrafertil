
<?php
session_start();
  include "../conexion.php";
if (!empty($_POST)) {
        $alert = '';
          $nombre=$_POST['nombre'];
          $descripcion=$_POST['descripcion'];
          $precio=$_POST['precio'];
          $tamano=$_POST['tamano'];
            $query = mysqli_query($conection, " SELECT * FROM pastel WHERE nombre='$nombre'");
            $result= mysqli_fetch_array($query);


          if ($result > 0) {
            $alert = '<p class="msg_error">YA existe un pastel con este nombre</p>';  
          } else {
            $query_insert= mysqli_query($conection, "INSERT INTO pastel(nombre,descripcion,precio,
            tamano) VALUES ('$nombre','$descripcion','$precio','$tamano')");
           
           if($query_insert){
              $alert = '<p class="msg_save">Pastel Creado CORRECTAMENTE!</p>';
            }else{
              $alert = '<p class="msg_error">ERROR! al Crear el Pastel</p>';
            }
          } 
          mysqli_close($conection);
    }      
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro de Pasteles</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

	<div class="form_register">
  <h1 style="text-align: center">Registro Pastel</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="POST">

<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del pastel" required > 

<label for="descripcion">Descripcion</label>
<input type="text" name="descripcion" id="descripcion" placeholder="Ingrese una Descripcion" required > 

<label for="precio">Precio</label>
<input type="number" name="precio" id="precio" placeholder="Ingrese precio" required > 

<label for="tamano">Tamaño</label>
<input type="text" name="tamano" id="tamano" placeholder="Pequeño, Mediano o Grande" required > 

<input type="submit" value="Guardar Cliente" class="btn_save"> 
</form>
</div>
	</section>

</body>
</html>