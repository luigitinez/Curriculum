<?php

/**
*Clase Profesion
*/

class profesion{

    public $name;
    private $id;
    private $total;
   

    //GETTERS

    function getname(){
        return $this -> name;
    }
    function getid(){
        return $this -> id;
    }
    function gettotal(){
        return $this -> total;
    }
    

    //SETTERS
    function setname($name){
         $this -> name = $name;
    }
    function setid($id){
         $this -> id = $id;
    }
    function settotal($total){
        $this -> total = $total;
    }


}
?>