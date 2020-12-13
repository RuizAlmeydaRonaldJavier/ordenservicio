<!DOCTYPE html>
<html lang="es">
  <head>
		<!-- Etiquetas <meta> obligatorias para Bootstrap -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Sistema EOR</title>
				
		<!-- Css -->
		<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="../asset/css/tema.css">
		<link rel="stylesheet" href="../asset/css/tempusdominus-bootstrap-4.min.css" />
		<link rel="stylesheet" href="../asset/css/from_tab.css"> 
		<link rel="stylesheet" href="../asset/vendor/datatables/datatables.min.css">
		<!-- Css -->

		<style type="text/css">
			td.centrar-contenido
			{
			  vertical-align: middle;
			}

			table.dataTable
			{
			    border-spacing: 0;
			}

			div.dataTables_wrapper
			{
				padding-left: 0;
				padding-right: 0;
			}

			.alinear-derecha
			{
				float: right;
			}

			.menu-titulo
			{
				color: #ffffff;
				font-size: 14px;
			}

			.campo-altura
			{
				height: 40px;
			}

			.marco
			{
				border: 1px solid #B2BABB;
				border-radius: 5px;
			}
		</style>
	</head>
	<body>
		<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-darkl mb-3">
			<div class="flex-row d-flex">
				<button type="button" class="navbar-toggler mr-2" data-toggle="offcanvas" title="Toggle responsive left sidebar">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse" id="collapsingNavbar">
				<ul class="navbar-nav mr-auto"></ul>
				<div class="titulo-usuario">
					<h4 class="text-center">PORTAL ADMINISTRATIVO</h4>
				</div>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="../utilidades/cerrar_session.php"><i class="fas fa-sign-in-alt"></i></a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid" id="main">
			<div class="row row-offcanvas row-offcanvas-left">
				<div class="sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
					<ul class="nav flex-column sticky-top pl-0 pt-5 mt-3 menu-adm">
						<div class="navbar-nav mt-4" style="align-items: center;">
							<div class="nav-item">
								<img src="../asset/img/logo-mpch.png" class="img-fluid img-logo" height="60px">
							</div>
						</div>
						<div class="user-panel" style="align-items: center;">
							<div class="float-left image ml-4">
								<img src="https://creamas.org/wp-content/themes/creamas/image/comment_avatar.png" class="rounded-circle" alt="User Image">
							</div>
							<div class="float-left info ml-4">
								<p><?php echo $_SESSION['usuario'] ?></p>
								<strong id="u-nombre"></strong>
								<a><i class="fas fa-bell"></i> ADMINISTRADOR</a>
							</div>
						</div>
						<div class="divider-li pt-2 pb-2 mt-2 menu-titulo">
							<i class="fas fa-boxes"></i>GESTION DE ÓRDENES DE SERVICIO
						</div>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../ordenServicio/listarOrdenServicio.php">Órdenes de Servicio</a>
						</li>
						<div class="divider-li pt-2 pb-2 mt-2 menu-titulo">
							<i class="fas fa-boxes"></i>GESTION DE ÓRDENES DE COMPRA
						</div>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../ordenCompra/listarOrdenCompra.php">Órdenes de Compra</a>
						</li>
						<!--<div class="divider-li pt-2 pb-2 mt-2 menu-titulo">
							<i class="fas fa-boxes"></i>GESTION DE PECOSA
						</div>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="agregar_ambiente.php">Pecosa</a>
						</li>-->
						<div class="divider-li pt-2 pb-2 mt-2 menu-titulo">
							<i class="fas fa-boxes"></i>MANTENIMIENTO
						</div>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../proveedor/listarProveedor.php">Proveedores</a>
						</li>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../meta/listarMeta.php">Metas</a>
						</li>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../producto/listarProducto.php">Productos</a>
						</li>
						<div class="divider-li pt-2 pb-2 mt-2 menu-titulo">
							<i class="fas fa-boxes"></i>SEGURIDAD
						</div>
						<li class="">
							<i class="fas fa-plus-circle"></i>
							<a href="../usuario/listarUsuario.php">Usuarios</a>
						</li>
					</ul>
				</div>
				<div class="col main mt-5 mt-3">