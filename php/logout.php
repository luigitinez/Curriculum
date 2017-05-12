<?php
include "functions.php";
    session_start();
    //si un usuairo invitado intenta hacer logout
    if(!isset($_SESSION['usr'])){
        //si intentamso hacer logout sin haber iniciado sesion nos redirege a index
    header('Location: index.php');
    }else{
        //se nos redirege a index si se ha echo correctamente el logout 
        session_destroy();
        turnback('logout=true');
    }
?>
