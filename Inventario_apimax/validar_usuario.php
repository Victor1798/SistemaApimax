<?php

try {
	session_name("apimax");
	session_start();

	include 'conexion/conexion.php';

	$p_user = $_POST['nombre_usuario'];
	$p_contra = $_POST['pass'];

	$consulta_usuario = $conexion->prepare("SELECT u.id_usuario, CONCAT(p.nombre,' ', p.ap_paterno)AS NameFull, u.usuario, u.pass, u.tipo_usuario, u.activo
	FROM usuarios u
	INNER JOIN personas p ON u.id_persona = p.id_persona
	WHERE u.usuario = '$p_user' AND u.pass = '$p_contra' AND u.activo = 1");

	$consulta_usuario->execute();

	$row_usuario = $consulta_usuario->fetch(PDO::FETCH_NUM);

	if ($row_usuario==0) {
		echo "1";

	}else if ($row_usuario>0) {

		$_SESSION["apimax_id_usuario"] = $row_usuario[0];
		$_SESSION["apimax_nombre_persona"] = $row_usuario[1];
		$_SESSION["apimax_usuario"] = $row_usuario[2];
		$_SESSION["apimax_contraseña"] = $row_usuario[3];
		$_SESSION["apimax_tipo_usuario"] = $row_usuario[4];
		$_SESSION["apimax_autenticado"] = "SI";

		echo "2";
}
} catch (PDOException $error) {
	echo "error: ".$error->getMessage();
}

 ?>