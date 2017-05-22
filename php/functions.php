<?php
include_once "MySQLDataSource.php";
include_once "class/objetousuario.php";
include_once "class/objetoprofesion.php";
function geturl($navdir=""){
	if($navdir=="")
	$dir=$_SERVER['PHP_SELF'];
	else
	$dir=$navdir;
	$pos=strrpos($dir,"/");
	$pos=$pos+1;
	$web=substr($dir, $pos);
	return $web;
}
//esta funcion te devuelve a la url desde donde venias
	function turnback($params=""){
		if(strlen($params)>0){
			$params=str_replace(";","&",$params);
			$params="?".$params;
		}
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];//link de la pagina en la que nos encontramos ahora mismo
		if(strpos($_SERVER['HTTP_REFERER'],"?")===false){
			if(strcmp($actual_link,$_SERVER['HTTP_REFERER'])==0){//si la pagina anterior es la misma que la actual (hay que replicarla al otro else por si lleva parámetros la funcion)
				header('Location: http://'.$_SERVER['HTTP_HOST'].$params); 
			}else{
					//miramos si la anterior pagina es reg.php
				$pos=strpos($_SERVER['HTTP_REFERER'],"/",-1);
				$actual_page=substr($_SERVER['HTTP_REFERER'],$pos);
				if(strcmp($actual_page,"reg.php")){
					header('Location: http://'.$_SERVER['HTTP_HOST'].$params); 		
				}else{
				header('Location: '.$_SERVER['HTTP_REFERER'].$params);
				} 
			}
		}else{
			$url=explode("?",$_SERVER['HTTP_REFERER']);
			header('Location: '.$url[0].$params); 
		}
	}

	function backlogged(){
		if(isset($_SESSION['usr'])){
			header('Location: http://'.$_SERVER['HTTP_HOST']);
		}
	}
	function backunlogged(){
		if(!isset($_SESSION['usr'])){
			turnback();
		}
	}

	function usrlogged(){
		if(!isset($_SESSION['usr'])){
			return true;
		}else{
			return false;
		}
	}

function makeselect(){
	$values = profesiones();
	if($values != false){
?>
	 
	 <select class='form-control' name='prof'>
<?php
		
	foreach ($values as $key => $value) {
		if(strcmp($value,$_SESSION['usr']->getprof())==0){
			echo "<option selected='selected' value='".$key."'>$value</option>";
		}else{
			echo "<option value='".$key."'>$value</option>";
		}
	}
?>
	</select>

<?php
	}
}

function mostrarusuarios(){

	$usrs=listar();
	if($usrs!=false){
		foreach($usrs as $key => $value){
			if($value->getkarma()==1){
?>
				<tr class="info">
					<td class="hidden-xs"><?= $value->getname(); ?></td>
					<td class="hidden-xs"><?= $value->getsurname();?></td>
					<td><?= $value->getmail();?></td>
					<td class="hidden-xs">Administrador</td>
					<td><?= $value->getprof();?></td>
					<td> <a href=<?= "'".$value->getpic()."'"; ?> class="pull-right" target="_blank"><img class="img-icon" src=<?= "'".$_SESSION['usr']->getpic()."'"; ?>></a> </td>
					<td></td>
				</tr>
<?php 
			}else{
?>
				<tr class="">
					<td class="hidden-xs"><?= $value->getname(); ?></td>
					<td class="hidden-xs"><?= $value->getsurname();?></td>
					<td><?= $value->getmail();?></td>
					<td class="hidden-xs">Cliente</td>
					<td><?= $value->getprof();?></td>
					<td> <a href=<?= "'".$value->getpic()."'"; ?> class="pull-right" target="_blank"><img class="img-icon" src=<?= "'".$_SESSION['usr']->getpic()."'"; ?>></a></td>
					<td><form method="POST" action="php/eraseusr.php"> <input type="submit" class="btn btn-danger" value="borrar" name=<?= $value->getid();?>></form></td>
				</tr>


<?php
			}//cierre else
		}//cierre foreach
	}//cierre if
}

