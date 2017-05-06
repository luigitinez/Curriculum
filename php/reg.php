<?php
include "functions.php";
session_start();
if(isset($_POST)){
    $emptyvals=array();
    foreach ($_POST as $key => $value) {
        if(empty($value)){
        //rellenar array con el valor para indicar luego que ese campo se dejó vacio   
        $emptyvals[$key]=$value;
        }else{
        //seguir contando

        }
    }
    if(count($emptyvals)>0){
        //crear sessión con $emptyvals y redireccionar a .reg original
        turnback("reg=false");
        $_SESSION['reg_error']=$emptyvals;
    }else{
        //intentar registro
        turnback("reg=true");
    }
}
?>