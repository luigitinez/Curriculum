<?php

function conectar(){
   // @$connect = new mysqli("localhost","root","root","curriculum");
  //  @$connect = new mysqli("danigody001.mysql.guardedhost.com","danigody001_luismg","qqC-9kU-2LB-pS8","danigody001_cvproject");
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
        //    SELECT `mail`, `pass`,`name`,`surname`,`admin`,`pic`, `nombre_profesion` FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof AND usr.mail = 'lmgspain@hotmail.com'
  $query = "SELECT `id_usr`, `mail`, `pass`,`name`,`surname`,`admin`,`pic`,`FK_id_prof`, `nombre_profesion` FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof AND usr.mail = '".$mail."'";
  //$query="SELECT * FROM `usr` WHERE `mail` = '".$mail."'";
  if(!$result =$enlace->query($query)){
   //la consulta no se ha realizado con exito
   $mysqli->close();
   return false;

  }else {
        if ($result->num_rows === 0) {
            $enlace->close();
            return false;//la consulta ha devuelto 0 filas, no existe el usuario
        }else{
            $enlace->close();
            return $result;//usuario existe
        }
    }
}

function regusr($mail,$pass,$name,$surname){
    $sqlins="INSERT INTO `usr`( `mail`, `pass`, `name`, `surname`) VALUES ('".$mail."','".$pass."','".$name."','".$surname."')";
    $mysqli=conectar();
    if ($resultado = $mysqli->query($sqlins)) {//todo fue bien
        return true;
    } else {//devolver error catastrofico
        return false;
        //registrar en el log el error de base de datos //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function getusr($mail){
    $conn = conectar();
    $sql = "SELECT * FROM `usr`WHERE mail = `$mail`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    return $row;
    }
}

function profesiones(){
    $conn= conectar();
     $sql = 'SELECT * FROM `profesion`';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $profesiones=array();
        while($row = $result->fetch_assoc()) {
            /*recorremos todas las profesiones y las metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $profesiones[$row["id_prof"]]=$row["nombre_profesion"];
        }
        return $profesiones;
    } else {
        return false;
    }
    $conn->close();
}

function listar(){

    $conn = conectar();
    $select = "SELECT `id_usr`, `mail`,`name`,`surname`,`admin`,`pic`, `nombre_profesion` FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof";
     $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $profesiones=array();
        $i=0;
        $usuarios=array();
        while($row = $result->fetch_assoc()) {
            /*recorremos todas las profesiones y las metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $usuarios[$i]=new usuario();
            $usuarios[$i]->setpic($row['pic']);
            $usuarios[$i]->setid($row['id_usr']);
            $usuarios[$i]->setmail($row['mail']);
            $usuarios[$i]->setname($row['name']);
            $usuarios[$i]->setkarma($row['admin']);
            $usuarios[$i]->setsurname($row['surname']);            
            $usuarios[$i]->setprof($row['nombre_profesion']);
            
            $i++;
        }
        $conn->close();        
        return $usuarios;
    } else {
        $conn->close();    
        return false;
    }


}
function listprof($select){
    $conn=conectar();
     $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $profesiones=array();
        $i=0;
        $profesiones=array();
        while($row = $result->fetch_assoc()) {
            /*recorremos todas las profesiones y las metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $profesiones[$i]=new profesion();
            $profesiones[$i]->setid($row['id_prof']);
            $profesiones[$i]->setname($row['nombre_profesion']);
            $profesiones[$i]->settotal($row['total']);
           
            
            $i++;
        }
        $conn->close();        
        return $profesiones;
    } else {
        $conn->close();    
        return false;
    }
}

function deleteusr($id){
    $conn = conectar();
    $del = "DELETE FROM `usr` WHERE `id_usr` =".$id;
    if ($conn->query($del) === TRUE) {
        //echo "Record deleted successfully";
        return true;
    } else {
        //echo "Error deleting record: " . $conn->error;
        return false;
    }

$conn->close();
}

function deleteprof($id){
        $conn = conectar();
    $del = "DELETE FROM `profesion` WHERE `id_prof` =".$id;
    if ($conn->query($del) === TRUE) {
        //echo "Record deleted successfully";
        return true;
    } else {
        //echo "Error deleting record: " . $conn->error;
        return false;
    }
}

function makeupdate($upd){
    $con=conectar();
    if ($con->query($upd) === TRUE) {
       
        return true;
    } else {
    
        return false;
    }

}
function addprof($name){
    $sqlins="INSERT INTO `profesion`(`nombre_profesion`) VALUES ('".$name."')";
    $mysqli=conectar();
    if ($resultado = $mysqli->query($sqlins)) {//todo fue bien
        $mysqli->close();
        return true;
    } else {//devolver error catastrofico
        $mysqli->close();        
        return false;
        //registrar en el log el error de base de datos //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>