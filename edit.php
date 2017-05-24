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
    <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/fileinput.js" type="text/javascript"></script>
</head>
<body>
<?php 
        menu(); 
        passerrors();
        if(isset($_GET['edit']) && $_GET['edit']==false){
            echo "<div class='container'>
			<div class='alert alert-warning alert-dismissable fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					No se enviaron datos para actualizar
			</div>
		</div>";
        }
?>
<div class="container">
    <h2>Editar Perfil </h2>
    <!--Se muestra tabla de datos no editables visible en version no movil-->
<table class="table hidden-xs">
    <tr><td> <h4><span class="label label-default">Nombre:</span></h4></td>     <td> <h4><span class="label label-default">Correo:</span></h4></td> </tr>
    <tr><td> <h3><span class="label label-info"><?= $_SESSION['usr']->getname()." ".$_SESSION['usr']->getsurname();?></span></h3></td>       <td> <h3><span class="label label-info"><?= $_SESSION['usr']->getmail()?></span></h3></td></tr>
</table>
    <!-- fin tabla -->
<div class="visible-xs">
    <h4><span class="label label-default">Nombre:</span></h4>
    <h3><span class="label label-info"><?= $_SESSION['usr']->getname()." ".$_SESSION['usr']->getsurname();?></span></h3>
        <h4><span class="label label-default">Correo:</span></h4>
    <h3><span class="label label-info"><?= $_SESSION['usr']->getmail();?></span></h3>

</div>   
    <form action="php/editusr.php" method="POST">
        <img class="img-edit"  src=<?= "'".$_SESSION['usr']->getpic()."'"; ?>>     
        <div class="caption"><button type="submit" name="default" class="btn btn-info" style="width:200px;"><i class="glyphicon glyphicon-user"> </i> Default Picture</button></div>
    </form>
    <form action="php/editusr.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h4><span class="label label-default">Cambiar Imágen:</span></h4>
            <input id="file-2" type="file" class="file" name="imagen" accept="image/*" multiple=true data-preview-file-type="any">
            <script>
            $("#file-2").fileinput({
            showCaption: true,
            showUpload: false,


            });
            </script>
        </div>
        <input type="hidden" value=<?= "'".$_SESSION['usr']->getid()."'"; ?>>
                                    
        <div class='form-group' >
           <h4><lable class="label label-default" >Profesión:</lable></h4>
                <?php makeselect(); ?>
        </div>
        <fieldset><legend>Cambiar Contraseña</legend>
        <h4><span class="label label-default">Contraseña Actual:</span></h4>
        <div class='form-group'>
            <input type="password" name="oldpass" class="form-control">
        </div>
         <h4><span class="label label-default">Contraseña:</span></h4>
        <div class='form-group'>
            <input type="password" name="newpass" class="form-control">
        </div>
            <h4><span class="label label-default">Repetir Contraseña:</span></h4>
            <div class='form-group'>
                <input type="password" name="repeatpass" class="form-control" >
            </div>
        </fieldset>
        <input type="submit" name="submit" class="btn pull-right">
    </form>
</div>


</body>
</html>