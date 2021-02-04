<?php

try {
	session_name("apimax");
	session_start();

	include 'conexion/conexion.php';

	$p_user = $_POST['nombre_usuario'];
	$p_contra = $_POST['pass'];
	$contraseña = $p_contra;
	$consulta_usuario = $conexion->prepare("SELECT id_usuario, usuario, pass, nombre, ap_paterno, tipo_usuario, activo FROM usuarios WHERE usuario = '$p_user' AND pass = '$contraseña' AND activo = '1'");
	$consulta_usuario->execute();

	$row_usuario = $consulta_usuario->fetch(PDO::FETCH_NUM);

	if ($row_usuario==0) {
		echo "1";

	}else if ($row_usuario>0) {
		$full_name = $row_usuario[3]." ".$row_usuario[4]."";

		$_SESSION["apimax_id_usuario"] = $row_usuario[0];
		$_SESSION["apimax_usuario"] = $row_usuario[1];
		$_SESSION["apimax_contraseña"] = $row_usuario[2];
		$_SESSION["apimax_nombre_persona"] = $full_name;
		$_SESSION["apimax_tipo_usuario"] = $row_usuario[5];
		$_SESSION["apimax_autenticado"] = "SI";
		
		echo "2";
}
} catch (PDOException $error) {
	echo "error: ".$error->getMessage();
}

 ?>