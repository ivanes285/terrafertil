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
	<title>Lista Planes de Acción </title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista Planes de Acción</h1>
		<table>
			<tr>
				<th>Acciones</th>
				<th>Código de Auditoria</th>
				<th>Norma</th>
				<th>Consecuencia</th>
				<th>Análisis de Causa</th>
				<th>Desarrollo del Método</th>
				<th>Descripción Causa Raíz</th>
				<th>Acciones Propuestas</th>

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
			//detalleclausula
			$query = mysqli_query($conection, "SELECT codigoauditoria,nombrenorma,consecuencia,analisiscausa,desarrollometodo,causaraiz,c.idclausula, pa.idplandeaccion FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p , plandeaccion pa WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND dc.iddetalleclausula=pa.iddetalleclausula AND dc.parametroscalificacion<>'cumple' AND dc.planaccion=2 ORDER BY nombrenorma,codigoauditoria ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td>
							<a class="link_edit" href="editar_plan.php?id=<?php echo $data[7];?>">Editar</a>
						</td>

						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><?php echo $data[4]; ?></td>
						<td><?php echo $data[5]; ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="lista_accionpropuesta.php?id=<?php echo $data[7];?>">Accion Propuesta</a></td>
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