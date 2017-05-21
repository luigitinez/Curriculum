<?php
include_once "functions.php";
include_once "MySQLDataSource.php";
session_start();
if(isset($_POST)){
   $id= catchkey($_POST);
   $result=deleteprof($id);
   turnback("del=".$result);
}else{
    turnback();
}

?>