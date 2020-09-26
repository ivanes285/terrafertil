<?php 
	session_start();
	include "../conexion.php";	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Pasteles</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
    <h1>Lista de Pasteles</h1>
 <a href="registro_pastel.php" class="btn_new">Ingresar Pastel</a>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripcion</th>
	<th>Precio</th>
	<th>Tamaño</th>
    <th>Acciones</th>
</tr>
 <?php

$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM pastel");
$result_register = mysqli_fetch_array($sql_registe);
$total_registro = $result_register['total_registro'];
$por_pagina = 5;
if(empty($_GET['pagina']))
{
    $pagina = 1;
}else{
    $pagina = $_GET['pagina'];
}
$desde = ($pagina-1) * $por_pagina;
$total_paginas = ceil($total_registro / $por_pagina);

 $query = mysqli_query($conection, "SELECT * FROM pastel ORDER BY id_pastel ASC LIMIT $desde,$por_pagina");
mysqli_close($conection);
$result=mysqli_num_rows($query);

 if($result>0){
    while($data=mysqli_fetch_array($query)){
      ?>
<tr>
    <td><?php echo $data["id_pastel"]; ?></td>
    <td><?php echo $data["nombre"] ;  ?></td>
    <td><?php echo $data["descripcion"]; ?></td>
	<td><?php echo $data["precio"];?></td>
	<td><?php echo $data["tamaño"];?></td>
    <td>
        <a class="link_edit" href="editar_pastel.php?id=<?php echo $data["id_pastel"]; ?>">Editar</a>
	   
		<?php if ($_SESSION['rol']==1){?>
		|
		<a class="link_delete" href="eliminar_pastel.php?id=<?php echo $data["id_pastel"]; ?>">Eliminar</a>
		
	   <?php }?>
    </td>
</tr>
       <?php
    }
  }
 ?>

</table>

<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
	</section>

</body>
</html> 