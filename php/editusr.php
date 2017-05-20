<?php
include_once "functions.php";
session_start();
if(isset($_POST)){

    if(!empty($_POST['oldpass']) && !empty($_POST['newpass']) && !empty($_POST['repeatpass'])){
        $resultpass=checkpass();//revisa si la contraseña 1 es igual a la actual del usr y 
    }else{
        //comprobar si se ha posteado la imagen
       $prof=checkprof();
       //si no se ha posteado imagen y prof==false no hacer nada sino actualizar profesion
       if($prof==true){
            $result=editprofile(0);
            turnback("result=".$result);
       }else{
           turnback();
       }
    }
}else{
    turnback();
}