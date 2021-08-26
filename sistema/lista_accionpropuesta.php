<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 3) {
	header("location: ./");
}

if (empty($_REQUEST['idpa']) || empty($_REQUEST['id']) || empty($_REQUEST['ida'])) {
	header('Location: lista_planaccion.php');
	mysqli_close($conection);
}


$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];
$estado = $_REQUEST['es'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Acciones Propuestas</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Lista de acciones propuestas por el Auditado </h1>
			<div style="justify-content:flex-end">

				<?php if ($estado != 3) { ?>
					<a style="border: 2px solid #0069D9;  color: #ffffff; background-color: #0069D9; border-radius: 6px;" href="registro_accionpropuesta.php?idpa=<?php echo $idplanaccion ?>" class="btn_save">Agregar Acción Propuesta</a>
				<?php
				}  ?>

				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_planaccion.php?id=<?php echo $iddetalleclausula ?> &ida=<?php echo $iddetalleauditoria ?> &es=<?php echo $estado ?> " class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			</div>
		</div>



		<table>
			<tr>
				<th>Acción Propuesta</th>
				<th>Responsable</th>
				<th>Fecha Propuesta</th>
				<th>Evidencias</th>
				<th>Anexo</th>
				<th style="text-align:center">Estatus</th>
				<th>Acciones</th>
			</tr>
			<?php
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM accionespropuestas WHERE idplanaccion=$idplanaccion ");
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

			$query = mysqli_query($conection, "SELECT idaccionpropuesta,accionpropuesta,responsable,fechapropuesta,evidencia,status FROM accionespropuestas  WHERE idplanaccion=$idplanaccion ORDER BY idaccionpropuesta ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>

					<tr>
						<td><?php echo $data[1];  ?></td>
						<td><?php echo $data[2];  ?></td>
						<td><?php echo $data[3];  ?></td>
						<td><?php echo $data[4];  ?></td>

						<?php if ($estado == 3) { ?>
							<td><a style="color: #4099BF; font-weight: bold" href="lista_anexoauditado.php?idap=<?php echo $data[0]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>&es=<?php echo  $estado ?> ">Ver</a></td>
						<?php
						} else { ?>
							<td><a style="color: #FF1F57; font-weight: bold" href="lista_anexoauditado.php?idap=<?php echo $data[0]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>&es=<?php echo  $estado ?> ">Agregar </a></td>
						<?php
						} ?>

						<?php
						if ($data[5] == "aceptado") { ?>
							<td style="background-color: #00CC63; color: #FFFFFF; font-weight: bold; text-align:center; "><?php echo $data[5];  ?></td>
						<?php
						} else if (!isset($data[5]) || $data[5] == null) { ?>
							<td><?php echo $data[5]; ?></td>
						<?php
						} else { ?>
							<td style="background-color: #FF1F57; color:#FFFFFF; font-weight: bold; text-align:center;"><?php echo $data[5];  ?></td>
						<?php
						}
						?>

						<?php if ($estado == 3) { ?>
							<td>
								<a style="text-align: center; color: #687778;"><abbr title="Ya no puede editar o eliminar este Plan">Editar Eliminar</abbr></a>

							</td>
						<?php
						} else { ?>
							<td>
								<a class="link_edit" href="editar_accionpropuesta.php?idap=<?php echo $data[0]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>">Editar</a>
								<a class="link_delete" href="eliminar_accionespropuestas.php?idap=<?php echo $data[0]; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>">Eliminar</a>
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