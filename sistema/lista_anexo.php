<?php
session_start();
include "../conexion.php";

if (empty($_REQUEST['id'])) {
	header('Location: formulario_clausulas.php');
	mysqli_close($conection);
}

$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['da'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de anexos</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de anexos de la clausula id número "<?php echo $iddetalleclausula ?>" </h1>
		<a href="registro_anexo.php?id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria ?> " class="btn_new">Agregar Anexo </a>
		<a style="border: 2px solid #36A152; padding: 6px 60px; color: #ffffff; background-color: #36A152; border-radius: 6px;"  href="formulario_clausulas.php?id=<?php echo $iddetalleauditoria ?>" class="btn_save">Regresar</a>
		<table>
			<tr>
				<th>Acciones</th>
				<th>Nombre Anexo</th>
				<th>Anexo Url</th>

			</tr>
			<?php

			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM anexo WHERE iddetalleclausula=$iddetalleclausula  ");
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

			$query = mysqli_query($conection, "SELECT * FROM anexo  WHERE iddetalleclausula=$iddetalleclausula  ORDER BY idanexo ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>

					<tr>
						<td>
							<a class="link_edit" href="editar_anexo.php?ida=<?php echo $data[0]; ?>&id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria ?>">Editar</a>
							<a class="link_delete" href="eliminar_anexo.php?ida=<?php echo $data[0]; ?>&id=<?php echo $iddetalleclausula ?>&da=<?php echo $iddetalleauditoria ?>">Eliminar</a>

						</td>
			
						<td><?php echo $data[2];  ?></td>
						<td><a style="color: #40AEBF;" href="<?php echo $data[3]; ?>"><?php echo $data[3]; ?></a></td>

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