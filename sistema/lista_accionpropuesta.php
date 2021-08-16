<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 3) {
    header("location: ./");
}

if (empty($_REQUEST['id'])) {
	header('Location: lista_planaccion.php');
	mysqli_close($conection);
}
$idplanaccion = $_REQUEST['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Acciones Propuestas</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de acciones propuestas por el auditado </h1>
		<a href="registro_accionpropuesta.php?id=<?php echo $idplanaccion ?>" class="btn_new">Agregar Acción Propuesta</a>
		<a style="border: 2px solid #36A152; padding: 6px 60px; color: #ffffff; background-color: #36A152; border-radius: 6px;" href="lista_planaccion.php" class="btn_save">Regresar</a>
		<table>
			<tr>
				<th>Acción Propuesta</th>
				<th>Responsable</th>
				<th>Fecha Propuesta</th>
				<th>Evidencias</th>
				<th>Anexo</th>
				<th>Acciones</th>
			</tr>
			<?php
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM accionespropuestas WHERE idplanaccion=$idplanaccion AND estadover=1");
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

			$query = mysqli_query($conection, "SELECT idaccionpropuesta,accionpropuesta,responsable,fechapropuesta,evidencia FROM accionespropuestas  WHERE idplanaccion=$idplanaccion AND estadover=1 ORDER BY idaccionpropuesta ASC LIMIT $desde,$por_pagina");
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
						<td><a style="color: #FF1F57; font-weight: bold" href="lista_anexopropuesto.php?id=<?php echo $data[0]; ?>">Agregar Anexo</a></td>

						<td>
							<a class="link_edit" href="editar_accion.php?ida=<?php echo $idplanaccion ?>">Editar</a>
							<a class="link_delete" href="eliminar_accion.php?id=<?php echo $idplanaccion ?>">Eliminar</a>
						</td>

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