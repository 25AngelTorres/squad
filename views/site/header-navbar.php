<?php
	//Controlador de vista privada
	include ('../../controllers/controlSecurity.php');

	//Header
	include ('header.php');
?>

<body>

	<!-- Barra superior -->
	<nav class='navbar navbar-expand navbar-dark static-top'>
		<a class='navbar-brand text-white mr-1' href=''>iQMS</a>
		<button class='btn btn-link btn-sm text-white order-1 order-sm-0 sidebarToggle-leftbar' id='sidebarToggle-leftbar' href='#'>
			<i class='fas fa-bars'> </i>
		</button>
		
		<!-- buscador en barra superior -->
		<form class='d-none d-md-inline-block form-inline ml-auto mr-0' >
			<div class='input-group'>
			<!----
				<input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search"></i>
					</button>
				</div>
				--->
			</div>
		</form>
		
		<!-- Menú notificaciones/configuración -->
		<ul class='navbar-nav ml-auto ml-md-0'>
			
			<!-- Menú notificaciones --
			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<!---Icono de notificaciones---
					Crear función que obtenga el número de notificaciones sin leer para cada usuario
					--
					<span class="badge badge-danger">4444+</span>
					<i class="fas fa-bell fa-fw"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
					<!---Áreas para notificaciones---
					
					--
					<div class="dropdown-item notification">
						<div class="row">
							<h6>Actualización
							<a>
								<i class="far fa-window-close"></i>
							</a>
							</h6>
						</div>
						<div class="row">
							<p>Texto de notificacion
							</p>
						</div>
					</div>

					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
			------->
			
			<!-- Menú usuario -->
			<li class='nav-item dropdown no-arrow '>
				<a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					<!---Agregar aqui nombre de usuario--->
					<i class="fas fa-user-circle "> 
					</i>
				</a>
				<!-- Menú desplegable usuario -->
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="formSettingsUser.php">Settings</a>
					<!-- Barra divisor -->
					<div class="dropdown-divider"></div>
					<!-- Página logout -->
					<a class='dropdown-item' href="#" data-toggle="modal" data-target="#logoutModal" >Logout</a>
				</div>
			</li>
		</ul>
	</nav>
	
	<!-- Logout Modal-->
    <div class='modal fade' id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="logout.php">Logout</a>
				</div>
			</div>
		</div>
    </div>
	
	<!---Contenido--->
	<div class='wrapper'>
		
		<!-- sidebar-left -->
		<div id='sidebar-left' class=''>
			<!-- lista isos -->
			<ul	id='' class=''>
				<li>
					<a id='' class='' href='' role=''>
						<i class='far fa-eye'></i> 
						<spam><h5>Título 1</h5></spam>
					</a>
					<!-- lista procedimientos -->
					<div>
						<ul id='' class='navbar-nav'>
							<li class='nav-item'>
								<a class="nav-link" href=" ">
									<i class=""></i>
									<span>Manage Documentation</span>
								</a>
							</li>
							<li>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a id='' class='' href='' role=''>
						<i class='fab fa-envira'></i> 
						<spam>
							<h5>
								Título 2
							</h5>
						</spam>
					</a>
				</li>
				<li>
					<a id='' class='' href='' role=''>
						<i class='fas fa-cogs'></i>
						<span>
							<h5>
								Configurar
							</h5>
						</span>
					</a>
				</li>
			</ul><!-- lista isos -->
		</div>
	
		<!-- Sidebar --
		<div id='sidebar-left' class=''>
		
		
		
		
		<!-- 
			<ul class=''>
				<li class=''>
					<a id='iso1'	class ='' href='' >
						<div class='nav-item-icon' id=''>
						<i class='far fa-eye'></i> 
						
						<span><h5>ISO 9001</h5></span>
					</a>
					<div id='' class='sub-navbar-nav' >
						<ul class='' id='1'>
							<li class='nav-item dropdown'>
								<a id='dropdown-toggle' class='nav-link dropdown-toggle' role='bottom'>
									<span>
										Algo 1
									</span>
								</a>
								
								<div id='menu-dropdown-toggle' class='dropdown-menu'>
									<h6 class='dropdown-header'>
										Título 1
									</h6>
									<a class='dropdown-item' href=''>
										algo 1.1
									</a>
									<a class='dropdown-item' href=''>
										algo 1.2
									</a>
									
									<div class='dropdown-divider'></div>
									
									<h6 class='dropdown-header'>
										Título 2
									</h6>
									<a class='dropdown-item' href=''>
										algo 2.1
									</a>
									
								</div>
								
							</li>
							<li class=''>
								Algo 2
							</li>
							<li class=''>
								Algo 3
							</li>
						</ul>
					</div>
				
				</li>
				<li class='nav-item'>
					<a class ='nav-link' href='' id='50001'>
						<i class='fab fa-envira'></i> 
						<span><h5>ISO 50001</h5></span>
					</a>
				
				</li>
			</ul>
		--
			
			<div class='bottom nav-item'>
				<a class ='nav-link' href='config-user.php' id='tools'>
					<i class='fas fa-cogs'></i>
					<span> Sidebar</span>
				</a>
			</div>
		</div>
		
		
		<!--
		<nav id='sidebar-left' class=''>
			<div class='sidebar-header'>
				<!-- Encabezado de sidebar --
				<h3>Bootstrap Sidebar</h3>
				<strong>BS</strong>
			</div>
			
			<ul class="list-unstyled components">
				<li class="active">
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="fas fa-home"></i>
						Home
					</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li>
							<a href="#">Home 1</a>
						</li>
						<li>
							<a href="#">Home 2</a>
						</li>
						<li>
							<a href="#">Home 3</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">
						<i class="fas fa-briefcase"></i>
						About
					</a>
					<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="fas fa-copy"></i>
						Pages
					</a>
					<ul class="collapse list-unstyled" id="pageSubmenu">
						<li>
							<a href="#">Page 1</a>
						</li>
						<li>
							<a href="#">Page 2</a>
						</li>
						<li>
							<a href="#">Page 3</a>
						</li>
					</ul>
				</li>
			</ul>		
		</nav>
		
	
	
	<!---wrapper continua-->