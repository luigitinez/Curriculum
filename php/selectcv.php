<?php
    include_once "functions.php";
    session_start();
    if(isset($_POST['prof'])){
        if($_POST['prof']!=0){
            $_SESSION['cvprof']=$_POST['prof'];
        }
        turnback('prof='.$_POST['prof']);
    }else{
        turnback();
    }
?>