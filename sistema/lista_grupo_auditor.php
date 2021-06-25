<?php 
	session_start();
	include "../conexion.php";	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Grupos Auditores</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
    <h1>Lista de Grupos Auditores</h1>
 <a href="registro_grupo_auditor.php" class="btn_new">Ingresar Grupo</a>

<table>
<tr>
    <th>ID</th>
    <th>Nombre Grupo</th>
    <th>Auditor Lider</th>
	<th>Norma</th>
	
</tr>
 <?php

$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM grupoauditor");
$result_register = mysqli_fetch_array($sql_registe);
$total_registro = $result_register['total_registro'];
$por_pagina = 5;
if(empty($_GET['pagina']))
{
    $pagina = 1;
}else{
    $pagina = $_GET['pagina'];
}
$desde = ($pagina-1) * $por_pagina;
$total_paginas = ceil($total_registro / $por_pagina);

//$query = mysqli_query($conection, "SELECT * FROM grupoauditor ORDER BY idgrupo ASC LIMIT $desde,$por_pagina");
 $query = mysqli_query($conection, "SELECT * FROM grupoauditor g, usuario u where g.idusuario=u.id_user ORDER BY idgrupo ASC LIMIT $desde,$por_pagina");
 //$query2 = mysqli_query($conection, "SELECT u.user FROM usuario u INNER JOIN grupoauditor gp where u.id_user=gp.idusuario ORDER BY gp.idgrupo ASC LIMIT $desde,$por_pagina");
mysqli_close($conection);
$result=mysqli_num_rows($query);

 if($result>0){
    while($data=mysqli_fetch_array($query)){
      ?>
<tr>
    <td><?php echo $data["idgrupo"]; ?></td>
    <td><?php echo $data["nombregrupo"] ;  ?></td>
    <td><?php echo $data["user"]; ?></td>
	<td><?php echo $data["idnorma"];?></td>
	
    <td>
        <a class="link_edit" href="editar_pastel.php?id=<?php echo $data["id_pastel"]; ?>">Editar</a>
	   
		<?php if ($_SESSION['rol']==1){?>
		|
		<a class="link_delete" href="eliminar_pastel.php?id=<?php echo $data["id_pastel"]; ?>">Eliminar</a>
		
	   <?php }?>
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
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
	</section>

</body>
</html> 