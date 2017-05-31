<?php 
include_once "php/common.php";
include_once "php/functions.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion Usuarios</title>
	<?php styles(); ?> 
</head>
<body>
<?php menu(); ?>
<div class="container">
<?php checkdel();?>
</div>

<center>
<div class="container">
<h1>Bandeja de Entrada</h1>
<div class="container">
     <table class="table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>

            </tr>
        </thead>
        <tbody>
        <?php mostrarMail(); ?>
        </tbody>
    </table>
