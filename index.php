<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<?php styles(); ?> 
</head>
<body>
<?php menu(); ?>


<center>
<div class="container">
	<div class="form-group pull-right">
		<form action="php/selectcv.php" method="POST">
			<?php makeselect('index');?>
		</form>
	</div>
	<h1>Bienvenido a <i>Curriculum</i></h1>
	
	<div>
		<?php mostrarcv();?>
	</div>

</center>
</body>
</html>