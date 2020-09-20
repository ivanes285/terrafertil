
<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {
    $alert = '';
    $coproducto=$_POST['id'];
    $descripcion = $_POST['descripcion'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $imgProducto = $_POST['foto_actual'];
    $imgRemove = $_POST['foto_remove'];

    $foto = $_FILES['foto'];
    $nombre_foto = $foto['name'];
    $type = $foto['type'];
    $url_temp = $foto['tmp_name'];

    $upd= '';

    if ($nombre_foto != '') {
        $destino = 'img/uploads/';
        $img_nombre = 'img_' . md5(date('d-m-Y H:m:s'));
        $imgProducto = $img_nombre . '.jpg';
        $src = $destino . $imgProducto;
    }else{
        if($_POST['foto_actual'] != $_POST['foto_remove']){
            $imgProducto='img_producto.png';
        }
    }

    $query_update = mysqli_query($conection, "UPDATE  producto SET descripcion= '$descripcion' ,
    proveedor='$proveedor' ,precio=$precio, foto='$imgProducto' WHERE coproducto= $coproducto");

    if ($query_update) {

        if(($nombre_foto !='' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'] )){
          unlink('img/uploads/'.$_POST['foto_actual']);
        }
        if ($nombre_foto != '') {
            move_uploaded_file($url_temp, $src);
        }
        $alert = '<p class="msg_save">Producto Actualizado CORRECTAMENTE!</p>';
    } else {
        $alert = '<p class="msg_error">ERROR! al Actualizar el Producto</p>';
    }

}
if (empty($_REQUEST['id'])) {
    header("Location: lista_producto.php");
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header("Location: lista_producto.php");
    }
    $query_producto = mysqli_query($conection, "SELECT p.coproducto, p.descripcion,p.precio ,p.foto,
              pr.idproveedor,pr.proveedor FROM producto p INNER JOIN proveedores pr ON
               p.proveedor=pr.idproveedor WHERE p.coproducto =$id_producto AND p.estatus= 1");
    $result_producto = mysqli_num_rows($query_producto);
   $foto='';
   $classRemove='notBlock';

   
   
    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_array($query_producto);

if($data_producto['foto']!= 'img_producto.png'){
$classRemove='';
$foto='<img id="img" src="img/uploads/'.$data_producto['foto'].'" alt="Producto">';
}

    } else {
        header("Location: lista_producto.php");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Actualizar Producto</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">

	<div class="form_register">
  <h1 style="text-align: center">Actualizar Producto</h1><hr>
<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

<form action="" method="post" enctype="multipart/form-data">


<input type="hidden" name="id" value="<?php echo $data_producto['coproducto'];?>">
<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto'];?>">
<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto'];?>">

<label for="proveedor">Proveedor</label>
<?php
$query_proveedor = mysqli_query($conection, "SELECT idproveedor, proveedor FROM proveedores WHERE estatus=1 ORDER BY proveedor ASC");
$result_proveedor = mysqli_num_rows($query_proveedor);
mysqli_close($conection);
?>



<select class="noItemOne" name="proveedor" id=proveedor>
    <option value="<?php echo $data_producto['idproveedor'];?>"><?php echo $data_producto['proveedor'];?></option>
<?php

if ($result_proveedor > 0) {
    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
        ?>
  <option value="<?php echo $proveedor['idproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
  <?php
}
}
?>
</select>


<label for="descripcion">Producto</label>
<input type="text" name="descripcion" id="descripcion" placeholder="Ingrese nombre del producto" value="<?php echo $data_producto['descripcion'];?>" required >


<label for="precio">Precio </label>
<input type="number" name="precio" id="precio" placeholder="Ingrese el precio de venta" value="<?php echo $data_producto['precio'];?>" min="1" max="100000" required >


<div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto <?php echo $classRemove ;?>">X</span>
        <label for="foto"></label>
        <?php echo $foto; ?>
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