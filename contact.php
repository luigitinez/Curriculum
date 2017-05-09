<?php 
include "php/common.php";
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


    <div class="col-lg-offset-4 col-lg-4" id="panel">
        <h2>Contacte con nosotros</h2>

        <form>

            <div class="group">
                <input type="text" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Name</label>
            </div>

            <div class="group">
                <input type="text" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email</label>
            </div>

            <div class="group">
                <input type="text" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Numero de Telefono</label>
            </div>

            <div class="group">
                <input type="text" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Mensaje</label>
            </div>
            <div class="group">
                <center> <button type="submit" class="btn btn-warning">Send <span class="glyphicon glyphicon-send"></span></button></center>
            </div>
        </form>

    </div>
</div>
</body>
</html>