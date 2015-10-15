
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bjqs-1.3.min.js"></script>
<script src="js/date_time.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div id="main">
<?php
	include("header.php");
	$status = "nonmember";
	if (isset($_COOKIE["user"]))	{
		$_SESSION["useronline"] = $_COOKIE["user"];
		$_SESSION["status"] = $_COOKIE["status"];
	}


	if(isset($_SESSION['useronline']) && $_SESSION['status'] =='player' ) header("location:play.php");

	if(isset($_SESSION['status']))	$status = $_SESSION['status'];

?>

<hr noshade>
	
	<div id="content">
		
		<?php 

			if($status == "nonmember"){
		?>
		<div id="slide">	
			<div id="banner-slide">
				<ul class="bjqs">
		          <li><img src="img/banner01.jpg" ></li>
		          <li><img src="img/banner02.jpg" ></li>
		          <li><img src="img/banner03.jpg" ></li>
		          <li><img src="img/banner04.jpg"></li>
		        </ul>
		    </div>
		</div>


		<div id="showlogin">
			<input type="button" id="btnLogin" value="Login" class="submit" >
			<br/><br/>
			or <a href="register.php">Register</a>

		</div>


	   <div id="login">
	   		Login


	   		<form method="post" action="control/dologin.php">
	   		<table>
		   		<tr>
			   		<td>Username</td>
			   		<td><input type="text" name="username"></td>
			   	</tr>
		   		
		   		<tr>
			   		<td>Password</td>
			   		<td><input type="password" name="password"></td>
		   		</tr>

				<tr>
                	<td colspan="2" align="center"> <input type="checkbox" name="remember" value="yes"> Remember Me</td>
              	</tr>

		   		<tr>
		   			<td colspan="2" align="center"><input type="submit" value="login" class="submit"></td>
	   			</tr>

	   			<tr>
	   				<td colspan="2" class="err"><?php if(isset($_GET['err'])) echo $_GET['err']?></td>
	   			</tr>
	   		</table>
	   		</form>
	   </div>

	<?php
		}
		else{
	?>   

		Welcome, admin<br/>
		<span id="date_time"></span>
		 <script type="text/javascript">window.onload = date_time('date_time');</script><br/>
		 <span id="user_online"> </span>
		 
		 

		<?php
		} 
		?>
	</div>

</div>


<script class="secret-source">
        jQuery(document).ready(function($) {
          	
          var x = Math.floor((Math.random() * 100) + 1);	
        	$("#user_online").text(x + " players online");

          $('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true
          });

          $("#login").hide();


          <?php 
          if(isset($_GET['err'])){

          ?>
	          	$("#showlogin").hide();
	          	$("#login").show();
          	
	      <?php
	        }
          ?>


          $("#btnLogin").click(function(){
          	$("#showlogin").fadeOut();
          	$("#login").fadeIn();
          });

        });
</script>