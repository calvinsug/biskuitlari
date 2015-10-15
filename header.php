<html>

<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>




<body>
	
    <div align="center" class="headertext">
    Biskuit Lari
    </div>
    
	<?php 
        session_start();
        if(isset($_SESSION['status']))
        {
    
            // klo member biasa
            if($_SESSION['status'] =="player"){
    ?>
                <ul>
                    <li><a href="play.php" class="menuMember">Play Game</a></li>
                    <li><a href="profile.php" class="menuMember">Profile</a></li>
                    <li><a href="score.php" class="menuMember">Scores</a></li>
                    <li><a href="about.php" class="menuMember">About</a></li>
                    <li><a href="control/dologout.php" class="menuMember">Logout</a></li>
  
                </ul>
	<?php
            }
            else if($_SESSION['status'] == "admin"){ 
    ?>
            	<ul>
                    <li><a href="home.php" class="menuAdmin">Home</a></li>
                    <li><a href="listplayer.php" class="menuAdmin">Players</a></li>
                    <li><a href="score.php" class="menuAdmin">Scores</a></li>
                    <li><a href="control/dologout.php" class="menuAdmin">Logout</a></li>
                    
                </ul>
	<?php
			}
		}
		else{
	?>
    		<ul>
                <li><a href="home.php" class="menuNonMember">Home</a></li>
                <li><a href="register.php" class="menuNonMember">Register</a></li>
                <li><a href="score.php" class="menuNonMember">Scores</a></li>
                <li><a href="about.php" class="menuNonMember">About</a></li>
            </ul>
	<?php
        }
    ?>

</body>
</html>