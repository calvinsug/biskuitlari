<?php 
	//untuk connect ke database
	include("connect.php");
	$error = "";
	$remember = "";
	//mengambil username dan password yang diinput
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	if(isset($_POST['remember']))
		$remember = $_POST['remember'];
	

	if($user == NULL || $user == "")
		 $error="Username must be filled";
	else if($pass == NULL || $pass== "")
		$error="Password must be filled";
	
	//kalo lolos validasi inputan
	if($error==""){
		//encrypt password
		$pass = md5($pass);

		//membuat query
		$query = "select * from msmember where username = '$user' and password = '$pass'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			
			
			$row = mysql_fetch_array($result);
			$status= $row['Status'];
			$id = $row['Memberid'];
			//user di banned
			if($status =="banned")
				header("location:../home.php?err=Your id has been banned");
			
			
			//status user active
			else{
				//membuka session
				session_start();
			   $_SESSION['status']= $status;
			   $_SESSION['useronline'] = $user;
			   
				
			   $query2 = "update msmember set LastLogin = '".date('Y-m-d H:i:s')."' where Memberid = $id";
			   	
			   	mysql_query($query2);
				
				//echo $query2;
				//jika remember me dicentang set cookie selama 1 jam
				if($remember=="yes"){	
					setcookie("user", $user, time()+3600,"/");
					setcookie("status",$status,time()+3600,"/");
				}
				if($row['Status'] != 'admin')
					header("location:../play.php");
				else header("location:../home.php");
			}
		}
		else{
			//tidak ditemukan username dan password yg diinput
			header("location:../home.php?err=Wrong username or password");
		}

	}
	else	header("location:../home.php?err=".$error);

	
	//menutup koneksi
mysql_close($con);
?>