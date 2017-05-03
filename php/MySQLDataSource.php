<?php

function conectar(){

    @$connect = new mysqli("localhost","root","","curriculum");
    if($connect->connect_errno){
       printf("<h1><span>LA CONEXIÓN CON LA BASE DE DATOS HA FALLADO: %s\n".$connect->connect_error."</span></h1>");
       exit();
    }else{
        return $connect;//devolvemos el objeto conexion para poder trabajar posteriormente con el
    }
}

function usrexists ($mail){
    $enlace= conectar();
    //generamos una consulta para enviar a la bbdd
  $query="SELECT * FROM `usr` WHERE `mail` = '".$mail."'";
  if(!$result =$enlace->query($query)){
   //la consulta no se ha realizado con exito
   return false;

  }else {
        if ($result->num_rows === 0) {
            return false;//la consulta ha devuelto 0 filas, no existe el usuario
        }else{
            return $result;//usuario existe
        }
    }
}
?>