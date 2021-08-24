<?php
session_start();
include "../conexion.php";
if ($_SESSION['rol'] != 3) {
    header("location: ./");
}

if (empty($_REQUEST['idpa']) ||empty($_REQUEST['id']) ||empty($_REQUEST['ida']) ) {
	header('Location: lista_planaccion.php');
	mysqli_close($conection);
}


$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];  
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Acciones Propuestas</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1 style="padding:20px 420px 20px 0px; ">Lista de acciones propuestas por el auditado </h1>
		<a href="registro_accionpropuesta.php?idpa=<?php echo $idplanaccion ?>" class="btn_new">Agregar Acción Propuesta</a>
		<a style="border: 2px solid #36A152; padding: 10px 30px; color: #ffffff; background-color: #36A152; border-radius: 6px;" href="lista_planaccion.php?id=<?php echo $iddetalleclausula ?> &ida=<?php echo $iddetalleauditoria ?> " class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
		
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
						<td><a style="color: #FF1F57; font-weight: bold" href="lista_anexoauditado.php?idap=<?php echo $data[0];?>&idpa=<?php echo $idplanaccion;?>&id=<?php echo $iddetalleclausula;?>&ida=<?php echo  $iddetalleauditoria ;?>">Agregar Anexo</a></td>

						<td>
							<a class="link_edit" href="editar_accionpropuesta.php?idap=<?php echo $data[0];?>&idpa=<?php echo $idplanaccion;?>&id=<?php echo $iddetalleclausula;?>&ida=<?php echo  $iddetalleauditoria ;?>">Editar</a>
							<a class="link_delete" href="eliminar_accionespropuestas.php?idap=<?php echo $data[0];?>&idpa=<?php echo $idplanaccion;?>&id=<?php echo $iddetalleclausula;?>&ida=<?php echo  $iddetalleauditoria ;?>">Eliminar</a>
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