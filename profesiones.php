<?php
include_once "php/functions.php";
include_once "php/common.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editar Profesiones</title>
	<?php styles(); ?> 
</head>
<body>
<?php menu(); ?>
<div class="container">
<?php checkeditprof();?>
</div>

<center>
<div class="container">
<h1>Edicion de Profesiones</h1>
<div class="container">
     <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th><th>
               
            </tr>
        </thead>
        <tbody>
        <form method="POST" action="php/addprof.php">
        <td> <input type="text" name="prof"> </td>
        <td> <input type="submit" class="btn btn-primary" value="Añadir"> </td>       
        </form>         
        </tbody>
    </table>
     <table class="table">
        <thead>
            <tr>
                <th class="hidden-xs">Id_Profesion</th>
                <th>Nombre</th>
                <th>Veces usada</th>
                <th><th>
               
            </tr>
        </thead>
        <tbody>
        <?php mostrarprofesiones(); ?>
        </tbody>
    </table>
</div>

</center>
</body>
</html>