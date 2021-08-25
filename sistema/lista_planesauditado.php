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
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
	
		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Plan de Acción</h1>
			<div style="justify-content:flex-start">
				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_noconformidades.php?id=<?php echo $iddetalleauditoria?>"  class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			</div>
		</div>


		<table>
			<tr>
				<th>Consecuencia</th>
				<th>Análisis Causa</th>
				<th>Desarrollo Método</th>
				<th>Causa Raíz</th>
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
		
			$query = mysqli_query($conection, "SELECT consecuencia, analisiscausa, desarrollometodo, causaraiz,idplandeaccion FROM plandeaccion pa, detalleclausula dc WHERE pa.iddetalleclausula=dc.iddetalleclausula AND  pa.iddetalleclausula=$iddetalleclausula LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
				
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><a style="color: #4099BF; font-weight: bold" href="lista_accionespendientes.php?idpa=<?php echo $data[4];?>&id=<?php echo $iddetalleclausula;?>&ida=<?php echo $iddetalleauditoria;?>">Acciones Propuesta</a></td>
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