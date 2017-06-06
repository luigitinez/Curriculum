<?php


/**
*Clase CV
*/

class cv{

    public $id;
    public $pic;
    public $name;
    public $surname;
    public $profesion;
    public $formacion;
    public $experiencias;
    public $presentacion;
   

    //GETTERS

    function getname(){
        return $this -> name;
    }
    function getid(){
        return $this -> id;
    }
    function getpic(){
        return $this -> pic;
    }
    function getsurname(){
        return $this -> surname;
    }
    function getprofesion(){
        return $this -> profesion;
    }
    function getformacion(){
        return $this -> formacion;
    }
    function getexperiencias(){
        return $this -> experiencias;
    }
    function getpresentacion(){
        return $this -> presentacion;
    }

    //SETTERS
    function setname($name){
         $this -> name = $name;
    }
    function setid($id){
         $this -> id = $id;
    }
    function setpic($pic){
        $this -> pic  = $pic;
    }
    function setsurname($surname){
        $this -> surname  = $surname;
    }
    function setprofesion($profesion){
        $this -> profesion = $profesion;
    }
    function setformacion($formacion){
        $this -> formacion = $formacion;
    }
    function setexperiencia($experiencias){
        $this -> experiencias = $experiencias;
    }
    function setpresentacion($presentacion){
        $this -> presentacion = $presentacion;
    }
}
?>