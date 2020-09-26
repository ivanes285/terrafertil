
<?php
session_start();
if($_SESSION['rol'] != 1)
{
 header("location: ./");
 }
include "../conexion.php";

if (!empty($_POST)) {
		$alert = '';
          $id_pastel=$_POST['id_pastel'];
          $nombre=$_POST['nombre'];
          $descripcion=$_POST['descripcion'];
          $precio=$_POST['precio'];
          $tamano=$_POST['tamano'];
          $query = mysqli_query($conection, "SELECT * FROM pastel WHERE (nombre='$nombre' AND id_pastel!= $id_pastel)");
          $result= mysqli_fetch_array($query);
          
          if ($result > 0) {
            $alert = '<p class="msg_error">Pastel YA existe !Intente de Nuevo</p>';  
          } else {
            
              $query_update= mysqli_query($conection, "UPDATE pastel SET nombre='$nombre',descripcion='$descripcion', precio='$precio', tamano='$tamano' WHERE id_pastel=$id_pastel");
              
            if($query_update){
              $alert = '<p class="msg_save">Pastel Actualizado CORRECTAMENTE</p>';
            }else{
              $alert = '<p class="msg_error">ERROR al Actualizar Pastel</p>';
            }
            }     
    } 

    if (empty($_REQUEST['id'])) {
      header('Location: lista_pastel.php');
      mysqli_close($conection);
          }
          $id_pastel=$_REQUEST['id'];
          $sql = mysqli_query($conection, "SELECT * FROM pastel WHERE id_pastel=$id_pastel");
         	mysqli_close($conection);
         $result_sql= mysqli_num_rows($sql);
      if($result_sql==0){
  header('Location: lista_pastel.php');
}else{
 $option='';
  while($data=mysqli_fetch_array($sql)){
    $id_pastel= $data['id_pastel'];
    $nombre= $data['nombre'];
    $descripcion= $data['descripcion'];
    $precio= $data['precio'];
    $tamano= $data['tamano'];

  }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Actualizar Pastel</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

<div class="form_register">
<h1 style="text-align: center">Actualizar Pastel</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="POST">

<input type="hidden" name="id_pastel" value="<?php echo $id_pastel;?>"> 

<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" value="<?php echo $nombre;?>" > 

<label for="descripcion">Descripcion</label>
<input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>"> 

<label for="precio">Precio</label>
<input type="number" name="precio" id="precio" value="<?php echo $precio;?>" > 

<label for="tamano">Tamaño</label>
<input type="text" name="tamano" id="tamano" value="<?php echo $tamano;?>"> 


<input type="submit" value="Actualizar Cliente" class="btn_save"> 

</form>
</div>

	</section>
</body>
</html>