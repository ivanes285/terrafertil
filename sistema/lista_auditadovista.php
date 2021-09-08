<?php
session_start();
include "../conexion.php";
$usu = $_SESSION['id_user'];

if (empty($_REQUEST['ida'])) {
	header('Location: lista_inclumplimientospe.php');
	mysqli_close($conection);
}
$iddetalleauditoria = $_REQUEST['ida'];

$estado;
$query2 = mysqli_query($conection, "SELECT estado FROM detalleauditoria WHERE iddetalleauditoria= $iddetalleauditoria");
			
			$result2 = mysqli_num_rows($query2);
			if ($result2 > 0) {
				while ($data2 = mysqli_fetch_array($query2)) {
				$estado=$data2[0];
			?>
			
					
			<?php
				}
			}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Incumplimientos </title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Lista de Incumplimientos</h1>
			<div style="justify-content:flex-start">
			<?php
			if($estado==2)
			{
			?>
			<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_inclumplimientospe.php" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
			<?php }
			else 
			{
			?>
				<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_inclumplimientosarchi.php" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
				<?php }	?>

				
			</div>
		</div>
		<table>
			<tr>

				<th>Clausula</th>
				<th>Detalle Clausula</th>
				<th>Descripción Incumplimiento</th>
				<th>Plan de Acción</th>
				<th>Estado Plan</th>

			</tr>
			<?php
			
			

			


			
			$query = mysqli_query($conection, "SELECT clausula,detalleclausula,desincumplimiento,iddetalleclausula,dc.planaccion,da.iddetalleauditoria,estadoplan FROM detalleauditoria da, norma n, clausula c,detalleclausula dc ,procesos p WHERE da.iddetalleauditoria=dc.iddetalleauditoria AND c.idclausula=dc.idclausula AND n.idnorma=c.idnorma AND p.idproceso=c.idproceso AND p.liderproceso=$usu AND dc.parametroscalificacion<>'cumple' AND da.iddetalleauditoria=$iddetalleauditoria  ORDER BY nombrenorma,codigoauditoria");

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
							<td><a style="color: #00CC63; font-weight: bold" href="lista_planaccion.php?id=<?php echo $data[3]; ?>&ida=<?php echo $iddetalleauditoria ?> ">PLAN</a></td>
						<?php
						}
						?>


						<?php
						if ($data[4] == 2 && $data[6] == 2) {
						?>
							<td style="font-size: 35px; text-align: center; color: #687778;"><abbr title="El plan está cerrado"><i class="fas fa-lock"></i></abbr></td>
						<?php
						} else if ($data[4] == 2 && $data[6] == 1) {
						?>
							<td style="font-size: 35px; text-align: center; color: #33BDCA;"><a style="color: #33BDCA; font-weight: bold"><abbr title="El Plan está Abierto"><i class="fas fa-lock-open"></i></abbr></a> </td>
						<?php
						} else { ?>
							<td style="font-size: 35px; text-align: center; color: #33BDCA;"><a style="color: #C95E7D; font-weight: bold" href="#"><abbr title="No Existe un Plan"><i class="fas fa-lock-open"></i></abbr></a> </td>
						<?php
						}
						?>




					</tr>
			<?php
				}
			}
			?>
		</table>
		
	</section>

</body>

</html>