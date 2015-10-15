<?php
	mysql_connect('localhost', 'root', '');  
	mysql_select_db('biskuitlari');  
	  
	$username = mysql_real_escape_string($_POST['username']);  
	  
	$result = mysql_query('select username from Msmember where username = "'. $username .'"');  
	   
	if(mysql_num_rows($result)>0){  
	    //udah ada nih id nya, balikin nilai 0
	    echo 0;  
	}else{  
	    // klo 1 brati available artinya bisa dipake
	    echo 1;  
	}  

?>