<?php
include_once "functions.php";
session_start();
if(isset($_POST)){
   $id= catchkey($_POST);
   $result=deleteusr($id);
   turnback("del=".$result);
}else {
    turnback();
}

?>