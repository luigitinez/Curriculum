<?php
include_once "functions.php";
include_once "MySQLDataSource.php";
if(isset($_POST['forma'])){//añadir formacion
    if(!empty($_POST['lugar']) && !empty($_POST['prof']) && !empty($_POST['ini']) && !empty($_POST['fin'])){

        $result = addformex("formacion",$_POST['lugar'],$_POST['prof'],$_POST['ini'],$_POST['fin'],$_POST['user']);
        turnback("add=".$result);

    }else{
        turnback("empty=true");
    }
}elseif (isset($_POST['expe'])) {//añadir experiencia
    if(!empty($_POST['lugar']) && !empty($_POST['prof']) && !empty($_POST['ini']) && !empty($_POST['fin'])){

        $result = addformex("experiencias",$_POST['lugar'],$_POST['prof'],$_POST['ini'],$_POST['fin'],$_POST['user']);
        turnback("add=".$result);

    }else{
        turnback("empty=true");
    }
}elseif (isset($_POST['formdel'])){//borrar formacion
    $result=delforex("formacion",$_POST['id']);
    turnback("del=".$result);
}elseif(isset($_POST['expdel'])){//borrar experiencia
    $result=delforex("experiencias",$_POST['id']);
    turnback("del=".$result);
}else{//se intenta acceder sin post
    turnback();
}
?>