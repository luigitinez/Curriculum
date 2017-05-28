<?php
class forex{

    public $id;
    public $place;
    public $job;
    public $init_date;
    public $end_date;

   

    //GETTERS
    function getid(){
        return $this -> id;
    }
    function getplace(){
        return $this -> place;
    }
    function getjob(){
        return $this -> job;
    }
    function getinit_date(){
        return $this -> init_date;
    }
    function getend_date(){
        return $this -> end_date;
    }


    //SETTERS
    function setid($id){
         $this -> id = $id;
    }

    function setplace($place){
         $this -> place = $place;
    }
    function setjob($job){
         $this -> job = $job;
    }
    function setinit_date($init_date){
        $this -> init_date  = $init_date;
    }
    function setend_date($end_date){
        $this -> end_date  = $end_date;
    }
    

}