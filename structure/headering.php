 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-inner">
		<div class="container-fluid" >
			<a class="brand pull-left" href="mio_all.php" >OLPESA</a>
			<ul class="nav navbar-nav user_menu pull-right">
				
				<li class="divider-vertical hidden-sm hidden-xs"></li>
				<li class="divider-vertical hidden-sm hidden-xs"></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user_avatar.png" alt="" class="user_avatar"><?php echo $_SESSION['operatoralias']; ?>
						<b class="caret"></b></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a href="#">Mi Perfil</a></li>
						<li>
							<a href="#">Permisos</a></li>
						<li class="divider"></li>
						<li>
							<a id="logoutall" href="mall_login.php">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
