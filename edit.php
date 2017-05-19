<?php 
include_once "php/common.php";
include_once "php/functions.php";
include_once "php/MySQLDataSource.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<?php styles();?>
</head>
<body>
<?php menu(); ?>

<div class="container">
    <h2>Editar Perfil</h2>
    <!--Se muestra tabla de datos no editables-->
<table class="table noborder">
    <tr><td> <h4><span class="label label-default">Nombre:</span></h4></td>     <td> <h4><span class="label label-default">Correo:</span></h4></td> </tr>
    <tr><td> <h3><span class="label label-info"><?= $_SESSION['usr']->getname()." ".$_SESSION['usr']->getsurname();?></span></h3></td>       <td> <h3><span class="label label-info"><?= $_SESSION['usr']->getmail()?></span></h3></td></tr>
</table>
    <!-- fin tabla -->
    
      
    <form action="" method="POST">
        <input type="hidden" value=<?= "'".$_SESSION['usr']->getid()."'"; ?>>
                                    
        <div class='form-group'>
           <h4><lable class="label label-default">Profesión:</lable></h4>
                <?php makeselect(); ?>
        </div>
        <fieldset><legend>Cambiar Contraseña</legend>
        
         <h4><span class="label label-default">Contraseña:</span></h4>
        <div class='form-group'>
            <input type="password" name="pass" class="form-control">
        </div>
            <h4><span class="label label-default">Repetir Contraseña:</span></h4>
            <div class='form-group'>
                <input type="password" name="repeat" class="form-control" >
            </div>
        </fieldset>
        <input type="submit" class="btn pull-right">
    </form>
</div>


</body>
</html>