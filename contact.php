<?php 
include_once "php/common.php";
//include "php/funcion_enviarcorreo.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<?php styles();?>
	<link rel="stylesheet" type="text/css" href="css/style-contact.css">
</head>
<body>
<?php menu(); ?>
<div class="container">
<?php
if(isset($_POST['enviar'])){
    //si se ha echo post se intenta enviar un correo al administrador (hacer un registro dentro de la bbdd)
    $result=sendAdminMail();
    //dependiendo de si se hizo con exito el envio del mail
    if($result){
?>
        <div class="alert alert-success">
            <strong>Exito!</strong> El correo se envió correctamente al administrador.
        </div>
<?php
    }else{
?>
        <div class="alert alert-warning">
            <strong>Error!</strong> El correo no pudo ser enviado, pruebe más tarde.
        </div>
<?php
    }

}
?>

    <div class="col-lg-offset-4 col-lg-4" id="panel">
        <h2>Contacte con nosotros</h2>

        <form method="POST" action="">

            <div class="group">
                <input type="text" name="name" value='<?php if(isset($_SESSION['usr'])){ echo $_SESSION['usr']->getname().' '.$_SESSION['usr']->getsurname();}?>' required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Name</label>
            </div>

            <div class="group">
                <input type="text" name="mail" value='<?php if(isset($_SESSION['usr'])){ echo $_SESSION['usr']->getmail();}?>' required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email</label>
            </div>

            <div class="group">
                <input type="text" name="tel" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Numero de Telefono</label>
            </div>

            <div class="group">
                <input type="text" name="message" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Mensaje</label>
            </div>
            <div class="group">
                <center><button type="submit" name="enviar" class="btn btn-warning">Enviar <span class="glyphicon glyphicon-send"></span></button></center>
            </div>
        </form>

    </div>
</div>
</body>
</html>