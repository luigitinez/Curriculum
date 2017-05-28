<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
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
    $( "#datepicker" ).datepicker();
  } );
  </script>
<?php menu(); ?>

<div class="container">
	<h2>Formacion</h2>
	<form action="" method="POST">
		<legend>Añadir Formacion</legend>
		<div class="form-group">
				<label>Centro Formativo</label>
				<input type="text" class="form-control" name="lugar" maxlength="100" placeholder="Lugar Formación">
		</div>
		<div class="form-group">
				<label>Tipo de Estudios Cursados</label>
				<input type="text" class="form-control" name="prof" maxlength="100" placeholder="Estudios Cursados">
		</div>
		<div class="form-group">
				<label>Fecha de inicio de la Formacion</label>
				<input type="text" class="form-control" placeholder='Fecha Inicio' data-provide="datepicker" id="datepicker">
		</div>
		<div class="form-group">
				<label>Fecha de finalización de la Formacion</label>				
				<input type="text" class="form-control" placeholder='Fecha Fin' id="datepicker">
		</div>
		<div class="form-group">
				<?php hiddenusr(); ?>
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
                <th>Profesion Ejercida</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarformaciones(); ?>
        </tbody>
    </table>

</div>
</body>
</html>