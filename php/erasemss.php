<?php
    include_once "MySQLDataSource.php";
    include_once "functions.php";
    if(isset($_POST)){
        $result=deletemss($_POST['id']);
        turnback("result=".$result);
    }else{
        turnback();
    }
?>