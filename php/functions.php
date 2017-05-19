<?php
include_once "MySQLDataSource.php";
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
	 
	 <select class='form-control'>
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

