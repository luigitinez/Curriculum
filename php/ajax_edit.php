<?php
require 'MySQLDataSource.php';
include 'functions.php';

if($_POST["type"]=="mostrar"){
    $id=$_POST["id"];

    $valores=usrconsult($id);


?>
<div class="form-group">
                <label  class="col-sm-2 control-label" for="inputTextName">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control input-name" value="<?=$valores["name"]?>" id="inputTextName" placeholder="Nombre"/>
                    </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label" for="inputTextSurName">Apellido/s</label>
                    <div class="col-sm-10">
                        <input type="text" name="surname" class="form-control input-surname" id="inputTextSurName" value="<?=$valores["surname"]?>" placeholder="Apellidos"/>
                    </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label" for="inputEmail3">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control input-mail" value="<?=$valores["mail"]?>" id="inputEmail3" placeholder="Email"/>
                    </div>
            </div>
            <input id="id-edit" type="hidden" value="<?=$valores["id_usr"]?>">
<?            
}elseif($_POST["type"]=="edit"){
    $valores=$_POST;
    if(usr_update($valores)){
        return true;
    }else{
        return false;
    }
}elseif($_POST["type"]=="passwd"){
    $id=$_POST["id"];
    if(backdefault($id)){
        return true;
    }else{
        return false;
    }
}