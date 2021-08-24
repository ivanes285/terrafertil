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
		<h1>Auditorias Ejecutadas</h1>
		<table>
			<tr>
				<th>Código de Auditoria</th>
				<th>Fecha de Ejecución</th>
				<th>Norma</th>
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
			$query = mysqli_query($conection, "SELECT DISTINCT codigoauditoria,fechaejecucion,nombrenorma,da.iddetalleauditoria FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND da.estado=2 ORDER BY codigoauditoria ASC LIMIT $desde,$por_pagina");
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
						<td><a style="color: #4099BF; font-weight: bold" href="lista_auditadovista.php?id=<?php echo $data[3]; ?>"><?php echo $data[2]; ?></a></td>
						
					
		
						
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