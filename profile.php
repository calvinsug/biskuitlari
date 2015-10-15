<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="main">
<?php
	include("header.php");
	 

 			include("control/connect.php");
			
        	if(isset($_SESSION['useronline'])){
				
                $user = $_SESSION['useronline'];
                /* asumsi klo admin gk bisa liat profile sendiri
				if($_SESSION['status']=="admin"){
				header("location:home.php");
				}
				*/
			}
			else	
			
		header("location:home.php");	
?>
<hr noshade>
<div id="content">
    <div align="center"> Member Profile</div>
<br />




<?php 
	$query = "SELECT * FROM msmember m join msmembercontact mc on m.memberid=mc.memberid join msmemberprofile mp on mp.memberid=m.memberid where m.username = '$user' ";
	
	
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	
?>
	<br />
    
	
	<table class="product" align="center" border="solid" cellpadding="5px">
    	<!-- klo sempet pasang profile picture
    	<tr>
        	<td rowspan=""> <div align="center"><img width="150px" height="150px" src="img/<?php //echo $row['photo']?>" /> </</div></td>
        </tr>
        -->
    	<tr>
        	<td><strong>Username</strong></td>
            <td width="100"><?php echo $row['Username']?> </td>
        </tr>
        
    	<tr>
        	<td><strong>Fullname</strong></td>
            <td width="350"> <?php echo $row['Fullname']?> </td>
        </tr>
    	
        <tr>
            <td><strong>Email</strong></td>
            <td width="100"> <?php echo $row['Email']?> </td>
        </tr>

        <tr>
        	<td><strong>Date of Birth</strong></td>
            <td width="100"> <?php echo $row['DateOfBirth']?> </td>
        </tr>
        
        
      
         <tr>
        	<td><strong>Phone</strong></td>
            <td width="100"> <?php echo $row['Phone']?> </td>
        </tr>

         <tr>
        	<td><strong>Address</strong></td>
            <td width="100"> <?php echo $row['Address']?> </td>
        </tr>
  
       
	
    </table>

<br />

</div>
<hr noshade>
<div id="footer">
	Copyright © BiskuitLari | 2014. All rights reserved.
</div>
</div>
</body>
</html>