function mostrarprofesiones(){
	//hacer consulta a la bbdd
	$query="SELECT `id_prof`,`nombre_profesion`, COUNT(FK_id_prof) as total FROM `profesion` LEFT JOIN usr ON profesion.id_prof = usr.FK_id_prof GROUP BY(id_prof)";

	$values= listprof($query);
	foreach($values as $key => $value){//la profesion id=0 porque es la por defecto y es la que tieen los admin?>		
	<tr>	
		<td class="hidden-xs"><?= $value->getid();?></td>
<?php 	if ($value->getid()!=0){ ?>
		<form method="POST" action="php/editprof.php">
		<td><input type="text" name="prof" value=<?= "'". $value->getname()."'";?>></td>
		<td><?= $value->gettotal();?></td>
		<input type="hidden" value=<?= $value->getid();?> name="id" >
		<td><input type="submit" class="btn btn-info" name="edit" value="Editar"> </td>
		</form>
		<form method="POST" action="php/eraseprof.php">
		<td><input type="submit" name=<?= $value->getid();?> class="btn btn-danger" value="Borrar"></td>
		</form>
<?php	}else{?>
		<td><?= $value->getname();?></td>
		<td><?= $value->gettotal();?></td>
		<td></td>
		<td></td>
<?php 	} ?>
	</tr>
<?php
	}

}

function catchkey($post){
	foreach ($post as $key => $value) {
		return $key;
	}
}

function checkdel(){
	if(isset($_GET['del'])){
		if($_GET['del']==true){//usuario borrado con exito
?>
			<div class="alert alert-success">
    			<strong>Éxito!</strong> El usuario se eliminó con éxito.
  			</div>
<?php
		}else{//usuario no fue borrado
?>
			<div class="alert alert-warning">
 				<strong>Error!</strong> No se pudo borrar el usuario de la base de datos.
			</div>

<?php
		}

	}
}	

function editprof($id,$newname){
	$update="UPDATE `profesion` SET `nombre_profesion`= '".$newname."' WHERE `id_prof`=".$id;
		$result=makeupdate($update);//intentamos hacer la actualizacion en la base de datos
		return $result;//devolvemos el resultado de la consulta a la bbdd (el update de makeupdate)
}

//actualiza los datos en la base de datos y verifica. Se le pasa un parametro que revisa que parametros debe cambiar
function editprofile($config){
	switch ($total) {
    case 0:
        if($prof==true){           
			$update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."' WHERE `id_usr`=".$_SESSION['usr']->getid();
       }else{
           return null;
       }
        break;
	case 1:
		$update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."', `pic`='".$_SESSION['tmp_img']."' WHERE `id_usr`=".$_SESSION['usr']->getid();
    case 3:
        #code...
    case 4:
        # code...
        break;
}

	if($config==0){//solo se ha enviado la profesion
		
	}elseif ($config==1) {//se envia profesion e imagen
		
	}elseif ($config==3) {//se envia profesion y contraseña

	}
	else{//se envia todo

	}

	$result=makeupdate($update);//intentamos hacer la actualizacion en la base de datos
	$_SESSION['usr']->refresh();//actualizamos el objeto usuario guardado en sesion con los datos de la bbdd
	return $result;//devolvemos el resultado de la consulta a la bbdd (el update de makeupdate)
}
function checkprof(){
	 if($_POST['prof']!=$_SESSION['usr']->getidprof()){
       return true;//las profesiones no son iguales
    }else{
		return false;//las profesiones son iguales no hacer anda
	}
}
function checkeditprof(){
	if (isset($_GET['addp'])){//mensaje de exito o error añadir
		if ($_GET['addp']==true){
?>
			<div class="alert alert-success">
				<strong>Añadido!</strong> Se ha añadido una nueva profesion a la BBDD.
			</div>
<?php
		}else{
?>
			<div class="alert alert-danger">
				<strong>Error</strong> No se pudo añadir la profesión.
			</div>
<?php
		}
	}
	if(isset($_GET['del'])){//mensaje de exito error elminar
		if($_GET['del']==true){
?>
			<div class="alert alert-success">
				<strong>Eliminado!</strong> Se ha eliminado la profesion de la BBDD.
			</div>
<?php
		}else{
?>
			<div class="alert alert-danger">
				<strong>Error!</strong> No se pudo eliminar la profesion.
			</div>
<?php
		}
	}	
	if(isset($_GET['edit'])){//mensaje de exito error editado
		if($_GET['edit']==true){
?>
			<div class="alert alert-success">
				<strong>Editado!</strong> Se editó el nombre de la profesión con éxito.
			</div>
<?php
		}else{
?>
			<div class="alert alert-danger">
				<strong>Error!</strong> No fue posible editar.
			</div>
<?php
		}
	}

}

function checkpass(){
	//devolver 0 si todo esta bien
	//devolver 1 si la old no es correcta
	//devolver 2 si las contraseñas no coinciden 
	echo "hola";
}
