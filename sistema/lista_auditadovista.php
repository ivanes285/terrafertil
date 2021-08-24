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
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1 style="padding:20px 980px 20px 0px; ">Lista de Incumplimientos</h1>
		<a style="border: 2px solid #36A152; padding: 10px 60px; color: #ffffff; background-color: #36A152; border-radius: 6px;" href="lista_planaccion.php" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>

		<table>
			<tr>
				
				<th>Clausula</th>
				<th>Detalle Clausula</th>
				<th>Descripción Incumplimiento</th>
				<th>Plan de Acción</th>

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
				header('Location: lista_inclumplimientospe.php');
				mysqli_close($conection);
			}

			$iddetalleauditoria = $_REQUEST['id'];


			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);
			$query = mysqli_query($conection, "SELECT clausula,detalleclausula,desincumplimiento,iddetalleclausula,dc.planaccion,da.iddetalleauditoria FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND dc.parametroscalificacion<>'cumple' AND da.iddetalleauditoria=$iddetalleauditoria  ORDER BY nombrenorma,codigoauditoria ASC LIMIT $desde,$por_pagina");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<?php
						if ($data[4] == 1) {
						?>
							<td><a style="color: #FF1F57; font-weight: bold" href="registro_plandeaccion.php?id=<?php echo $data[3]; ?>&ida=<?php echo $iddetalleauditoria ?> ">PLAN</a></td>
						<?php
						} else {
						?>
							<td><a style="color: #00CC63; font-weight: bold" href="lista_planaccion.php?id=<?php echo $data[3];?>&ida=<?php echo $iddetalleauditoria ?> ">PLAN</a></td>
						<?php   	}
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