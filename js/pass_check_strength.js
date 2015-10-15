
$(document).ready(function()
{
	var trigger=0;
	//trigger klo input password
	$('#password').keyup(function()
	{
		$('#result').html(checkStrength($('#password').val()));


		$('#password').focusout(function(){
			if($('#password').val() == "") trigger=0;
			else trigger=1;
		});

		if(trigger==1)
		$('#resultconfirm').html(checkConfirmPass($('#confirm_password').val()));

		
	})	
	
	$('#confirm_password').focusout(function()
	{
		$('#resultconfirm').html(checkConfirmPass($('#confirm_password').val()))
	})	

	/*
		function buat check password
	*/
	
	function checkConfirmPass(confirm_password){

			if(confirm_password==""){
				$('#resultconfirm').removeClass()
				$('#resultconfirm').addClass('short')
				
				return 'confirm password must be filled'

			}
			else if( $('#password').val() == confirm_password){
				
				$('#resultconfirm').removeClass()
				$('#resultconfirm').addClass('strong')
				return 'OK' 
			}
			else {


				$('#resultconfirm').removeClass()
				$('#resultconfirm').addClass('short')
				
				return 'confirm password must be same with your password'	

				
			}
	}

	/*
		function buat check password
	*/
	
	function checkStrength(password)
	{

		var strength = 0
		var flag = 0;
		

		if (password.length > 7) strength += 1
		
		//strength bertambah kalo ada huruf besar dan kecil
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//klo mengandung angka ama ama huruf, strength jg nambah dan tandain flag = 1
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) { strength += 1 ; flag=1;} 
		
		//klo ada special character, strength nambah
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//klo special characternya ada 2 ato lbih, strength nambah lagi
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		

		
		if (password.length < 4) { 
			$('#result').removeClass()
			$('#result').addClass('short')
			return 'Too short' 
		}

		
		//jika nilai strength < 2 , passwordnya weak
		if (strength < 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('weak')
			return 'Strength: Weak'			
		}
		// klo strengthnya 2 , termasuk good
		else if (strength == 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('good')
			return 'Strength: Good'		
		}
		// klo lbih dari 2 ya strong
		else
		{
			$('#result').removeClass()
			$('#result').addClass('strong')
			return 'Strength: Strong'
		}
	}
});