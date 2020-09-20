
<?php
session_start();
if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
  include "../conexion.php";
  

if (!empty($_POST)) {
        $alert = '';
          $descripcion=$_POST['descripcion'];
          $proveedor=$_POST['proveedor'];
          $precio=$_POST['precio'];
          $existencia= $_POST['existencia'];
          $idusuario= $_SESSION['idusuario'];

          $foto=$_FILES['foto'];
          $nombre_foto=$foto['name'];
          $type=$foto['type'];
          $url_temp =$foto['tmp_name'];

          $imgProducto='img_producto.png';

          if ($nombre_foto != ''){
             $destino ='img/uploads/';
             $img_nombre='img_'.md5(date('d-m-Y H:m:s'));
             $imgProducto=$img_nombre.'.jpg';
             $src = $destino.$imgProducto;
          }

            $query_insert= mysqli_query($conection, "INSERT INTO producto(descripcion,proveedor,precio,
            existencia,idusuario,foto) VALUES ('$descripcion','$proveedor','$precio','$existencia',
            '$idusuario','$imgProducto')");
           
           if($query_insert){
             if($nombre_foto != ''){
               move_uploaded_file($url_temp,$src);
             }
              $alert = '<p class="msg_save">Producto Ingresado CORRECTAMENTE!</p>';
            }else{
              $alert = '<p class="msg_error">ERROR! al Ingresar el Producto</p>';
            }
          }         
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro Producto</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

	<div class="form_register">
  <h1 style="text-align: center">Registro Prodcuto</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  

<form action="" method="post" enctype="multipart/form-data">

<label for="proveedor">Proveedor</label>
<?php 
$query_proveedor= mysqli_query($conection,"SELECT idproveedor, proveedor FROM proveedores WHERE estatus=1 ORDER BY proveedor ASC");
$result_proveedor=mysqli_num_rows($query_proveedor);
mysqli_close($conection);
?>
<select name="proveedor" id=proveedor>
<?php 
if($result_proveedor>0){
while($proveedor= mysqli_fetch_array($query_proveedor)){
  ?>
  <option value="<?php echo $proveedor['idproveedor'];?>"><?php echo $proveedor['proveedor']; ?></option>
  <?php 
}
}
?>
</select>

<label for="descripcion">Producto</label>
<input type="text" name="descripcion" id="descripcion" placeholder="Ingrese nombre del producto" required > 

<label for="precio">Precio </label>
<input type="number" name="precio" id="precio" placeholder="Ingrese el precio " min="1" max="100000" required > 

<label for="existencia">Cantidad</label>
<input type="text" name="existencia" id="existencia" placeholder="Ingrese la cantidad" min="1"  max="1000" required > 


<div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
</div>


<input type="submit" value="Guardar Proveedor" class="btn_save"> 

</form>
</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>