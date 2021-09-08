<?php
session_start();
include "../conexion.php";

if (empty($_REQUEST['idap'])) {
	header('Location: lista_accionpropuesta.php');
	mysqli_close($conection);
}
$usu = $_SESSION['id_user'];
$idaccionpropuesta = $_REQUEST['idap'];
$idplanaccion = $_REQUEST['idpa'];
$iddetalleclausula = $_REQUEST['id'];
$iddetalleauditoria = $_REQUEST['ida'];
$estado = $_REQUEST['es'];

$sql = mysqli_query($conection, "SELECT rol FROM usuario WHERE id_user=$usu");
$num = mysqli_num_rows($sql);
if ($num > 0) {
	while ($po = mysqli_fetch_array($sql)) {
		$fda = $po[0];
	}
}
$rolusuario = intval($fda); //convierto en entero ya que fda es string


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de anexos</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div style="display: flex;  justify-content:space-between; margin: 20px 0px; ">
			<h1>Lista de anexos de la acción propuesta "<?php echo $idaccionpropuesta ?>"</h1>
			<div style="justify-content:flex-end">

				<?php if ($estado != 3 && $rolusuario != 2) { ?>
					<a style="border: 2px solid #0069D9;  color: #ffffff; background-color: #0069D9; border-radius: 6px;" href="registro_anexoauditado.php?idap=<?php echo $idaccionpropuesta ?>&idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>&es=<?php echo $estado ?>" class="btn_save">Agregar Anexo</a>
				<?php
				}  ?>

				<?php if ($rolusuario != 2) { ?>
					<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_accionpropuesta.php?idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>&es=<?php echo $estado ?>" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
				<?php
				} else { ?>
					<a style="border: 2px solid #36A152;  color: #ffffff; padding:10px 40px; background-color: #36A152; border-radius: 6px;" href="lista_accionespendientes.php?idpa=<?php echo $idplanaccion ?>&id=<?php echo $iddetalleclausula ?>&ida=<?php echo $iddetalleauditoria ?>" class="btn_save"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
				<?php
				}
				?>
			</div>
		</div>

		<table>
			<tr>
				<th>Acciones</th>
				<th>Nombre Anexo</th>
				<th>Anexo Url</th>
			</tr>
			<?php
			

			$query = mysqli_query($conection, "SELECT * FROM anexopropuestas  WHERE idaccionpropuesta=$idaccionpropuesta  ORDER BY idaccionpropuesta");
			
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
			?>

					<tr>


						<?php if ($estado == 3 ||  $rolusuario == 2) { ?>

							<td style="color: #687778;"><abbr title="Ya no puede editar este Plan">Editar Eliminar</abbr></td>
						<?php 	} else { ?>

							<td>
								<a class="link_edit" href="editar_anexoacciones.php?idx=<?php echo $data[0]; ?>&idap=<?php echo $idaccionpropuesta; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>&es=<?php echo $estado ?>">Editar</a>
								<a class="link_delete" href="eliminar_anexoacciones.php?idx=<?php echo $data[0]; ?>&idap=<?php echo $idaccionpropuesta; ?>&idpa=<?php echo $idplanaccion; ?>&id=<?php echo $iddetalleclausula; ?>&ida=<?php echo  $iddetalleauditoria; ?>&es=<?php echo $estado ?>">Eliminar</a>

							</td>
						<?php
						} ?>

						<td><?php echo $data[2];  ?></td>
						<td><a style="color: #40AEBF;" target="blank" href="<?php echo $data[3]; ?>"><?php echo $data[3]; ?></a></td>

					</tr>
			<?php
				}
			}
			?>
		</table>
		
	</section>
</body>

</html>