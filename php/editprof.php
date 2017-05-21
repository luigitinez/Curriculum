<?php
include_once "MySQLDataSource.php";
include_once "functions.php";
session_start();
if(isset($_POST)){
   $result=editprof($_POST['id'],$_POST['prof']); 
   turnback("edit=".$result);
}else {
    turnback();
}

?>