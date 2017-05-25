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
		if(strpos($_SERVER['HTTP_REFERER'],"?")===false){//miramos si la pagina anterior tiene un get
			if(strcmp($actual_link,$_SERVER['HTTP_REFERER'])==0){//si la pagina anterior es la misma que la actual (hay que replicarla al otro else por si lleva parámetros la funcion)
				header('Location: http://'.$_SERVER['HTTP_HOST'].$params); 
			}else{
					//miramos si la anterior pagina es reg.php
				$pos=strrpos($_SERVER['HTTP_REFERER'],'/');//buscamos donde está la ultima barra
				$actual_page=substr($_SERVER['HTTP_REFERER'],$pos);
				if(strcmp($actual_page,"reg.php")===0){

					header('Location: http://' . $_SERVER['HTTP_HOST'] . $params); 	

				}else{

					header('Location: '. $_SERVER['HTTP_REFERER'] . $params);
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
		<td><input type="submit" class="btn btn-info" name="edit" value="Actualizar"> </td>
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
	switch ($config) {
    case 0:  //solo se ha enviado la profesion       
		$update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."' WHERE `id_usr`=".$_SESSION['usr']->getid();	
        break;
	case 1://se envia profesion e imagen
		$update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."', `pic`='".$_SESSION['tmp_img']."' WHERE `id_usr`=".$_SESSION['usr']->getid();
		break;
    case 3://se envia profesion y contraseña
       $update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."', `pass` ='".md5($_POST['newpass'])."' WHERE `id_usr`=".$_SESSION['usr']->getid();
       break;
    case 4://se envia todo
       $update="UPDATE `usr` SET `FK_id_prof`='".$_POST['prof']."', `pic`='".$_SESSION['tmp_img']."', `pass` ='".md5($_POST['newpass'])."' WHERE `id_usr`=".$_SESSION['usr']->getid();
        break;
    default:
    	#code
    break;
}

	$result=makeupdate($update);//intentamos hacer la actualizacion en la base de datos
	if($config ==4 || $config==1){
		removeOld_Pic($result);
	}
	$_SESSION['usr']->refresh();//actualizamos el objeto usuario guardado en sesion con los datos de la bbdd
	return $result;//devolvemos el resultado de la consulta a la bbdd (el update de makeupdate)
}

function removeOld_Pic($result){//borra del servidor la imagen que pertenecia al usuario si es diferente de default
	if($result){
		$pos = strrpos($_SESSION['usr']->getpic(), '/');
		$img = substr($_SESSION['usr']->getpic(), $pos);
		if(strcmp($_SESSION['usr']->getpic(),'/default.jpg')!=0){
			//comprobar que existe
			if(file_exists($_SESSION['usr']->getpic())){
				unlink("../".$_SESSION['usr']->getpic());
			}else{
				die($_SESSION['usr']->getpic());
			}
		}
	}
}

function backdefault(){//hace que el usuario vuelva a tener la foto por defecto
	$result=makeupdate("UPDATE `usr` SET `pic`='default.jpg' WHERE `id_usr`=".$_SESSION['usr']->getid());
	removeOld_Pic($result);
	$_SESSION['usr']->refresh();//actualizamos el objeto usuario guardado en sesion con los datos de la bbdd
	return $result;
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
function checkimg(){
	if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )){//como un isset($_FILES)
		$nombreDirectorio = "../media/usrimg/";
		$nombreFichero = $_FILES['imagen']['name'];
		if(is_dir($nombreDirectorio)){
			$pos = strpos($nombreFichero,'.');
			$ext = substr($nombreFichero,$pos);
			$nombreFichero = uniqid('img_').time().$ext;
			$nombreCompleto = $nombreDirectorio.$nombreFichero;
			move_uploaded_file ($_FILES['imagen']['tmp_name'],$nombreCompleto);
			$_SESSION['tmp_img']=$nombreFichero;
			return true;

		}else{
		
		}
		
	}else{
		
		return false;
	}
}

function checkpass(){
	if( strcmp( md5( $_POST['oldpass'] ), $_SESSION['usr']->getpass()) == 0){//se comprueba si la contraseña actual y la introducida en el primer input coinciden
		if ( $_POST['newpass']==$_POST['repeatpass']){//se comprueba si la nueva contraseña y repetir contraseña coinciden
			return 0;//exito
		}else{
			return 2;//no coinciden las contraseñas
		}
	}else{
		return 1;//la contraseña actual introducida no coincide
	}
	//devolver 0 si todo esta bien
	//devolver 1 si la old no es correcta
	//devolver 2 si las contraseñas no coinciden 
}
function sendWelcomeMail($mail,$fullname){
	$subject = "Mensaje de www.cvproject.tk";
	$message = "Estimado/a $fullname,\n \r \n \r Usted se ha registrado en nuestra página web. Le damos la bienvenida y esperemos que disrute de nuestros servicios.";
	$from	 = "From: info@cvproject.tk";
	$headers = "-f info@cvproject.tk";
	mail($mail,$subject,$from,$headers);
}

function mostrarcv(){
	$cvs=makecvs();
	//con el array recibido hacer foreach e imprimir cajas con link que lleven a la pagina
	//que mostrará el curriculum de la persona
	}


function passerrors(){
	if(isset($_GET['passch'])){
		switch ($_GET['passch']) {
			case 0:
				$state='success';
				$message="La contraseña se modificó correctamente";
				break;
			case 1:
				$state='danger';
				$message='La contraseña no es correcta';
				break;
			case 2:
				$state='warning';
				$message='Las contraseñas no coinciden';
				break;
			
			default:
				# code...
				break;
		}
?>
		<div class="container">
			<div class=<?php echo '"alert alert-'.$state.' alert-dismissable fade in"' ?>>
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo  $message;?>
			</div>
		</div>
<?php
	}
}
