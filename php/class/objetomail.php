<?php


/**
*Clase Mail
*/

class mail{

    public $id;
    public $correo;
    public $name;
    public $message;
    public $id_usr;
   

    //GETTERS

    function getname(){
        return $this -> name;
    }
    function getid(){
        return $this -> id;
    }
    function getmessage(){
        return $this -> message;
    }
    function getid_usr(){
        return $this -> id_usr;
    }
    function getcorreo(){
        return $this -> correo;
    }


    //SETTERS
    function setname($name){
         $this -> name = $name;
    }
    function setid($id){
         $this -> id = $id;
    }
    function setmessage($message){
        $this -> message  = $message;
    }
    function setid_usr($id_usr){
        $this -> id_usr  = $id_usr;
    }
    function setcorreo($correo){
        $this -> correo = $correo;
    }
   

}
?>