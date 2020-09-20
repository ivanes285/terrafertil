<?php 
    session_start();
    include "../conexion.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Nueva Venta</title>
</head>
<body>
<?php include "includes/header.php";?>


	<section id="container">
<div class="title_page">
<h1>Nueva Venta</h1>
</div>
<div class="datos_cliente">
<div class="action_cliente">
<h4>Datos del cliente</h4>
<a href="#" class="btn_new btn_new_cliente">Nuevo Cliente</a>
</div>

<form name="form_new_cliente_venta" id="form_new_cliente_venta"  class="datos">
<input type="hidden" name="action" value="addCliente">
<input type="hidden"  id="idcliente" name="idcliente" value="" required>

<div class="wd30">
<label >Cedula</label>
<input type="text" name="cedula" id="cedula" placeholder="Ingrese cedula del cliente" required > 

<div class="wd30">
<label >Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del cliente" disabled required > 
</div>

<div class="wd30">
<label >Apellido</label>
<input type="text" name="apellido" id="apellido" placeholder="Ingrese  apellido" disabled required > 
</div>

<div class="wd30">
<label >Telefono</label>
<input type="number" name="telefono" id="telefono" placeholder="Ingrese telefono/celular" disabled required > 
</div>

<div class="wd30">
<label >Direccion</label>
<input type="text" name="direccion" id="direccion" placeholder="Ingrese  Direccionr"  disabled required > 
</div>

<div class="wd30">
<label >Correo</label>
<input type="email" name="correo" id="correo" placeholder="Ingrese Correo " disabled required >
</div>

<div class="wd30">
<label >Fecha de Nacimieto</label>
<input type="date" id="fechacumple" name="fechacumple" min="1960-01-01" max="2005-12-31" disabled>
</div>

<button type="submit"  " class="btn_save">Guardar</button> 
</form>
</div>

<div class="datos_venta">
	<h4>Datos de venta</h4>
	<div class="datos">
	<div class="wd50">
<label>Vendedor</label>
<p>Ivan Lescano</p>

	</div>
	<div class="wd50">
	<label>Acciones</label>
	<div id="acciones_venta">
	<a href="#" class="btn_okk textcenter" id="btn_anular_venta">Anular</a>
	<a href="#" class="btn_new textcenter" id="btn_facturar_venta">Procesar</a>
	</div>
 </div>
</div>
</div>

<table class="tbl_venta">
<head>
	<tr>

   <th width="100px">Codigo </th>
   <th> Descripcion </th>
   <th> Existencia </th>
   <th width="100px">Cantidad  </th>
   <th class="textright"> Precio </th>
    <th class="textright"> Precio Total </th>
	<th>Accion </th>
	</tr>

	<tr>
<td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
<td id="txt_descripcion">-</td>
<td id="txt_existencia">-</td>
<td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
<td id="txt_precio" class="textright">0.00</td>
<td id="txt_precio_total" class="textright">0.00</td>
<td ><a href="#" class="link_add" id="add_product_venta">Agregar</a></td>
	</tr>

	<tr>
	<th>Codigo</th>
	<th colspan="2">Descripcion</th>
	<th>Cantidad</th>
	<th class="textright">Precio</th>
	<th class="textright">Precio Total</th>
	<th >Accion</th>
	</tr>

</thead>
<tbody id="detalle_venta"></tbody>
<tfoot>

<tr>
<td colspan="5" class="textright">SUBTOTAL</td>
<td  class="textright">SUBTOTAL</td>
</tr>


<tr>
<td colspan="5" class="textright">IVA (12%)</td>
<td  class="textright">SUBTOTAL</td>
</tr>

<tr>
<td colspan="5" class="textright">IVA (12%)</td>
<td  class="textright">SUBTOTAL</td>
</tr>

</tfoot>
</table>
















</section>
	<?php include "includes/footer.php";?>
</body>
</html>