<nav>
	<ul>
		<li><a href="index.php">Inicio</a></li>
		<?php
		if ($_SESSION['rol'] == 1) {
		?>
			<li class="principal">
				<a href="#">Usuarios</a>
				<ul>
					<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
					<li><a href="lista_usuario.php">Lista de Usuarios</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#">Procesos</a>
				<ul>
					<li><a href="registro_procesos.php">Nuevo Proceso</a></li>
					<li><a href="listar_procesos.php">Lista de Procesos</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#">Grupos</a>
				<ul>
					<li><a href="registro_grupo_auditor.php">Nuevo Grupo</a></li>
					<li><a href="lista_grupo_auditor.php">Lista de Grupos</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#">Grupo Auditores</a>
				<ul>
					<li><a href="registrodetallegrupo.php">Nuevo Grupo Auditor</a></li>
					<li><a href="listadetallegrupo.php">Lista de Grupos Auditores</a></li>
				</ul>
			</li>

			<li class="principal">
				<a href="#">Auditorias</a>
				<ul>
					<li><a href="registro_auditoria.php">Nueva auditoría</a></li>
					<li><a href="lista_detalleauditoria.php">Lista de Auditorias</a></li>

				</ul>
			</li>
		<?php } ?>

		<?php
		if ($_SESSION['rol'] == 2) {
		?>
			<li class="principal">
				<a href="#">Auditorias</a>
				<ul>
					<li><a href="lista_auditorvistapro.php">Auditorias Programadas</a></li>
					<li><a href="lista_auditorvistaeje.php">Auditorias Ejecutadas</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#">Acciones Correctivas</a>
				<ul>

					<li><a href="lista_auditorvistapro.php">Acciones Pendientes</a></li>
					<li><a href="lista_auditorvistapro.php">Acciones Cerradas</a></li>
				</ul>
				
			</li>
		<?php } ?>

		<?php
		if ($_SESSION['rol'] == 3) {
		?>
			<li class="principal">
				<a href="#">Incumplimientos</a>
				<ul>

					<li><a href="lista_auditadovista.php">Incumplimientos Pendientes</a></li>
				
				</ul>
				
			</li>

			<li class="principal">
				<a href="#">Planes</a>
				<ul>

					<li><a href="lista_planaccion.php">Planes de Acción</a></li>
				
				</ul>
				
			</li>
		<?php } ?>

	</ul>
</nav>