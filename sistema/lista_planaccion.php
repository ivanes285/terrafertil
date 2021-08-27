<?php
session_start();
include "../conexion.php";
$usu = $_SESSION['id_user'];

if (empty($_REQUEST['id']) || empty($_REQUEST['ida'])) {
	header('Location: lista_auditadovista.php');
	mysqli_close($conection);
}

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title> Plan de Acción </title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Plan de Acción</h1>
			<div style="justify-content:flex-end">
				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_auditadovista.php?ida=<?php echo $iddetalleauditoria ?>" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			</div>
		</div>

		<table>
			<tr>
				<th>Acciones</th>
				<th>Código de Auditoria</th>
				<th>Clausula</th>
				<th>Detalle Clausula</th>
				<th>Descripción Causa Raíz</th>
				<th>Acciones Propuestas</th>

			</tr>
			<?php

			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM plandeaccion WHERE iddetalleclausula=$iddetalleclausula");
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

			$query = mysqli_query($conection, "SELECT codigoauditoria,clausula,detalleclausula,causaraiz, pa.idplandeaccion,estado FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p , plandeaccion pa WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND dc.iddetalleclausula=pa.iddetalleclausula AND dc.parametroscalificacion<>'cumple' AND dc.planaccion=2 AND pa.iddetalleclausula=$iddetalleclausula ORDER BY nombrenorma,codigoauditoria ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<?php if ($data[5] == 3) { ?>
							
							<td style="text-align: center; color: #687778;"><abbr title="Ya no puede editar este Plan">Editar</abbr></td>
						<?php 	} else { ?>

							<td>
								<a class="link_edit" href="editar_plan.php?idpa=<?php echo $data[4]; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>">Editar</a>
							</td>
						<?php
						} ?>

						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="lista_accionpropuesta.php?idpa=<?php echo $data[4]; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>&es=<?php echo  $data[5] ;?>">Accion Propuesta</a></td>
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