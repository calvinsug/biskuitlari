<script src="js/jquery-2.1.1.js"></script>
<script src="js/checkUsername.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/combodate.js"></script>
<script src="js/pass_check_strength.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">
<?php


   include("control/connect.php");

// define variables and set to empty values
$username = $password = $confirm_password = $fullname = $date = $address = $email = $confirm_email = $phone = "";
$usernameErr = $passwordErr = $confirm_passwordErr = $fullnameErr = $dateErr = $addressErr = $emailErr = $confirm_emailErr = $phoneErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = test_input($_POST["username"]);
   $password = test_input($_POST["password"]);
   $confirm_password = test_input($_POST["confirm_password"]);
   $fullname = test_input($_POST["fullname"]);
   $date = test_input($_POST["date"]);
   $address = test_input($_POST["address"]);
   $email = test_input($_POST["email"]);
   $confirm_email = test_input($_POST["confirm_email"]);
   $phone = test_input($_POST["phone"]);

   $newDate = date("Y-m-d", strtotime($date));

   $err = 0;

   //ini buat cek ada berapa special character sih di username
		$flagspecial = 0;
		for ($i=0; $i < strlen($username); $i++) {
			if (!is_numeric($username[$i]) && !ctype_alpha($username[$i])) 
				$flagspecial++;	
		}

		$angka=0;
		$huruf=0;
		for ($i=0; $i < strlen($password); $i++) {
			if (is_numeric($password[$i]) ) 
				$angka++;
			else if(ctype_alpha($password[$i]))
				$huruf++;		
		}


	$result = mysql_query('select username from Msmember where username = "'. $username .'"');  
	  
	if(mysql_num_rows($result)>0){  

	    $err = 1;
	    $usernameErr = "$username already exist";
	}


   if($username =="") {$usernameErr ="username must be filled"; $err=1;}
   else if(strlen($username) < 4 || strlen($username)>15) {$usernameErr="username length must be 4 - 15 characters"; $err=1;}
   else if(is_numeric($username[0])) {$usernameErr= "username must not started with number"; $err=1;}
   else if($flagspecial >0) {$usernameErr = "username must not contain non-alphanumeric"; $err=1;}

   if($password =="") {$err=1; $passwordErr="password must be filled";}
   else if(strlen($password) < 4 ) {$err=1; $passwordErr="password length must be 4 characters minimum";}
   else if(!is_numeric($password[0]) && !ctype_alpha($password[0])) {$passwordErr= "password must not started with non-alphanumeric"; $err=1;}
   else if($angka ==0 || $huruf ==0) {$err=1; $passwordErr="password must contain alphanumeric";}
   //Regex utk check alphanumeric gagal
   //else if( preg_match("/^[a-zA-Z]{1,}$/", $password) && preg_match("/^[0-9]{1,}$/", $password) )        {$err=1; $passwordErr="password must contain alphanumeric";}


   if($confirm_password =="") {$err=1; $confirm_passwordErr ="Confirm password must be filled";}
   else if($confirm_password != $password) {$err=1; $confirm_passwordErr="confirm password must be same with your password";}

   if($fullname=="") {$err=1; $fullnameErr= "fullname must be filled";}
   else if( preg_match("/[0-9]/", $fullname)) {$err=1; $fullnameErr = "fullname must not contain any number";}

   if($email=="") {$err=1; $emailErr="email must be filled";}
   else if(!is_numeric($email[0]) && !ctype_alpha($email[0])) {$err=1; $emailErr="email must not started with any symbols";}
   else if(!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", $email)) {$err=1;$emailErr="email is not valid";}

   if($confirm_email=="") {$err=1 ; $confirm_emailErr="confirm email must be filled";}
   else if($confirm_email != $email) {$err=1; $confirm_emailErr="confirm email must be same with email address";}

   if($date =="") {$err=1; $dateErr= "date of birth must be filled";}

   if( preg_match("/[a-zA-Z]/", $phone)) {$err=1; $phoneErr="phone must not contain alphabets";}
   else if(preg_match("/([!,%,&,@,#,$,^,*,?,_,~])/", $phone)) {$err=1; $phoneErr="phone must not contain any symbols";}

   if(strlen($address) > 500) {$err=1; $addressErr="address maximum 500 characters";}
	//klo err masih 0 , artinya lolos validasi   	
   if($err==0){
	  $query1 = "insert into msmember(Username,Password,Status,LastLogin) values('$username','".md5($password)."','player','".date('Y-m-d H:i:s')."')";
	   $query2 = "insert into msmemberprofile(Username,Fullname,DateOfBirth,RegisterDate) values('$username','$fullname','$newDate','".date('Y-m-d H:i:s')."')";
	   $query3 ="insert into msmembercontact(Address,Phone,Email) values('$address','$phone','$email')";

	   mysql_query($query1);
	   mysql_query($query2);
	   mysql_query($query3);

	   $queryid = "select max(Memberid) from msmember";
	   $rs = mysql_query($queryid);
	   $row = mysql_fetch_array($rs);
	   $newid = $row[0];
	   $query4 = "insert into trscore(Memberid,Score,isHighScore,PlayTime) values($newid,0,'no','00:00:00')";

		mysql_query($query4);
	   session_start();
	   $_SESSION['status']='player';
	   $_SESSION['useronline'] = $username;

	   header("location:play.php");
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<div id="main">
	<?php
	include("header.php");
		
	?>
	<hr noshade>
	<div id="content">
		
		<form id="register" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="inforegis">Account Information	 </div>
		<table>

		<tr>
			
			<td>Username </td>
			<td><input type='text' id='username' name='username' value="<?php echo $username; ?>"></td>
			<td><input type='button' class="submit" id='check_username_availability' value='Check Availability'> </td> 
			<td><label class="short" id='username_availability_result'><?php echo $usernameErr;?></label></td>

		</tr>

		<tr>
			<td>Password </td>
			<td><input type='password' id='password' name='password' value="<?php echo $password; ?>"> </td>
			<td colspan="2"> <span class="short" id="result"><?php echo $passwordErr;?></span> </td>
		</tr>


		<tr>
			<td>Confirm Password </td>
			<td><input type='password' id='confirm_password' name='confirm_password' value="<?php echo $confirm_password; ?>"> </td>
			<td colspan="2"> <span id="resultconfirm" class="short"><?php echo $confirm_passwordErr?></span></td>

		</tr>
		</table>		

		<div class="inforegis">User Information	 </div>
		
		<table>
		<tr>
			
			<td>Fullname </td>
			<td><input type='text' id='fullname' name='fullname' value="<?php echo $fullname; ?>"> </td>
			<td colspan="2"><label class="short"><?php echo $fullnameErr;?></label></td>

		</tr>

		<tr>
			<td>Date of Birth </td>
			<td><input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="date" value="<?php echo $date; ?>"> </td>
			<td colspan="2"> <label class="short"><?php echo $dateErr;?></label></td>
		</tr>

		<tr>
			<td>Address </td>
			<td><textarea id="address" rows="4" cols="25" name='address'><?php echo $address;?></textarea></td>
			<td colspan="2"> <label class="short"><?php echo $addressErr;?></label></td>

		</tr>
		</table>



		<div class="inforegis">Contact Information	 </div>
		
		<table>
		<tr>
			
			<td>Email </td>
			<td><input type='text' id='email' name='email' value="<?php echo $email; ?>"> </td>
			<td colspan="2"><label class="short"><?php echo $emailErr;?></label></td>

		</tr>

		<tr>
			<td>Confirm Email </td>
			<td><input type='text' id='confirm_email' name="confirm_email" value="<?php echo $confirm_email; ?>">  </td>
			<td colspan="2"> <label class="short"><?php echo $confirm_emailErr;?></label></td>
		</tr>


		<tr>
			<td>Phone Number</td>
			<td><input type='text' id='phone' name='phone' value="<?php echo $phone;?>"> </td>
			<td colspan="2"> <label class="short"><?php echo $phoneErr;?></label></td>

		</tr>

		<tr>
			<td><input type="submit" value="Submit" id="submit" class="submit"> </td>
			<td><input type="button" value="Reset" id="reset" class="cancel"> </td>
		</tr>

		</table>

		
			
	</form>
	</div>

</div>

<script>
$(function(){
    $('#date').combodate();  

   

});

//function buat reset isi formnya bro
function clear_form_elements(ele) {
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

$("#reset").click(function(){
	clear_form_elements(this.form);

});

</script>