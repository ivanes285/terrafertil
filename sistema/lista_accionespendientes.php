<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 2) {
	header("location: ./");
}


if (empty($_REQUEST['idpa']) || empty($_REQUEST['id']) || empty($_REQUEST['ida'])) {
	header("location: lista_auditorvistaeje.php");
	mysqli_close($conection);
} else {
	$idplanaccion = $_REQUEST['idpa'];
	$iddetalleclausula = $_REQUEST['id'];
	$iddetalleauditoria = $_REQUEST['ida'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Acciones Pendientes</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Lista Acciones Pendientes</h1>
			<div style="justify-content:flex-start">
				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_planesauditado.php?id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			</div>
		</div>


		<table>
			<tr>
				<th>Codigo Auditoria</th>
				<th>Proceso</th>
				<th>Acción Propuesta</th>
				<th>Responsable</th>
				<th>Fecha Propuesta</th>
				<th>Evidencia</th>
				<th>Anexo</th>
				<th>Fecha Cumplimiento</th>
				<th>Estatus</th>
				<th>Motivo Rechazo</th>
				<th>Eficacia</th>
				<th>Evaluar</th>
			</tr>
			<?php
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM accionespropuestas");
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


			$query = mysqli_query($conection, "SELECT DISTINCT codigoauditoria,nombreproceso,accionpropuesta,responsable,fechapropuesta,evidencia,fechacumplimiento,status,motivonoaceptacion,eficacia,idaccionpropuesta,estado FROM norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da,clausula c, detalleclausula dc , plandeaccion pa , accionespropuestas ap , procesos p WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dc.iddetalleauditoria=da.iddetalleauditoria AND   dc.iddetalleclausula=pa.iddetalleclausula AND pa.idplandeaccion=ap.idplanaccion AND ap.idplanaccion=$idplanaccion  AND dc.idclausula=c.idclausula AND c.idproceso=p.idproceso AND pa.idplandeaccion=ap.idplanaccion ORDER BY idaccionpropuesta ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[0];  ?></td>
						<td><?php echo $data[1];  ?></td>
						<td><?php echo $data[2];  ?></td>
						<td><?php echo $data[3];  ?></td>
						<td><?php echo $data[4];  ?></td>
						<td><?php echo $data[5];  ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="lista_anexoauditado.php?idap=<?php echo $data[10]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria;?>&es=<?php echo  $data[11];?>">Ver</a></td>
						<td><?php echo $data[6];  ?></td>
						<?php
						if ($data[7] == "aceptado") { ?>
							<td style="background-color: #00CC63; color: #FFFFFF; font-weight: bold; "><?php echo $data[7];  ?></td>
						<?php
						} else if (!isset($data[7])) { ?>
							<td><?php echo $data[7]; ?></td>
						<?php
						} else { ?>
							<td style="background-color: #FF1F57; color:#FFFFFF; font-weight: bold;"><?php echo $data[7];  ?></td>
						<?php
						}
						?>
						<td><?php echo $data[8];  ?></td>
						<td><?php echo $data[9];  ?></td>
						<?php
						if ($data[11] == 3) {
							if (!isset($data[7])) {
						?>
								<td>
									<a style="color: #FF1F57; font-weight: bold ">EVALUAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
									<a style="color: #00CC63; font-weight: bold">EVALUADO</a>
								</td>
							<?php
							}
						} else {
							if (!isset($data[7])) {
							?>
								<td>
									<a style="color: #FF1F57; font-weight: bold" href="calificar_accionespendientes.php?idap=<?php echo $data[10]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo $iddetalleauditoria; ?> ">EVALUAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
									<a style="color: #00CC63; font-weight: bold" href="calificar_accionespendientes.php?idap=<?php echo $data[10]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo $iddetalleauditoria; ?>">EVALUADO</a>
								</td>
						<?php
							}
						}
						?>
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