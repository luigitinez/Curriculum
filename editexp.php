<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
backunlogged();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Experiencia</title>
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
	<center><h2>Experiencia Laboral</h2></center>
	<form action="php/editformex.php" method="POST">
		<legend>Añadir Experiencia Laboral</legend>
		<div class="form-group">
				<label>Centro de Trabajo</label>
				<input type="text" class="form-control" name="lugar" maxlength="100">
		</div>
		<div class="form-group">
				<label>Profesion Ejercida</label>
				<input type="text" class="form-control" name="prof" maxlength="100">
		</div>
		<div class="form-group">
				<label>Fecha de inicio</label>
				<input type="text" class="form-control datepicker" name="ini" data-provide="datepicker">
		</div>
		<div class="form-group">
				<label>Fecha de finalización</label>				
				<input type="text" class="form-control datepicker" name="fin" data-provide="datebicker">
		</div>
		<div class="form-group">
				<?php hiddenusr(); ?>
		</div>
		<div class="form-group">
				<input type="submit" name="expe" class="btn btn-primary pull-right" value="Añadir Formacion">
		</div>
	</form>
	<table class="table">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Centro Laboral</th>
                <th>Profesion Ejercida</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarexperiencias(); ?>
        </tbody>
    </table>

</div>

<script type="text/javascript" src="js/del.js"></script>
</body>
</html>