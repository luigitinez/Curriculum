<?php
include_once 'php/functions.php';
include_once 'php/common.php';
session_start();
backlogged();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<?php styles(); ?>
	<link rel="stylesheet" type="text/css" href="css/style-reg.css">
</head>
<body>
<?php 
menu(); 
?>
<div class="container">
<?php


if(!empty($_GET['reg']) && strcasecmp($_GET['reg'],"true")==0){
?>
<div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Exito!</strong> Usted se registró correctamente. Revise su correo por favor.
</div>
<?php
}elseif(!empty($_GET['reg']) && strcasecmp($_GET['reg'],"false")==0){
?>

<div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> Usted no pudo ser registrado correctamente.
  </div>
<?php
	if(!empty($_SESSION['reg_error'])){
?>
		<div class="alert alert-danger  alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	Se olvidó los siguientes campos<br><a href="#" class="alert-link">
<?php
		foreach ($_SESSION['reg_error'] as $key => $value) {
			echo $key,"<br>";
		}
		unset($_SESSION['reg_error']);
?>
				</a>
			</div>
<?php
	}
}
if(isset($_GET["bbdd"])){//imprimir error de bbdd
?>
 <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>¡Error de conexión!</strong> No fue posible registrarle en la Base de Datos, pruebe mas tarde. Disculpe las molestias.
  </div>
<?php
}
if(isset($_GET["pass"])){//imprimir error de contraseñas no coinciden
?>
 <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>¡Error en Contraseña!</strong> No fue posible registrarle porque sus contraseñas no coinciden.
  </div>
<?php  
}
if(isset($_GET["usr"])&& isset($_GET['reg']) && strcasecmp($_GET['reg'],'false')==0){
?>
 <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>¡Error!</strong> No fue posible registrarle, ya existe un usuario usando el correo electrónico <?php echo $_GET['usr'];?>.
  </div>
<?php
}
?>
</div>
<div class="container">
			<div class="row main">
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="php/reg.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Nombre</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="nombre" id="name"  placeholder="Escriba su nombre" required/>
								</div>
							</div>
						</div>

						<div class="calendar">
			
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Apellido/s</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="apellido" id="username"  placeholder="Introduzca su Apellido/s" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Correo</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Introduzca su correo" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Contraseña</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="contrasena" id="password"  placeholder="Introduzca una Contraseña" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirmar Contraseña</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirmar" id="confirmar"  placeholder="Confirmar Contraseña" required/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit"  class="btn btn-primary btn-lg btn-block login-button" required/>
						</div>
						
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
</body>
</html>