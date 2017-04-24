<?php

function geturl(){
	$dir=$_SERVER['PHP_SELF'];
	$pos=strrpos($dir,"/");
	$pos=$pos+1;
	$web=substr($dir, $pos);
	return $web;
}
