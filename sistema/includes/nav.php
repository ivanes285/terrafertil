<nav>
			<ul>
			<li><a href="index.php">Inicio</a></li>
			<?php 
				if($_SESSION['rol'] == 1){
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
						<li><a href="listar_procesos.php">Lista de  Procesos</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Grupo Auditor</a>
					<ul>
						<li><a href="registro_grupo_auditor.php">Nuevo Grupo</a></li>
						<li><a href="lista_grupo_auditor.php">Lista de Grupos</a></li>
					</ul>
				</li>
				<?php } ?>	
			</ul>
		</nav>