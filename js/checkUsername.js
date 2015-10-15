$(document).ready(function() {  
  
          

        //klo tombolnya diclick
        $('#check_username_availability').click(function(){  
            
            var username = $('#username').val();
             $('#username_availability_result').css( "color", "red" );
            if($('#username').val().length < 4 || $('#username').val().length > 15 ){  
                //if it's bellow the minimum show characters_error text '  
                
                $('#username_availability_result').html('username length must be 4 - 15 characters');  
            }
            else if(isDigit(username)==true)  $('#username_availability_result').html('username must not started with number'); 
            else if(checkAlphanumeric(username)==false)  $('#username_availability_result').html('username must not contain non-alphanumeric'); 
            else{  
                //else show the cheking_text and run the function to check  
                $('#username_availability_result').css( "color", "black" );
                $('#username_availability_result').html('Checking...');  
                 
                check_availability();  
            }  
        });  
  
  });  
  

//check digit
function isDigit(username)
   {
    var username = username;
    var myCharCode = username.charCodeAt(0);
     
      if((myCharCode > 47) && (myCharCode <  58))
      {
       
         return true;
      }
   
      return false;
   }

function checkAlphanumeric(username){

  var username = username;
  var i =0;
  var huruf=0;
  var angka =0;
    for(i=0;i<username.length ; i++){

      if(username.charCodeAt(i) > 47 && username.charCodeAt(i) < 58)    
          angka++;
      else if( (username.charCodeAt(i) >= 97 && username.charCodeAt(i) <=122) || (username.charCodeAt(i) >= 65 && username.charCodeAt(i) <=90) ) 
          huruf++;
      else return false; 
    }

    return true;
}

//function dipake buat check usernamenya 
function check_availability(){  
  
        //ambil usernamenya
        var username = $('#username').val();  
  
        //pake AJAX buat dicheck usernamenya
        $.post("../biskuitlari/control/checkUser.php", { username: username },  
            function(result){  
                //if the result is 1  
                if(result == 1){  
                    //nah usernamenya bisa dipake neh
                    $('#username_availability_result').css( "color", "green" );
                    $('#username_availability_result').html(username + ' is Available'); 

                  

                }else{  
                    //usernamenya gk bisa dipake
                    $('#username_availability_result').css( "color", "red" );
                    $('#username_availability_result').html(username + ' is not Available');  
                }  
        });  
  
       
};  