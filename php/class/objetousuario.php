<?php

/**
*Clase Usuario
*/

class usuario{

    public $mail;
    private $id;
    private $pass;
    private $prof;//se guardará la profesión real y no el id
    private $idprof;//el id de la profesion
    private $pic;//url foto
    private $name;
    private $surname;
//no se añade descripcion porque seria muy pesado si hay que 
//manejar múltiples objetos a la vez y es innecesaria
    //GETTERS

    function getmail(){
        return $this -> mail;
    }
    function getid(){
        return $this -> id;
    }
    function getpass(){
        return $this -> pass;
    }
     function getprof(){
        return $this -> prof;
    }
    function getidprof(){
        return $this -> idprof;
    }
    function getpic(){
        return $this -> pic;
    }
    function getname(){
        return $this -> name;
    }
     function getsurname(){
        return $this -> surname;
    }
    function getkarma(){
        return $this -> karma;
    }

    //SETTERS
    function setmail($nick){
         $this -> mail = $nick;
    }
    function setid($id){
         $this -> id = $id;
    }
    function setpass($pass){
        $this -> pass = $pass;
    }
     function setprof($prof){
        $this -> prof = $prof;
    }
     function setidprof($idprof){
        $this -> idprof = $idprof;
    }
    function setpic($pic){
        $this -> pic = $pic;
    }
    function setname($name){
        $this -> name = $name;
    }
     function setsurname($surname){
        $this -> surname =$surname;
    }
    function setkarma($karma){
        $this -> karma =$karma;
    }

    function refresh(){
        if($result = usrexists($_SESSION['usr']->getmail())){
            $linea =$result->fetch_assoc();
        }

    }

}
?>