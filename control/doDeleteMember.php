<?php
include("connect.php");

$id=$_REQUEST['id'];

$query="delete from msmember where Memberid=$id";
	// udah Pake On DELEte CAscade, jadinya ckup delete 1 member id di tabel MsMember aja otomatis data di tabel laennya ikut keapus yg memberIdnya sama
mysql_query($query);

header("location:../listplayer.php");
?>