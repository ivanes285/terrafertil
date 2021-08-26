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
	<title>Auditorias Ejecutadas</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista Auditorias Ejecutadas</h1>
		<table>
			<tr>
				<th>Código de Auditoria</th>
				<th>Fecha de Ejecución</th>
				<th>Norma</th>
				<th>Avance</th>
				<th>No Conformidades</th>
				<th>Cierre NC</th>
				<th style="text-align:center">Archivar Auditoría</th>
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
			$query = mysqli_query($conection, "SELECT codigoauditoria,fechaejecucion,nombrenorma,iddetalleauditoria from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=2 ORDER BY codigoauditoria ASC LIMIT $desde,$por_pagina");
			$result = mysqli_num_rows($query);
			$val;
			$ida = 0;
			$total = 0;
			$totalres = 0;

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="formulario_clausulas.php?id=<?php echo $data[3]; ?>"><?php echo $data[2]; ?></a></td>
						<?php
						$val = $data[2];
						$idda = $data[3];
						$con = mysqli_query($conection, "SELECT COUNT(*) as total FROM clausula c,norma n WHERE n.idnorma=c.idnorma AND n.nombrenorma='$val' ");
						$conres = mysqli_query($conection, "SELECT COUNT(*) as totalre FROM detalleclausula dc , clausula c, norma n, detalleauditoria da WHERE n.idnorma=c.idnorma AND c.idclausula=dc.idclausula AND n.nombrenorma='$val' AND da.iddetalleauditoria=dc.iddetalleauditoria AND dc.iddetalleauditoria=$idda AND dc.documentacionsoporte IS NOT NULL;");
						$numacc = mysqli_query($conection, "SELECT COUNT(*) AS totalin  FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND dc.parametroscalificacion<>'cumple' AND da.iddetalleauditoria=$data[3] ");
						$num = mysqli_query($conection, "SELECT COUNT(*) AS totalplanes  FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND dc.parametroscalificacion<>'cumple'  AND da.iddetalleauditoria=$data[3]  AND dc.planaccion=2 AND dc.estadoplan=2  ");


						$numacciones = mysqli_fetch_array($numacc);
						$result = mysqli_fetch_array($conres);
						$result_register = mysqli_fetch_array($con);
						$numplan = mysqli_fetch_array($num);
						if (isset($result_register)) {
							$total = $result_register['total'];
						}
						if (isset($result)) {
							$totalres = $result['totalre'];
						}
						if (isset($numacciones)) {
							$totalplan = $numacciones['totalin'];
						}
						if (isset($numplan)) {
							$totalplanes = $numplan['totalplanes'];
						}
						?>
						<td><?php echo $totalres; ?>/<?php echo $total; ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="lista_noconformidades.php?id=<?php echo $data[3]; ?>"><i class="fas fa-folder-open"></i> Visualizar</a></td>

						<td><?php echo $totalplanes; ?>/<?php echo $totalplan; ?></td>

						<?php
						if ($totalplanes == $totalplan) {
						?>
							<td style="font-size: 35px; text-align: center; color: #33BDCA;"><a style="color: #33BDCA; font-weight: bold" href="archivar_auditoria.php?id=<?php echo $data[3]; ?>"><i class="fas fa-file-download"></i></a> </td>
						<?php
						} else {
						?>

							<td style="font-size: 35px; text-align: center; color: #687778;"><abbr title="Debe haber un plan por cada incumplimiento"><i class="fas fa-file-download"></i></abbr></td>

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