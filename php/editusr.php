<?php
include_once "functions.php";
session_start();
if(isset($_POST['submit'])){

    $total=0;  
    if (!empty ($_POST['oldpass']) && !empty ($_POST['newpass']) && !empty ($_POST['repeatpass']) ) {//se ha posteado todo
        $img=checkimg();
        $resultpass=checkpass();//revisa si la contraseña 1 es igual a la actual del usr y
        
        if ($resultpass!=0){//si el test de contraseñas no pasa se lanzará un error 
        //los errores se deben guardar en una session para que luego se metan como parametros en el turnback
           
            turnback("passch=".$resultpass);
        }else{//la contraseña se ha posteado y esta correctamente
            if($img){//actualizamos imagen y contraseña
                editprofile(4);
            }else{//actualizamos solo la contraseña
                editprofile(3);
            }
            turnback("passch=".$resultpass);
        }
    }else{
        //comprobar si se ha posteado la imagen
        $prof=checkprof();
        $img=checkimg();
        if ($img){//se ha posteado imagen
                editprofile(1);
        }else {
            if($prof)
                editprofile(0);
            else
                turnback("edit=false");
        }
       //si no se ha posteado imagen y prof==false no hacer nada sino actualizar profesion
    }
}elseif(isset($_POST['default'])){
    backdefault();
    

}else{
    turnback();
}
//turnback();
/*if(isset($_SESSION['tmp_img'])){
    print_r($_SESSION['tmp_img']);
}*/