<?php

if (empty($_SESSION['activo'])) {
    header('location: ../');
}
?>

<header>
		<div class="header">
			<h1 class="relleno">Sistema de Gestión de Auditoria</h1>
			<div class="optionsBar">
				<p>Tabacundo,<?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="exit.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Cerrar Sesión"></a>
			</div>
		</div>
    <?php include "nav.php";?>
	</header>

	<div class="modal">
   <div class="bodyModal">
	   
   </div>

	</div>