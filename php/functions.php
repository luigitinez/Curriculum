<?php
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
function usrlogged(){
	if(!isset($_SESSION['usr'])){
		return true;
	}else{
		return false;
	}
}