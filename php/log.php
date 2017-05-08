<?php 
include "functions.php";
include "MySQLDataSource.php";
include "class/objetousuario.php";
/*realizar comprobaciones si el usuario existe*/
/*si el usuario no es encontrado en la bbdd devolverlo de la página que viene*/
if (!$_POST){
  turnback("login=false");
} else {
   $usr     =   $_POST['user'];
   $pass    =  $_POST['pass'];
   $enlace = conectar();//mysqli_connect("127.0.0.1", "root", "", "curriculum");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else{
  //generamos una consulta para enviar a la bbdd
 /* $query="SELECT * FROM `usr` WHERE `mail` = '".$usr."'";
  if(!$result =$enlace->query($query)){
 

  } else {
    if ($result->num_rows === 0) {
      //la consulta no devuelve resultados, el usuario no existe
    }else{*///saltamos a la linea para para revistar la contraseña
      if($result = usrexists($usr)){
      $linea =$result->fetch_assoc();
      
      if (strcmp($linea['pass'],$pass)==0){//comparas los str para saber si la contraseña esta bn
        print_r($linea);
 /*----------------------------creamos el objeto usuario y lo almacenamos en la sesion usr-----------------------------*/
            $_SESSION['usr']=new usuario();
            $_SESSION['usr']->setid($linea[0]);
            $_SESSION['usr']->setmail($linea[1]);
            $_SESSION['usr']->setpass($linea[2]);
            //$_SESSION['usr']->setprof($usr5);
            //$_SESSION['usr']->setpic($linea[3]);
            $_SESSION['usr']->setname($linea[3]);
            $_SESSION['usr']->setsurname($linea[4]);
          
        /*---------------------------------------------------------*/
        //turnback("login=true;usr=$usr");
      }else{
        //ha sido todo un fracaso
        turnback("login=false;pass=false");
      }
      

    }else{
        turnback("login=false");
    }
  }

//}
/*
echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;
*/
mysqli_close($enlace);
}
?>
