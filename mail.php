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
<style type="text/css">
    td, th {

    text-align: left;
    padding: 8px;
}
tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
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
<?php
    if(isset($_GET['result'])){
        if($_GET['result']==1){
            echo "<div class='alert alert-success'><strong>Correo Borrado correctamente</strong></div>";
        }else{
            echo "<div class='alert alert-danger'><strong>Error, no se ha podido borrar el correo</strong></div>";
        }
    }
?>
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
</div>
<script type="text/javascript" src="js/del.js"></script>
</body>
</html>