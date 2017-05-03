<?php

/**
*Clase Usuario
*/

class usuario{

    private $mail;
    private $id;
    private $pass;
    private $prof;//se guardará la profesión real y no el id
    private $pic;//url foto
    private $name;
    private $surname;
//no se añade descripcion porque seria muy pesado si hay que 
//manejar múltiples objetos a la vez y es innecesaria
    //GETTERS

    function getmail(){
        return $this -> nick;
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
    function getpic(){
        return $this -> pic;
    }
    function getname(){
        return $this -> name;
    }
     function getsurname(){
        return $this -> surname;
    }

}
?>