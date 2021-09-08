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
	<title>Auditorías Archivadas</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de Auditorias Archivadas</h1>
		<form action="busqueda_auditorarchivadas.php" class="form_search">
		<input style="width:150px" type="text" name="busqueda" id="busqueda" placeholder="Ingresa búsqueda">
		<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table style="margin-top: 20px;">
			<tr>
				<th>Código de Auditoria</th>
				<th>Fecha de Ejecución</th>
				<th>Norma</th>
				<th>Avance</th>
				<th>No Conformidades</th>
				<th>Cierre NC</th>
				<th  style="text-align: center;">Informe Auditoría</th>

			</tr>
			<?php
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=3 ");
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
			$query = mysqli_query($conection, "SELECT codigoauditoria,fechaejecucion,nombrenorma,iddetalleauditoria,estado from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da WHERE n.idnorma=ga.idnorma and ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=$usu AND da.estado=3 ORDER BY codigoauditoria DESC LIMIT $desde,$por_pagina");
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
						<td><a style="color: #4099BF; font-weight: bold" href="formulario_clausulasarchivadas.php?id=<?php echo $data[3]; ?>&ide=<?php echo $data[4]; ?> "><?php echo $data[2]; ?></a></td>
						<?php
						$val = $data[2];
						$idda = $data[3];
						$con = mysqli_query($conection, "SELECT COUNT(*) as total FROM clausula c,norma n WHERE n.idnorma=c.idnorma AND n.nombrenorma='$val' ");
						$conres = mysqli_query($conection, "SELECT COUNT(*) as totalre FROM detalleclausula dc , clausula c, norma n, detalleauditoria da WHERE n.idnorma=c.idnorma AND c.idclausula=dc.idclausula AND n.nombrenorma='$val' AND da.iddetalleauditoria=dc.iddetalleauditoria AND dc.iddetalleauditoria=$idda AND dc.documentacionsoporte IS NOT NULL;");
						$numacc = mysqli_query($conection, "SELECT COUNT(*) AS totalin  FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND dc.parametroscalificacion<>'cumple' AND da.iddetalleauditoria=$data[3] ");
						$num = mysqli_query($conection, "SELECT COUNT(*) AS totalplanes  FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND dc.parametroscalificacion<>'cumple'  AND da.iddetalleauditoria=$data[3]  AND dc.planaccion=2   ");


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
						<td style="font-size: 40px; text-align: center; color: #343A40"><a style="color: #343A40; font-weight: bold" href="app/index.php?id=<?php echo $data[3]; ?>" target="_blank"><abbr title="Observar informe final "><i class="far fa-file-pdf"></i></abbr></a></td>
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
					<li><a href="?pagina=<?php echo $pagina - 1; ?>">
							<<</a>
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