<?php
include("connect.php");
$id = $_REQUEST['id'];

$query =  "update trscore set Score = 0,isHighScore = 'no' where Memberid = $id";

mysql_query($query);

header("location:../score.php");

?>