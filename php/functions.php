<?php
include_once "MySQLDataSource.php";
include_once "class/objetousuario.php";
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
				header('Location: '.$_SERVER['HTTP_REFERER'].$params); 
			}
		}else{
			$url=explode("?",$_SERVER['HTTP_REFERER']);
			header('Location: '.$url[0].$params); 
		}
	}
	function backlogged(){
		if(isset($_SESSION['usr'])){
			turnback();
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
	$values= profesiones();
	if($values!=false){
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
					<td><?= $value->getname(); ?></td>
					<td><?= $value->getsurname();?></td>
					<td><?= $value->getmail();?></td>
					<td>Administrador</td>
					<td><?= $value->getprof();?></td>
					<td> <a href=<?= "'".$value->getpic()."'"; ?> class="pull-right" target="_blank"><img class="img-icon" src=<?= "'".$_SESSION['usr']->getpic()."'"; ?>></a> </td>
					<td></td>
				</tr>
<?php 
			}else{
?>
				<tr class="">
					<td><?= $value->getname(); ?></td>
					<td><?= $value->getsurname();?></td>
					<td><?= $value->getmail();?></td>
					<td>Cliente</td>
					<td><?= $value->getprof();?></td>
					<td> <a href=<?= "'".$value->getpic()."'"; ?> class="pull-right" target="_blank"><img class="img-icon" src=<?= "'".$_SESSION['usr']->getpic()."'"; ?>></a></td>
					<td><form method="POST" action="php/eraseusr.php"> <input type="submit" class="btn btn-danger" value="borrar" name=<?= $value->getid();?>></form></td>
				</tr>


<?php
			}//cierre else
		}//cierre foreach
	}//cierre if
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
//actualiza los datos en la base de datos y verifica. Se le pasa un parametro que revisa que parametros debe cambiar
function editprofile($config){
	if($config==0){//solo se ha enviado la profesion
		$update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."' WHERE `id_usr`=".$_SESSION['usr']->getid();//pendiente añadir edición de imagen (revisar si se ha posteado etc)
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

function checkpass(){
	//devolver 0 si todo esta bien
	//devolver 1 si la old no es correcta
	//devolver 2 si las contraseñas no coinciden 
	echo "hola";
}
