<?php

function conectar(){
    @$connect = new mysqli("localhost","root","root","curriculum");
  //  @$connect = new mysqli("danigody001.mysql.guardedhost.com","danigody001_luismg","qqC-9kU-2LB-pS8","danigody001_cvproject");
   // @$connect = new mysqli("localhost","root","","curriculum");
    if($connect->connect_errno){
       printf("<h1><span>LA CONEXIÓN CON LA BASE DE DATOS HA FALLADO: %s\n".$connect->connect_error."</span></h1>");
       exit();
    }else{
        return $connect;//devolvemos el objeto conexion para poder trabajar posteriormente con el
    }
}

function verbandeja(){
    $conn  = conectar();
    $query = "SELECT * FROM `mail` WHERE `FK_id_usr` = ".$_SESSION['usr']->getid()." order by id desc" ;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $correos=array();
        $i=0;
        while($row = $result->fetch_assoc()) {
            /*recorremos todas los correos en al bandeja del usuario y los metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $correos[$i] = new mail();
            
            $correos[$i]->setid($row['id']);
            $correos[$i]->setcorreo($row['correo']);
            $correos[$i]->setname($row['name']);
            $correos[$i]->setmessage($row['message']);
            $correos[$i]->setid_usr($row['FK_id_usr']);  
            $i++ ;      
        }
        return $correos;
    } else {
        return false;
    }
    $conn->close();
}

function usrexists ($mail){
    $enlace = conectar();
    //generamos una consulta para enviar a la bbdd
    //    SELECT `mail`, `pass`,`name`,`surname`,`admin`,`pic`, `nombre_profesion` FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof AND usr.mail = 'lmgspain@hotmail.com'
  $query = "SELECT `id_usr`, `mail`, `pass`,`name`,`surname`,`admin`,`pic`,`FK_id_prof`, `nombre_profesion`,`presentacion` FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof AND usr.mail = '".$mail."'";
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


function usrconsult ($id){
    $enlace = conectar();
    //generamos una consulta para enviar a la bbdd
  $query = "SELECT `id_usr`, `mail`, `pass`,`name`,`surname`,`admin`,`pic`,`FK_id_prof`, `nombre_profesion`,`presentacion`
   FROM `usr` INNER JOIN `profesion` WHERE usr.FK_id_prof = profesion.id_prof AND usr.id_usr = '".$id."'";
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
            $row = $result->fetch_assoc();
            
            return $row;//usuario existe
        }
    }
}
function usr_update($config){
    $sql = "UPDATE `usr` SET `mail`='".$config['mail']."',`name`='".$config['name']."',`surname`='".$config['surname']."' WHERE id_usr =".$config['id'] ;
    
    $result = makeupdate($sql);

    return $result;

}

function regusr($mail,$pass,$name,$surname){
    $sqlins="INSERT INTO `usr`( `mail`, `pass`, `name`, `surname`) VALUES ('".$mail."','".$pass."','".$name."','".$surname."')";
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

function addformex($table,$place,$prof,$ini,$end,$id){
    if(strcasecmp($table,"formacion")==0){
        $tipo="tipo_for";
    }else{
        $tipo="profesion";
    }
    $sqlins="INSERT INTO `".$table."`( `lugar`, `".$tipo."`, `fecha_ini`, `fecha_fin`, `FK_id_usr`) 
    VALUES ('".$place."','".$prof."','".$ini."','".$end."','".$id."')";

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

function listarformaciones($id_usr)
{

    $conn = conectar();
    $select = "SELECT `id_exp`, `fecha_ini`,`fecha_fin`,`lugar`,`tipo_for` FROM `formacion` WHERE `FK_id_usr` = ".$id_usr;
     $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $profesiones=array();
        $i=0;
        $usuarios=array();
        while($row = $result->fetch_assoc()) {
            /*recorremos todas las profesiones y las metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $usuarios[$i]=new forex();
            $usuarios[$i]->setid($row['id_exp']);
            $usuarios[$i]->setplace($row['lugar']);
            $usuarios[$i]->setjob($row['tipo_for']);
            $usuarios[$i]->setinit_date($row['fecha_ini']);
            $usuarios[$i]->setend_date($row['fecha_fin']);

            
            $i++;
        }
        $conn->close();        
        return $usuarios;
    } else {
        $conn->close();    
        return false;
    }


}

function listarexperiencias($id_usr)
{

    $conn = conectar();
    $select = "SELECT `id_exp`, `fecha_ini`,`fecha_fin`,`lugar`,`profesion` FROM `experiencias` WHERE `FK_id_usr` = ".$id_usr;
     $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $profesiones=array();
        $i=0;
        $usuarios=array();
        while($row = $result->fetch_assoc()) {
            /*recorremos todas las profesiones y las metemos en un array, donde la key será el id y el nombre la posición 
            Esto lo hacemos por si se borra alguna profesion y la secuencia de ids no es continua no provoque errores*/
            $usuarios[$i]=new forex();
            $usuarios[$i]->setid($row['id_exp']);
            $usuarios[$i]->setplace($row['lugar']);
            $usuarios[$i]->setjob($row['profesion']);
            $usuarios[$i]->setinit_date($row['fecha_ini']);
            $usuarios[$i]->setend_date($row['fecha_fin']);

            
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
function deletemss($id){
      $conn = conectar();
    $del = "DELETE FROM `mail` WHERE `id` =".$id;
    if ($conn->query($del) === TRUE) {
        //echo "Record deleted successfully";
        return true;
    } else {
        //echo "Error deleting record: " . $conn->error;
        return false;
    }

$conn->close();
}

function delforex($table,$id){
    $conn = conectar();
    $del = "DELETE FROM `".$table."` WHERE `id_exp` =".$id;
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
function makecvs(){
    $conn  = conectar();
    $groupby = 'GROUP BY (id_usr)';
    $sql   = 'SELECT `id_usr`, `name`,`surname`,prof.nombre_profesion, `pic`,`presentacion`, COUNT(DISTINCT experiencias.id_exp) as laboral, COUNT(DISTINCT formacion.id_exp) as formacion
FROM `usr` INNER JOIN `profesion` as prof ON usr.FK_id_prof = prof.id_prof 
LEFT JOIN `experiencias` ON usr.id_usr = experiencias.FK_id_usr
LEFT JOIN `formacion` ON usr.id_usr = formacion.FK_id_usr
WHERE prof.id_prof = usr.FK_id_prof AND NOT `FK_id_prof` = 0 ';
    if(isset($_SESSION['cvprof'])){
        $sql.= ' AND `FK_id_prof` ='. $_SESSION['cvprof'].' ';
        unset($_SESSION['cvprof']);
        //die($sql);
    }
    $sql.=$groupby;
    //die($sql);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // recorremos la consulta
        $cvs=array();
        $i=0;
        while($row = $result->fetch_assoc()) {
            $cvs[$i]= new cv;
            $cvs[$i]->setid($row["id_usr"]);
            $cvs[$i]->setpic('media/usrimg/'.$row["pic"]);
            $cvs[$i]->setname($row["name"]);
            $cvs[$i]->setsurname($row["surname"]);
            $cvs[$i]->setprofesion($row["nombre_profesion"]);
            $cvs[$i]->setpresentacion($row["presentacion"]);
            $cvs[$i]->setformacion($row["formacion"]);
            $cvs[$i]->setexperiencias($row["laboral"]);
           
            $i++;
        }
    } else {
       $cvs=false;
    }
    return $cvs;
$conn->close();

}

function makeupdate($upd){
    $con=conectar();
    if ($con->query($upd) === TRUE) {
       $con->close();
        return true;
    } else {
        $con->close();
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

function insertMail($name,$mail,$message,$idusr){
    $sqlins="INSERT INTO `mail`(`correo`, `name`, `message`, `FK_id_usr`) VALUES ('".$mail."','".$name."','".$message."','".$idusr."')";
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