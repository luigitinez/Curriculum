<?php
include "functions.php";
function menu(){
?>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

<?php
  //index.php or controller
  $pages = array("index.php"=>"HOME","reg.php"=>"Registro","contact.php"=>"Contactenos");
  $activePage = geturl();
?>


     <!--Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php //menu.php
      foreach($pages as $url=>$title): ?>
        <li <?php if($url == $activePage):?>class="active"<?php endif;?> >
             <a  href="<?php echo $url;?>">
               <?php echo $title;?>
            </a>
        </li>

      <?php endforeach;?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mas <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">¿Quienes Somos?</a></li>
            <li><a href="#">Terminos y Condiciones</a></li>
            <li><a href="#">¿Porque Curriculum?</a></li>
            <li class="divider"></li>
            <li><a href="cookies.php">Politica Cookies</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <!-- buscador >
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="buscar">
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
      </form>
      <!-- fin buscador-->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="reg.php"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
      <ul id="login-dp" class="dropdown-menu">
        <li>
           <div class="row">
              <div class="col-md-12">
                 <form class="form" role="form" method="POST" action="php/log.php" accept-charset="UTF-8" id="login-nav">
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputEmail2">Correo</label>
                       <input type="email" name="user" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                    </div>
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputPassword2">Contraseña</label>
                       <input type="password" name="pass" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">¿Olvidó su contraseña?</a></div>
                    </div>
                    <div class="form-group">
                       <input type="submit" class="btn btn-primary btn-block">
                    </div>
                    <div class="checkbox">
                       <label>
                       <input type="checkbox"> Guardar credenciales
                       </label>
                    </div>
                 </form>
              </div>
              <div class="bottom text-center">
               Eres Nuevo? <a href="reg.php"><b>¡Registrate!</b></a>
              </div>
           </div>
        </li>
      </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php ;
  if(isset($_GET['login'])){
    if($_GET['login']==="true"){
    ?>
      <div class="alert alert-success alert-dismissable fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Éxito!</strong>   
        <?php 
        if(!empty($_GET['usr'])){ 
        echo $_GET['usr'];
        }else{ 
        echo "Usted";}
        ?> inició sesión correctamente.
      </div>
      <?php
      }elseif($_GET['login']==="false"){?>
        <div class="alert alert-danger alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> No fue posible iniciar sesión, vuelva a probar.
        </div>
<?php 
        if(isset($_GET['pass'])){
?>
            <div class="alert alert-danger alert-dismissable fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Error contraseña!</strong>
            </div>
<?php
        }
      }else {
      
    }
  }
?>
<script>
$(function() {
checkCookie();
});
</script>

<!--//BLOQUE COOKIES http://politicadecookies.com/ -->
        <div id="cookie_directive_container" class="container" style="display: none">
            <nav class="navbar navbar-default navbar-fixed-bottom">

                <div class="container" style="padding-top:20px;">
                <div class="navbar-inner navbar-content-center" id="cookie_accept">

                    <a href="#" onclick="cerrar()" class="btn btn-primary pull-right">Close</a>
                    <p class="text-muted credit">
                      Usando nuestro sitio web usted nos consiente el uso de cookies de acuerdo con nuestra <a href="/cookies">politica de cookies</a>.
                    </p>
                    <br>

                </div>
              </div>

            </nav>
        </div>
<!--//FIN BLOQUE COOKIES-->
<?php
}

function styles(){
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style-one.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/js-cookies.js"></script>
<?php
  }
?>