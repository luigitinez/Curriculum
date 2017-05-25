<?php
include_once "functions.php";
include_once  "MySQLDataSource.php";
session_start();
if(isset($_POST)){
    $emptyvals=array();
    foreach ($_POST as $key => $value) {
        if(empty($value)){
        //rellenar array con el valor para indicar luego que ese campo se dejó vacio   
        $emptyvals[$key]=$value;
        }
    }
    if(count($emptyvals)>0){
        //crear sessión con $emptyvals y redireccionar a .reg original
        turnback("reg=false");
        $_SESSION['reg_error']=$emptyvals;
    }else{
        //hacer validacion de datos en php
        //nombre apellido email contraseña confirmar
        if(strcmp($_POST['contrasena'],$_POST['confirmar'])==0){//comprobamos que las dos contraseñas sean iguales
            //añadir filtros a los posts
            $mail=$_POST['email'];
            $name=$_POST['nombre'];
            $surname=$_POST['apellido'];
            $pass=md5($_POST['contrasena']);
            //intentar registro
            if(!usrexists($mail)){//comprueba si el usuario ya esta registrado para no duplicar registros y crear problemas en la BBDD
                if(regusr($mail,$pass,$name,$surname)===true){//programar para impedir 2 registros con un mismo mail
                    sendWelcomeMail($_POST['email'],$_POST['nombre']. " " .$_POST['apellido']);
                    turnback("reg=true");
                }
                else{//si falló el insert en la bbdd
                //  turnback("reg=false;bbdd=false");
                }
            }else{//si el usuario existe se el eenvia un error
                turnback("reg=false;usr=$mail");
            }
        }else{//contraseña incorrecta
            turnback("reg=false;pass=false");
        }
       
    }
}
?>