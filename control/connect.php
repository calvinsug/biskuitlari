<?php
$con = mysql_connect("localhost","root","");
	if(!$con)
	{
		die('could not connect: ' .mysql_error());

	}
	else
		mysql_select_db("biskuitlari",$con);


?>