<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usu_id"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Smartcredito HelpDesk - Detalle Ticket</title>
<head lang="es">>
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
							<h3 id="lblnomidticket"></h3>
							<div id="lblestado"></div>
							<div id="lbltipo"></div>
							<span class="label label-pill label-primary" id="lblnomusuario"></span>
							<span class="label label-pill label-info" id="lblfechcrea"></span>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Detalle Ticket</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<div class="row">

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="lblcategoria">Categoria</label>
								<input type="text" class="form-control" id="lblcategoria" readonly>
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="lbltitulo">Titulo</label>
								<input type="text" class="form-control" id="lbltitulo" readonly>
							</fieldset>
						</div>

						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="lbldescrip">Descripción</label>
								<div class="summernote-theme-1">
								<textarea id="lbldescrip" name="lbldescrip" class="summernote" ></textarea>
							</div>
							</fieldset>
						</div>							
				</div>

			</div>
	</div>

			<section class="activity-line" id="lbldetalle">

			</section>

			<div class="box-typical box-typical-padding" id="pnldetalle">

				<p>
					Ingrese su duda o consulta.
				</p>

				<div class="row">

						<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold" for="tickd_descrip">Descripción</label>
							<div class="summernote-theme-1">
								<textarea id="tickd_descrip" name="tickd_descrip" class="summernote" ></textarea>
							</div>
						</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
							<button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerra Ticket</button>		
						</div>
				</div>

			</div>
	</div><!--Contenido -->

    <?php require_once("../MainJs/js.php");?>      
	
	<script type="text/javascript" src="detalleticket.js"></script>                      
</body>
</html>
<?php
	} else {
		header("Location:". $ruta ."../../index.php");
	}