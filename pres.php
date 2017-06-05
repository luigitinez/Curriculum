<?php
    include_once "php/common.php";
    include_once "php/functions.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <?php styles(); ?>
</head>
<body>
  <?php menu(); ?>
<div class="container">
<?php

    if(isset($_POST['pres'])){
        $result=updpres($_POST['pres']);
        $_SESSION['usr']->refresh();
        if($result){
            echo "<div class='alert alert-success text-center'><strong>Se actualizó correctamente</strong></div>";
        }else{
            echo "<div class='alert alert-danger text-center'><strong>No se pudo actualizar</strong></div>";        
        }
    }
?>

  <h2 class="text-center">Carta de Presentación</h2>
  
  <form action="" method="POST">
    <div class="form-group">
      <textarea class="form-control" rows="10" id="comment" name="pres"><?= $_SESSION['usr']->getpresentacion(); ?></textarea>
    </div>
    <button type="submit" class="btn btn-info center-block">Actualizar</button>
  </form>
</div>

</body>
</html>