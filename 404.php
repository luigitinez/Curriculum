<?php
include "php/common.php";
session_start();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Pagina No encontrada</title>
<?php styles(); ?>
<link rel="stylesheet" type="text/css" href="css/404.css"/>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <p><img src="media/404.jpg" class="img-responsive center-block" alt="error 404"></p>
                <h1>
                    Oops!</h1>
                <h2>
                    Página no encontrada</h2>
                <div class="error-details">
                   Lo sentimos, la página no fue encontrada
                </div>
                <div class="error-actions">
                    <a href="index.php" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span>Volver a Inicio 
                    </a>
                    <a href="contact.php" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-envelope"></span> Contactar con Soporte 
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>