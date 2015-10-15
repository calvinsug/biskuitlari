<?php
	mysql_connect('localhost', 'root', '');  
	mysql_select_db('biskuitlari');  
	    
	$score = mysql_real_escape_string($_POST['score']);   
	$username= mysql_real_escape_string($_POST['username']);
	$s = mysql_real_escape_string($_POST['s']);
	$m= mysql_real_escape_string($_POST['m']);
	$h = mysql_real_escape_string($_POST['h']);


	$result = mysql_query('select max(score) as highscore from trscore ');  
	
	$row = mysql_fetch_array($result);    
	if($row[0] >= $score){  
	    //blom mencapai high score, silahkan coba lagi
				//$rs = mysql_query("select m.memberid,playtime from msmember m join trscore ts on m.Memberid=ts.Memberid where username='$username' ");
				//$row = mysql_fetch_array($rs);
				//$id= $row[0];

	   			// mysql_query("update trscore set playtime= ")
	    echo 0;  
	}else{  
	    //wih high score nih
				//dibkin no dlu bro smua ishighscoreny coz ada high score baru
				mysql_query("update trscore set isHighScore= 'no'");
				$rs = mysql_query("select memberid from msmember where username='$username' ");
				$row = mysql_fetch_array($rs);
				$id= $row[0];
				//tinggal update deh
				mysql_query("update trscore set isHighScore='yes',score= $score where Memberid ='$id'  ");

	    echo 1;  
	}  

?>