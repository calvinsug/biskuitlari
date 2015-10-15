<?php 

	session_start();
	
	
	session_destroy(); //ancurin semua session

	// ilangin cookie
	setcookie("user","",time()-1,"/");
	setcookie("status","",time()-1,"/");

	header("location:../home.php");
?>