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
        <div class="form-group">
            <h4><span class="label label-default">Nombre:</span></h4>
           <h3><span class="label label-info"><?= $_SESSION['usr']->getname()." ".$_SESSION['usr']->getsurname();?></span></h3>
        </div>
        <div class="form-group">
            <h4><span class="label label-default">Correo:</span></h4>
           <h3><span class="label label-info"><?= $_SESSION['usr']->getmail()?></span></h3>
        </div>
    <form action="" method="POST">
        
        <div class='form-group'>
            <lable class="label label-default">Profesión:</lable>
                <?php makeselect(); ?>
        </div>

            <input type="submit" class="btn pull-right">
    </form>
</div>


</body>
</html>