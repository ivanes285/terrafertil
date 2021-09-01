<?php
session_start();
include "../conexion.php";
$usu = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Incumplimientos </title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Lista de Incumplimientos</h1>
			<div style="justify-content:flex-start">
				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_auditorvistaeje.php" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			</div>
		</div>
		<table>
			<tr>
				<th>Proceso</th>
				<th>Líder Proceso</th>
				<th>Clausula</th>
				<th>Detalle Clausula</th>
				<th>Descripción Incumplimiento</th>
				<th>Plan de Acción</th>
				<th>Estado Plan</th>

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


			if (empty($_REQUEST['id'])) {
				header('Location: lista_auditorvistaeje.php');
				mysqli_close($conection);
			}

			$iddetalleauditoria = $_REQUEST['id'];


			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);
			$query = mysqli_query($conection, "SELECT clausula,detalleclausula,desincumplimiento,iddetalleclausula,dc.planaccion,da.iddetalleauditoria,nombreproceso,user,dc.estadoplan FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p, usuario u  WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=u.id_user AND dc.parametroscalificacion<>'cumple' AND da.iddetalleauditoria=$iddetalleauditoria ORDER BY nombreproceso,iddetalleclausula ASC LIMIT $desde,$por_pagina");

			$result = mysqli_num_rows($query);



			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>

						<td><?php echo $data[6]; ?></td>
						<td><?php echo $data[7]; ?></td>
						<td><?php echo $data[0]; ?></td>
						<?php
						$text = str_replace(["\n"], "<br/>", $data[1]);
						?>

						<td style="text-align:justify"><?php echo $text ?></td>
						<td style="text-align:center"><?php echo $data[2]; ?></td>

						<?php
						if ($data[4] == 1) {
						?>
							<td>
								<a style="color: #687778; font-weight: bold"> <abbr title="El auditado no ha creado un plan ">PLAN</abbr></a>
							</td>

						<?php
						} else {
						?>
							<td><a style="color: #00CC63; font-weight: bold" href="lista_planesauditado.php?id=<?php echo $data[3]; ?>&ida=<?php echo $iddetalleauditoria ?> ">PLAN</a></td>
						<?php
						}
						?>

						<?php
						//--------------------------------------------//
						$sqlnorma = mysqli_query($conection, "SELECT idplandeaccion FROM plandeaccion WHERE iddetalleclausula =$data[3]");
						$numero = mysqli_num_rows($sqlnorma);
						if ($numero > 0) {
							while ($res = mysqli_fetch_array($sqlnorma)) {
								$gg = $res[0];
							}
						}
						$idplandeaccion = intval($gg);  //convierto en entero ya que fda es string
						//---------------------------------------------//

						$numacc = mysqli_query($conection, "SELECT COUNT(*) AS total  FROM accionespropuestas WHERE idplanaccion=$idplandeaccion");
						$numacciones = mysqli_fetch_array($numacc);
						if (isset($numacciones)) {
							$totalacciones = $numacciones['total'];
						}

						
						$numa = mysqli_query($conection, "SELECT COUNT(*) AS total  FROM accionespropuestas WHERE idplanaccion=$idplandeaccion AND status IS NOT NULL");
						$numaccion = mysqli_fetch_array($numa);
						if (isset($numaccion)) {
							$totalcali = $numaccion['total'];
						}
						?>
						<?php
						if ($data[4] == 2 && $data[8] == 2 ) {
						?>
							<td style="font-size: 35px; text-align: center; color: #687778;"><abbr title="El plan está cerrado"><i class="fas fa-lock"></i></abbr></td>
						<?php
						} else if ($data[4] == 2 && $data[8] == 1 && $totalacciones >0 && ($totalacciones==$totalcali)) {
						?>
							<td style="font-size: 35px; text-align: center; color: #33BDCA;"><a style="color: #33BDCA; font-weight: bold" href="estadoplan.php?id=<?php echo $data[3]; ?>&ida=<?php echo $iddetalleauditoria ?>"><abbr title="Quieres Cerrar el Plan ?"><i class="fas fa-lock-open"></i></abbr></a></td>
						<?php
						} else { ?>
							<td style="font-size: 35px; text-align: center; color: #33BDCA;"><a style="color: #C95E7D; font-weight: bold" href="#"><abbr title="No existe un plan, no tiene acciones propuestas, o no están calificadas las acciones"><i class="fas fa-lock-open"></i></abbr> </a></td>
						<?php
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