<?php
session_name("apimax");
session_start();

$verificacion = $_SESSION["apimax_autenticado"];

if ($verificacion != "SI")  
{ 
    echo"<script language=\"javascript\">window.location=\"../../index.php\"</script>";
} 
?>