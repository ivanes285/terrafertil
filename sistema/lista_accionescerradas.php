<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}
$usu = $_SESSION['id_user'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Acciones Pendientes</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista Acciones Pendientes </h1>
		<table>
			<tr>
		    	<th>Codigo Auditoria</th>
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


			$query = mysqli_query($conection, "SELECT codigoauditoria,accionpropuesta,responsable,fechapropuesta,evidencia,fechacumplimiento,status,motivonoaceptacion,eficacia,idaccionpropuesta from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da, detalleclausula dc , plandeaccion pa , accionespropuestas ap WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dc.iddetalleauditoria=da.iddetalleauditoria AND   dc.iddetalleclausula=pa.iddetalleclausula AND pa.idplandeaccion=ap.idplanaccion AND dg.id_user=$usu AND estadover=2  ORDER BY idaccionpropuesta ASC LIMIT $desde,$por_pagina");
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
						<td><a style="color: #FF1F57; font-weight: bold" href="lista_anexopropuesto.php?id=<?php echo $data[0]; ?>">Ver</a></td>
						<td><?php echo $data[5];  ?></td>
						<td><?php echo $data[6];  ?></td>
						<td><?php echo $data[7];  ?></td>
						<td><?php echo $data[8];  ?></td>
						<?php
							if (!isset($data[6])) {
							?>
								<td>
									<a style="color: #FF1F57; font-weight: bold" href="calificar_accionespendientes.php?id=<?php echo $data[9]; ?>">EVALUAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
									<a style="color: #00CC63; font-weight: bold" href="calificar_accionespendientes.php?id=<?php echo $data[9]; ?> ">EVALUADO</a>
								</td>
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



