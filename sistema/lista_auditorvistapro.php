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
	<title>Lista de Auditorias</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1> Auditorias Programadas</h1>
		<table>
			<tr>
				<th>Código de Auditoria</th>
				<th>Fecha de Ejecución</th>
				<th>Norma</th>
				<th>Avance</th>
				<th>Acción</th>
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
			$query = mysqli_query($conection, "SELECT DISTINCT codigoauditoria,fechaejecucion,nombrenorma,iddetalleauditoria from norma n, grupoauditor ga, detallegrupo dg, detalleauditoria da, usuario u WHERE n.idnorma=ga.idnorma and u.id_user=dg.id_user AND ga.idgrupo=dg.idgrupo AND dg.idgrupo=da.idgrupo AND dg.id_user=2 AND da.estado=1 ORDER BY codigoauditoria ASC LIMIT $desde,$por_pagina");
			$result = mysqli_num_rows($query);
			$val;
			$ida=0;
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
						$result = mysqli_fetch_array($conres);
						$result_register = mysqli_fetch_array($con);
						if (isset($result_register)) {
							$total = $result_register['total'];
						}
						if (isset($result)) {
							$totalres = $result['totalre'];
						}
						?>
					
						<td><?php echo $totalres; ?>/<?php echo $total; ?></td>
					
						<?php
							if ($totalres!=0) {
							?>
								<td>
								<a style="color: #00CC63; font-weight: bold" href="guardar_auditoria.php?id=<?php echo $data[3];?> ">GUARDAR</a>
								</td>
							<?php
							} else {
							?>
								<td>
							
								<a style="color: #687778; font-weight: bold">	<abbr title="Al menos debe haber una clausula calificada">GUARDAR</abbr></a>
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