<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Formulario de Clausulas</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Formulario Clausulas</h1>

		<table>
			<tr>
				<th>Clausula</th>
				<th>DetalleClausula</th>
				<th>Proceso Auditado</th>
				<th>Parametros de Calificacion</th>
				<th>Descripcion Incumplimiento</th>
				<th>Documentacion Soporte</th>
				<th>EVALUACION</th>
			</tr>
			<?php

			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM detalleauditoria");
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

			if (empty($_REQUEST['id'])) {
				header("location: lista_auditorvista.php");
				mysqli_close($conection);
			} else {
				$iddetallaauditoria = $_REQUEST['id'];

				$query = mysqli_query($conection, "SELECT c.clausula,c.detalleclausula,p.nombreproceso,dc.parametroscalificacion,dc.desincumplimiento,dc.documentacionsoporte,dc.iddetalleclausula FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetallaauditoria ORDER BY c.idclausula ASC LIMIT $desde,$por_pagina");
				$result = mysqli_num_rows($query);

				if ($result > 0) {
					while ($data = mysqli_fetch_array($query)) {
			?>
						<tr>
							<td><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>
							<td><?php echo $data[4]; ?></td>
							<td><?php echo $data[5]; ?></td>

							<?php
							if (!isset($data[3])) {
							?>
								<td>
									<a style="color: #FF1F57; font-weight: bold" href="calificar_clausula.php?id=<?php echo $data[6]; ?>&da=<?php echo $iddetallaauditoria ?> ">EVALUAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
									<a style="color: #00CC63; font-weight: bold" href="calificar_clausula.php?id=<?php echo $data[6]; ?>&da=<?php echo $iddetallaauditoria ?> ">EVALUADO</a>
								</td>
							<?php
							}
							?>
						</tr>
			<?php
					}
				}
			}
			?>

		</table>
		<div class=" paginador">
			<ul>
				<?php
				if ($pagina != 1) {
				?>
					<li><a href="?pagina=<?php echo 1; ?>">|<< /a>
					</li>
					<li><a href="?pagina=<?php echo $pagina - 1; ?>">
							<<< /a>
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