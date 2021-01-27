<?php
session_name("apimax");
session_start();

	$_SESSION["apimax_autenticado"] = "NO";
	 echo"<script language=\"javascript\">window.location=\"forms/login/index.php\"</script>";
 ?>