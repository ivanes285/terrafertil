<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Procesos</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
		<h1>Lista de Procesos</h1>
		<div style="justify-content:flex-end">
		<a style="border: 2px solid #0069D9;  color: #ffffff; background-color: #0069D9; border-radius: 6px;" href="registro_procesos.php" class="btn_save">Ingresar Proceso</a>
	    </div>
		</div>


		<table>
			<tr>
				<th>ID</th>
				<th>Nombre del Proceso</th>
				<th>Lider del Proceso</th>
				<th>Acciones</th>
			</tr>
			<?php

			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM procesos");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];
			$por_pagina = 15;
			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}
			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);



			$query = mysqli_query($conection, "SELECT p.idproceso, p.nombreproceso,u.user from procesos p,usuario u WHERE p.liderproceso=u.id_user ORDER BY idproceso ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);

			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>

						<td>
							<a class="link_edit" href="editar_procesos.php?id=<?php echo $data[0]; ?>">Editar</a>
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
					<li><a href="?pagina=<?php echo 1; ?>">|<</a>
					</li>
					<li><a href="?pagina=<?php echo $pagina - 1; ?>"><<</a>
					</li>
				<?php
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
				?>
					<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>
	</section>

</body>

</html>