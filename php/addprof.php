<?php
include_once "MySQLDataSource.php";
include_once "functions.php";
session_start();
if(isset($_POST)){
   $result=addprof($_POST['prof']); 
   turnback("addp=".$result);
}else {
    turnback();
}

?>