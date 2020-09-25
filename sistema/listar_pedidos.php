<?php
session_start();
if ($_SESSION['rol'] != 2) {
	header("location: ./");
}
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Usuarios</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Reporte de pedidos</h1>
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

			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM pedidos ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];
			$por_pagina = 7;
			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}
			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection, "select u.user, pa.nombre, pe.cedula,pe.nombre,pe.cantidad,pe.fecha from pedidos pe INNER JOIN pastel pa, usuario u WHERE pe.id_user = u.id_user and pa.id_pastel=pe.id_pastel ");
			mysqli_close($conection);

			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1];  ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><?php echo $data[4]; ?></td>
						<td><?php echo $data[5]; ?></td>
						<td>
							<a class="link_edit" href="">Editar</a>

							<!-- <?php if ($data[""] != 1) { ?> -->
								
								<a class="link_delete" href="">Eliminar</a>
							<!-- <?php } ?> -->
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
				if ($pagina != 1) {
				?>
					<li><a href="?pagina=<?php echo 1; ?>">|<</a> </li> <li><a href="?pagina=<?php echo $pagina - 1; ?>">
									<<</a> </li> <?php
												}
												for ($i = 1; $i <= $total_paginas; $i++) {
													# code...
													if ($i == $pagina) {
														echo '<li class="pageSelected">' . $i . '</li>';
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