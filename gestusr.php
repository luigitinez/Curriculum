<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestionar Usuarios</title>
	<?php styles(); ?> 
</head>
<body>
<?php menu(); ?>
<div class="container">
<?php checkdel();?>
</div>

<center>
<div class="container">
<h1>Gestion de Usuarios</h1>
<div class="container">
     <table class="table">
        <thead>
            <tr>
                <th class="hidden-xs">Nombre</th>
                <th class="hidden-xs">Apellido/s</th>
                <th>Mail</th>
                <th class="hidden-xs">Tipo</th>
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