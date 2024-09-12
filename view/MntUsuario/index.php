<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Smartcredito HelpDesk - Mantenimiento Usuarios</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php");?>

	<!--Contenido -->
	<div class="page-content">
		<div class="container-fluid">
		<header class="section-header">
					<div class="tbl">
						<div class="tbl-row">
							<div class="tbl-cell">
								<h3>Mantenimiento Usuarios</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="../../view/Home">Home</a></li>
									<li class="active">Mantenimiento Usuarios</li>
								</ol>
							</div>
						</div>
					</div>
			</header>
			
			<div class="box-typical box-typical-padding">
			<button type="button" id="btnnuevo" class="btn btn-rounded btn-inline btn-primary-outline">Añadir Usuario</button>
				<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">Nombre</th>
							<th style="width: 10%;">Apellidos</th>
							<th style="width: 20%;">Correo</th>
							<th class="d-none d-sm-table-cell"style="width: 20%;">Contraseña</th>
							<th class="d-none d-sm-table-cell"style="width: 5%;">Rol</th>
							<th style="width: 3%;"></th>
							<th style="width: 3%;"></th>

						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!--Contenido -->
	<?php require_once("modalmantenimiento.php");?>    

    <?php require_once("../MainJs/js.php");?>      
	
	<script type="text/javascript" src="mntusuario.js"></script>                      
</body>
</html>
<?php
	} else {
		header("Location:". $ruta ."../../index.php");
	}