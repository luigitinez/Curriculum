<?php 
include_once "functions.php";
include_once "MySQLDataSource.php";
include_once "class/objetousuario.php";
session_start();
/*realizar comprobaciones si el usuario existe*/
/*si el usuario no es encontrado en la bbdd devolverlo de la página que viene*/
if (!$_POST){
  turnback("login=false");
} else {
   $usr     =   $_POST['user'];
   $pass    =  $_POST['pass'];
   $enlace = conectar();//mysqli_connect("127.0.0.1", "root", "", "curriculum");

if (!$enlace) {
  //escribir los errores en el archivo .log
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

 /*----------------------------creamos el objeto usuario y lo almacenamos en la sesion usr-----------------------------*/
            $_SESSION['usr']=new usuario();
            $_SESSION['usr']->setmail($linea['mail']);
            $_SESSION['usr']->setpass($linea['pass']);
            $_SESSION['usr']->setprof($linea['nombre_profesion']);
            $_SESSION['usr']->setpic('media/usrimg/'.$linea['pic']);
            $_SESSION['usr']->setname($linea['name']);
            $_SESSION['usr']->setsurname($linea['surname']);
            $_SESSION['usr']->setkarma($linea['admin']);
       
          
        /*---------------------------------------------------------*/
       turnback("login=true;usr=$usr");
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
