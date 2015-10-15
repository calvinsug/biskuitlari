<?php
include("connect.php");

$id=$_REQUEST['id'];
$status=$_REQUEST['status'];

if($status=="banned"){
$query="update msmember set status='player' where Memberid=$id";
}
else
$query="update msmember set status='banned' where Memberid=$id";

mysql_query($query);

header("location:../listplayer.php");
?>