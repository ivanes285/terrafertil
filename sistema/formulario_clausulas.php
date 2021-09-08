<?php
session_start();
include "../conexion.php";

if (empty($_REQUEST['id'])) {
	header("location: lista_auditorvistapro.php");
	
} else {
	$iddetallaauditoria = $_REQUEST['id'];
}
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
				<th>Parametros de Calificación</th>
				<th>Descripción Incumplimiento</th>
				<th>Anexos</th>
				<th>Documentación Soporte</th>	
				<th>EVALUACIÓN</th>
			</tr>
			<?php

			

			if (empty($_REQUEST['id'])) {
				header("location: lista_auditorvistapro.php");
				mysqli_close($conection);
			} else {
				$iddetallaauditoria = $_REQUEST['id'];

				$query = mysqli_query($conection, "SELECT c.clausula,c.detalleclausula,p.nombreproceso,dc.parametroscalificacion,dc.desincumplimiento,dc.documentacionsoporte,dc.iddetalleclausula FROM clausula c, detalleclausula dc, procesos p WHERE dc.idclausula=c.idclausula AND p.idproceso=c.idproceso AND dc.iddetalleauditoria=$iddetallaauditoria ORDER BY c.idclausula");
				$result = mysqli_num_rows($query);

				if ($result > 0) {
					while ($data = mysqli_fetch_array($query)) {
			?>
						<tr>
							<td><?php echo $data[0]; ?></td>
							<?php
						$text = str_replace(["\n"],"<br/>",$data[1]);
						?>
							<td style="text-align: justify;"><?php echo $text; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>
							<td><?php echo $data[4]; ?></td>
							<td><a style="color: #FF1F57; font-weight: bold" href="lista_anexo.php?id=<?php echo $data[6]; ?>&da=<?php echo $iddetallaauditoria ?> ">Agregar Anexo</a></td>
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
		

	</section>



</body>

</html>