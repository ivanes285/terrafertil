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
	<title>Auditorias Archivadas</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php
		$busqueda = strtolower($_REQUEST['busqueda']);
		if (empty($busqueda)) {
			header("Location: lista_inclumplimientosarchi.php");
		}
		?>

		<h1>Auditorias Encontradas</h1>
		<form action="" class="form_search">
			<input style="width:150px" type="text" name="busqueda" id="busqueda" placeholder="Ingresa búsqueda" value="<?php echo $busqueda ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
		<table>
			<tr>
				<th>Código de Auditoria</th>
				<th>Fecha de Ejecución</th>
				<th>Norma</th>
			</tr>
			<?php
			$norma = '';
			if ($busqueda == "iso9001") {
				$norma = " OR n.idnorma LIKE '%1%' ";
			} else if ($busqueda == "bpm") {
				$norma = " OR  n.idnorma LIKE '%2%' ";
			} else if ($busqueda == "basc") {
				$norma = " OR  n.idnorma LIKE '%3%' ";
			} else if ($busqueda == "brc") {
				$norma = " OR n.idnorma LIKE '%4%' ";
			}



			$sql_registe = mysqli_query($conection, "SELECT COUNT(DISTINCT codigoauditoria,fechaejecucion,nombrenorma,da.iddetalleauditoria) as total_registro FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p  WHERE (codigoauditoria LIKE '%$busqueda%' OR fechaejecucion LIKE '%$busqueda%' $norma) AND da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND da.estado=3;");
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
			$query = mysqli_query($conection, "SELECT DISTINCT codigoauditoria,fechaejecucion,nombrenorma,da.iddetalleauditoria FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p  WHERE (codigoauditoria LIKE '%$busqueda%' OR fechaejecucion LIKE '%$busqueda%' $norma) AND da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND da.estado=3 Order By codigoauditoria ASC LIMIT $desde,$por_pagina");
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
						<td><a style="color: #4099BF; font-weight: bold" href="lista_auditadovista.php?ida=<?php echo $data[3]; ?>"><?php echo $data[2]; ?></a></td>


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
					<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a>
					</li>
					<li><a href="?pagina=<?php echo $pagina - 1; ?>&busqueda=<?php echo $busqueda; ?>">
							<<</a>
					</li>
				<?php
				}
				for ($i = 1; $i <= $total_paginas; $i++) {
					# code...
					if ($i == $pagina) {
						echo '<li class="pageSelected">' . $i . '</li>';
					} else {
						echo '<li><a href="?pagina=' . $i . '&busqueda='.$busqueda.'">' . $i . '</a></li>';
					}
				}
				if ($pagina != $total_paginas) {
				?>
					<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>
	</section>
</body>

</html>