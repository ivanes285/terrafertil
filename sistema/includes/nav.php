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
				<?php } ?>

				<li class="principal">
					<a href="#">Pasteles</a>
					<ul>
						<li><a href="registro_pastel.php">Nuevo Pastel</a></li>
						<li><a href="lista_pastel.php">Lista de  Pasteles</a></li>
					</ul>
				</li>

				<li class="principal">
					<a href="#">Pedidos</a>
					<ul>
						<li><a href="registro_pedido.php">Nuevo Pedido</a></li>
						<li><a href="lista_pedidos.php">Lista de Pedidos</a></li>
					</ul>
				</li>
				
				

				

			</ul>
		</nav>