<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Formulario de Clausulas Archivadas</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Formulario Clausulas Archivadas</h1>

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

			
			if (empty($_REQUEST['id']) || empty($_REQUEST['ide'])) {
				header("location: lista_auditorvistapro.php");
				mysqli_close($conection);
			} else {
				$iddetallaauditoria = $_REQUEST['id'];
				$estado = $_REQUEST['ide'];

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
							<td><a style="color: #4099BF; font-weight: bold" href="lista_anexoarchivados.php?id=<?php echo $data[6]; ?>&da=<?php echo $iddetallaauditoria ?>&ide=<?php echo $estado ?> "><i class="fas fa-folder-open"></i> Ver</a></td>
							<td><?php echo $data[5]; ?></td>

							<?php
							if (!isset($data[3])) {
							?>
								<td>
									<a style="color: #FF1F57; font-weight: bold">EVALUAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
									<a style="color: #00CC63; font-weight: bold ">EVALUADO</a>
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