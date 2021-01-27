<?php
//La de arriba es la eiqueta de apertura y la de abajo la etiqueta de cierre
//PHP.NET BUSCAR MAS CODIGO,ETC
$servidor = "localhost";
$usuario = "root";
$password = "123456789";
$base_datos = "apimax";
$cadena_conexion = 'mysql:dbname='.$base_datos.';host='.$servidor.'';

    try
    {
        $conexion = new PDO($cadena_conexion,$usuario,$password);
        //PDO = PHP DATA OBJECT
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //ATTR_ERRMODE = Si tiene errores lo reporta
        //ERRMODE_EXCEPTION = Sirve para generar la excepcion si existe
        date_default_timezone_set("America/Monterrey");
        //Especifico la zona horaria de mi servidor web
        $conexion->query("SET NAMES utf8");
        //Consulta para especificar el tipo de caracter de los resultados de las consultas

    }

    catch(PDOException $error)
    {
        //para concatenar se usa un punto (.)
        echo "Fallo en la conexion: ".$error->getMessage();
    }
?>