<?php

function menu(){
?>
<nav class="navbar navbar-inverse navbar-wrapper"">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Curriculum</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Inicio</a></li>
    </ul>
    <form class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="buscar">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="reg.php" >Registrarse</a></li>
      <li><a href="#" >Log in</a></li>
    </ul>  
  </div>
</nav>
<?php ;
}

function styles(){?>
  <link rel="stylesheet" type="text/css" href="">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><?
}
?>