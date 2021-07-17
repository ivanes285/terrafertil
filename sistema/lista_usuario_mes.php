<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Pedidos Del Mes</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Reporte de pedidos del Mes</h1>
		<a href="registro_pedido.php" class="btn_new">Crear Pedido</a>
		<table>
			<tr>
				<th>Cajero</th>
				<th>Producto</th>
				<th>Cedula Cliente</th>
                <th>Nombre Cliente</th>
				<th>Cantidad</th>
                <th>Fecha</th>
				<th>Opciones</th>
                
			</tr>
			<?php
            $mesactual= date('n');
			$yearactual=date('Y');
			//$mesactual= "09";
			//$yearactual="2020";
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM pedidos ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];
			$por_pagina = 10;
			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}
			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

		    $query = mysqli_query($conection, "SELECT pe.id_pedido, pa.id_pastel, u.user, pa.nombre, pe.cedula,pe.nombre,pe.cantidad,pe.fecha from pedidos pe INNER JOIN pastel pa, usuario u WHERE pe.id_user = u.id_user and pa.id_pastel=pe.id_pastel and MONTH(pe.fecha)='$mesactual' and YEAR(pe.fecha)='$yearactual'");
			mysqli_close($conection);

			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><?php echo $data[4]; ?></td>
						<td><?php echo $data[5]; ?></td>
						<td><?php echo $data[6]; ?></td>
                        <td><?php echo $data[7]; ?></td>
                        
						<td>
							<a class="link_edit" href="editar_pedidos.php?id=<?php echo $data["id_pedido"];?>">Editar</a>

                            <?php if ($_SESSION['rol']==1 ){?>
                            |
                            <a class="link_delete" href="eliminar_pedido.php?id=<?php echo $data["id_pedido"]; ?>">Eliminar</a>
                            
                        <?php }?>
						</td>
					</tr>
			<?php
				}
			}
			?>

		</table>
	

		<div class="paginador ">
			<ul>
				<?php
				if ($pagina != 1) {
				?>
					<li><a href="?pagina=<?php echo 1; ?>">|<</a> </li> <li><a href="?pagina=<?php echo $pagina - 1; ?>">
									<<</a> </li> <?php
												}
												for ($i = 1; $i <= $total_paginas; $i++) {
													# code...
													if ($i == $pagina) {
														echo '<li class="center pageSelected">' . $i . '</li>';
													} else {
														echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
													}
												}

												if ($pagina != $total_paginas) {
													?> <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>

	</section>



</body>

</html>