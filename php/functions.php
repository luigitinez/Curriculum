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

	header('Location: '.$_SERVER['HTTP_REFERER'].$params); 
}
