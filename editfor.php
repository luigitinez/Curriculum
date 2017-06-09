<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
backunlogged();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formacion</title>
	<?php styles();?>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

</head>
<body>
 <script>
  $( function() {
    $( ".datepicker" ).datepicker({
			 dateFormat: "yy-mm-dd"
	});
  } );
  </script>
<?php menu(); ?>

<div class="container">
<?php
	if(isset($_GET['empty'])){
?>
	<div class="alert alert-danger fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	Quedaron campos vacios, no se relizo ninguna inserción
	</div>
<?php
	}

?>
	<center><h2>Formación</h2></center>
	<form action="php/editformex.php" method="POST">
		<legend>Añadir Formación</legend>
		<div class="form-group">
				<label>Centro Formativo</label>
				<input type="text" class="form-control" name="lugar" maxlength="100" placeholder="Lugar Formación" value="<?if(isset($_SESSION['post']['lugar'])){ echo $_SESSION['post']['lugar'];}?>">
		</div>
		<div class="form-group">
				<label>Tipo de Estudios Cursados</label>
				<input type="text" class="form-control" name="prof" maxlength="100" placeholder="Estudios Cursados" value="<?if(isset($_SESSION['post']['prof'])){ echo $_SESSION['post']['prof'];}?>">
		</div>
		<div class="form-group">
				<label>Fecha de inicio de la Formación</label>
				<input type="text" class="form-control datepicker" name="ini" placeholder='Fecha Inicio' data-provide="datepicker" value="<?if(isset($_SESSION['post']['ini'])){ echo $_SESSION['post']['ini'];}?>">
		</div>
		<div class="form-group">
				<label>Fecha de finalización de la Formación</label>				
				<input type="text" class="form-control datepicker" name="fin" placeholder='Fecha Fin' value="<?if(isset($_SESSION['post']['fin'])){ echo $_SESSION['post']['fin'];}?>">
		</div>
		<div class="form-group">
<?php 		
			hiddenusr(); 
			unset($_SESSION['post']);
?>
		</div>
		<div class="form-group">
				<input type="submit" name="forma" class="btn btn-primary pull-right" value="Añadir Formacion">
		</div>
	</form>
	<table class="table">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Centro Formativo</th>
                <th>Estudios Cursados</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarformaciones(); ?>
        </tbody>
    </table>

</div>
<script type="text/javascript" src="js/del.js"></script>
</body>
</html>