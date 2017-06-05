<?php
include_once "functions.php";
session_start();
    if(isset($_POST['submit'])){
        if(!empty($_POST['nombre'])&&!empty($_POST['email'])&&!empty($_POST['mensaje'])){
            if(sendUsrMail($_POST['id'],$_POST['email'],$_POST['nombre'],$_POST['mensaje'])){
                header('Location: http://'.$_SERVER['HTTP_HOST']."/viewusr.php?id=".$_POST['id']."&send=true#contacto");
            }else{
                header('Location: http://'.$_SERVER['HTTP_HOST']."/viewusr.php?id=".$_POST['id']."&send=false#contacto");
            }

        }else{
            
            header('Location: http://'.$_SERVER['HTTP_HOST']."/viewusr.php?id=".$_POST['id']."&empty=true#contacto"); 
        }
    }else{
        turnback();
    }

?>