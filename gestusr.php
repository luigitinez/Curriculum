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
<h1>Gestión de Usuarios</h1>
<div class="container">
     <table class="table">
        <thead>
            <tr>
                <th class="hidden-xs">Nombre</th>
                <th class="hidden-xs">Apellido/s</th>
                <th>Mail</th>
                <th class="hidden-xs">Tipo</th>
                <th>Profesion</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarusuarios(); ?>
        </tbody>
    </table>

    <!--MODAL EDIT-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar</h4>
	      </div>
	      <div class="modal-body">
           <form class="form-horizontal" role="form">
        <!-- Esto imprime los campos con uss values segun el usr-->
          <div id="data-modal">
          </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="actualizar" class="btn btn-info">Actualizar</button>
                    </div>
                  </div>
           </form>
           <div class="row">
           <form action="" method="POST" >
                <div class="form-group pull-left">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="defpass" class="btn btn-success">Reiniciar Contraseña</button>
                    </div>
                </div>
           </form>
                      
        <form action="" method="POST" >
                <div class="form-group pull-left">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="defpic" class="btn btn-primary">Default Pic</button>
                    </div>
                  </div>

           </form>
           </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	<!--FIN-->



</center>
<script type="text/javascript" src="js/del.js"></script>
<script type="text/javascript" src="js/gestusr.js"></script>
</body>
</html>