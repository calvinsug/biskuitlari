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
			if (isset($_COOKIE["user"])) {
                $_SESSION["useronline"] = $_COOKIE["user"];
                $_SESSION["status"] = $_COOKIE["status"];
            }
        	if(isset($_SESSION['useronline'])){
				
				if($_SESSION['status']!="admin"){
				
				header("location:home.php");
				}
				
			}
			else	
			
		header("location:home.php");	
?>
<hr noshade>
<div id="content">

<br />



<form method="post" action="listplayer.php">
	<div align="center">
    Search Member by Username
    <input type="text" name="username" placeholder="input username here.."/> 
    </div>
</form>

<?php 
	

	
	$search= "";
	if(isset($_REQUEST['username'])){
	 $search = $_REQUEST['username'];
	}
	$dataPerPage = 5;
	$noPage = 1;
	if(isset($_REQUEST['page']))
		$noPage = $_REQUEST['page'];
	$offset = ($noPage-1) * $dataPerPage;
	
	$query2 = "SELECT * FROM msmember m join msmembercontact mc on m.memberid=mc.memberid join msmemberprofile mp on mp.memberid=m.memberid join trscore ts on ts.memberid = m.memberid where m.username like '%$search%' and status!='admin' limit $offset, $dataPerPage";
	
	
	$result = mysql_query($query2);
		
?>
	<br />
    
	
	<?php

	$sql=mysql_query($query2);
	while($row=mysql_fetch_array($sql)){
	
	
	?>
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
        	<td><strong>Date of Birth</strong></td>
            <td width="100"> <?php echo $row['DateOfBirth']?> </td>
        </tr>
        
        
        <tr>
        	<td><strong>Email</strong></td>
            <td width="100"> <?php echo $row['Email']?> </td>
        </tr>

         <tr>
        	<td><strong>Phone</strong></td>
            <td width="100"> <?php echo $row['Phone']?> </td>
        </tr>

         <tr>
        	<td><strong>High Score</strong></td>
            <td width="100"> <?php echo $row['Score']?> </td>
        </tr>

        <tr>
        	<td><strong>Register Date</strong> </td>
        	<td width="100"> <?php echo $row['RegisterDate']?></td>
        </tr>
        <tr>
        	<td><strong>Last Login </strong> </td>
        	<td width="100"> <?php echo $row['LastLogin']?></td>
        </tr>
       
        <tr>
        	<td><strong>Status</strong></td>
            <td width="100"> <?php 
            	if($row['Status'] == "player")
            		echo "unbanned";
            	else if($row['Status'] == "banned")
            		echo "banned";
            ?> </td>
        </tr>
        <tr>
        	<td><strong>Option</strong></td>
            <td width="100">
            <table>
            <tr>
            <td>
            <a href="control/doDeleteMember.php?id=<?php echo $row[0];?>">Delete</a> 
            </td>
            <td>
            <a href="control/doBanMember.php?id=<?php echo $row[0];?> & status=<?php echo $row['Status']; ?>">
            <?php
			if($row['Status']=="player"){
			?>
            Ban
            <?php
            }
			else
			{
			echo "Unbanned";
			}
            ?>
            </a> 
            </td>
            </tr>
            </table>
            </td>
        </tr>
    <br/>    
	        
       <?php

        }
			
		?>			
	
    </table>

<br />
<div align="center">
Page
<?php 
			//untuk mengetahui jumlah data
		$query3 = "select count(*) as jmlhData from msmember where status!='admin'";
		$result2 = mysql_query($query3);
		$data = mysql_fetch_array($result2);
		$jmlhData = $data['jmlhData'];
		
		$jmlhPage = ceil($jmlhData / $dataPerPage);
		
		for($page = 1 ; $page <= $jmlhPage; $page++){
		
		if($page == $noPage)	echo "<b>$page</b>";
		else echo "<a href='{$_SERVER['PHP_SELF']}?page=$page'> $page </a>";
		}	
?>	
</div>
</div>
<hr noshade>
<div id="footer">
	Copyright © BiskuitLari | 2014. All rights reserved.
</div>
</div>
</body>
</html>