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
if(isset($_POST)){
    //checkforsend($_POST);
   /* foreach ($_POST as $key => $value) {
        echo $key." ".$value."<br>";
    }*/
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
                <center><button type="submit" class="btn btn-warning">Enviar <span class="glyphicon glyphicon-send"></span></button></center>
            </div>
        </form>

    </div>
</div>
</body>
</html>