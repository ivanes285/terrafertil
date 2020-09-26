
<?php
  session_start();

  if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
  include "../conexion.php";
  
if(!empty($_POST)){
  
  $id_pastel=$_POST['id_pastel'];

  $query_delete = mysqli_query($conection, "DELETE FROM pastel WHERE id_pastel = $id_pastel");
  mysqli_close($conection);
  if($query_delete){
    header("location: lista_pastel.php");
  }else{
    echo "Error al eliminar Pastel";
  }
}


if (empty($_REQUEST['id'])) {
    header('Location: lista_pastel.php');   
    mysqli_close($conection);
    }else{
       
        $id_pastel=$_REQUEST['id'];
        $sql = mysqli_query($conection, "SELECT * FROM pastel WHERE id_pastel= $id_pastel");
        	mysqli_close($conection);
        $result= mysqli_num_rows($sql);

 if($result>0){

while($data=mysqli_fetch_array($sql)){
    $id_pastel=$data['id_pastel'];
    $nombre=$data['nombre'];
    $descripcion=$data['descripcion'];
    $precio=$data['precio'];
    $tamano=$data['tamano'];
}
 }else{
    header('Location: lista_pastel.php');
 }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Eliminar Pasteles</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
       <div class="data_delete">
<h2 style="color: #C82333">¿Está seguro de eliminar el pastel?</h2>
<p>Nombre: <span><?php  echo $nombre;?></span></p>
<p>Descripcion: <span><?php  echo $descripcion;?></span></p>
<p>Precio: <span><?php  echo $precio;?></span></p>
<p>Tamaño: <span><?php  echo $tamano;?></span></p>
<form method="POST" action="">
<input type="hidden" name="id_pastel" value="<?php echo $id_pastel;?>"> 
<a href="lista_pastel.php" class="btn_cancel">Cancelar</a>
<input type="submit" value="Aceptar" class="btn_ok" >
</form>
  </div>
	</section>

</body>
</html>