<?php

include_once "php/MySQLDataSource.php";
include_once "php/functions.php";
include_once "php/common.php";
session_start();
if(isset($_GET['id'])){
    $usrdisplay = usrconsult($_GET['id']);
    if(!$usrdisplay || $usrdisplay['FK_id_prof']==0){//si no existe el usuario o este aún no ha definido su profesion
        nocvusr();
    }else{//el usuario existe, aqui se cargan los datos de las demás tablas como experiencias y formaciones

    }
}else{//envia a raiz si no se llega con un GET
    header('Location: http://' . $_SERVER['HTTP_HOST'] ); 	
}
?>
<html>
<head>
    <title>Perfil de Curriculum</title>
    <?php styles();?>
    <link rel="stylesheet" type="text/css" href="css/cv.css"/>

</head>
<body>
<?    
menu();
?>
<div class="container">
<div class="resume">
    <header>
    <h1 class="page-title text-center">Curriculum de <?= $usrdisplay['name'].' '.$usrdisplay['surname']?></h1>
  </header>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
    <div class="panel panel-default">
      <div class="panel-heading resume-heading">
        <div class="row">
          <div class="col-lg-12">
            <div class="col-xs-12 col-sm-4">
              <figure>
                <img class="img-circle img-responsive" alt="" src="media/usrimg/<?= $usrdisplay['pic']?>">
              </figure>
              
              
              
            </div>

            <div class="col-xs-12 col-sm-8">
              <ul class="list-group">
                <li class="list-group-item"><?= $usrdisplay['name'].' '.$usrdisplay['surname']?></li>
                <li class="list-group-item"><?= $usrdisplay['nombre_profesion']?></li>
               
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="bs-callout bs-callout-danger">
        <h4>Presentacion</h4>
        <p>
         Lorem ipsum dolor sit amet, ea vel prima adhuc, scripta liberavisse ea quo, te vel vidit mollis complectitur. Quis verear mel ne. Munere vituperata vis cu, 
         te pri duis timeam scaevola, nam postea diceret ne. Cum ex quod aliquip mediocritatem, mei habemus persecuti mediocritatem ei.
        </p>
        <p>
            Odio recteque expetenda eum ea, cu atqui maiestatis cum. Te eum nibh laoreet, case nostrud nusquam an vis. 
            Clita debitis apeirian et sit, integre iudicabit elaboraret duo ex. Nihil causae adipisci id eos.

        </p>
      </div>
      
      <?php  ?>
  <div class="bs-callout bs-callout-danger">
     <h4>Experiencias Laborales</h4>
     <table class="table table-striped table-responsive ">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Centro Laboral</th>
                <th>Profesion Ejercida</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php mostrarexperiencias($_GET['id']); ?>
        </tbody>
    </table>
  </div>
  <div class="bs-callout bs-callout-danger">
    <h4>Formación Académica</h4>
    <table class="table table-striped table-responsive ">
            <thead>
        <tr>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Centro Formativo</th>
            <th>Estudios Cursados</th>
            <th></th>
        </tr>
      </thead>
      <tbody>
      <?php mostrarformaciones($_GET['id']); ?>
      </tbody>
    </table>
  </div>
  <div class="bs-callout bs-callout-danger" id="contacto">
  <?php
if(isset($_GET['empty'])){
  echo "<div class='alert alert-warning'>
        <strong>Atención!</strong> Se olvidó campos por completar
        </div>";
}
  ?>
  <h2>Contacto</h2>
  <form action="php/sendmail.php" method="POST">

  	 <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" name="nombre" id="name" placeholder="Escriba su nombre" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Su correo email" required>
    </div>
    <div class="form-group">
      <label style="vertical-align: top">Contact:</label>
      <textarea class="form-control" rows="5" name="mensaje" id="comment" placeholder="Su mensaje aquí..." required></textarea>
    </div>
    <button type="submit" class="btn btn-primary pull-right" id="submit" name="submit"><i class="glyphicon glyphicon-envelope" ></i> Enviar</button><br>
        <input type="hidden" name="url" value="<? echo "".geturl().""?>" >
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
  </form>


  </div>
</div>
</div>  
</div>
    
</div>
</body>
</html>