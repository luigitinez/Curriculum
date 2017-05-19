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
<h1>Gestion de Usuarios</h1>
<div class="container">
     <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido/s</th>
                <th>Mail</th>
                <th>Tipo</th>
                <th>Profesion</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarusuarios(); ?>
        </tbody>
    </table>
</div>

</center>
</body>
</html>