<script src="js/jquery-2.1.1.js"></script>

<div id="main">



<?php

	include("header.php");
	include("control/connect.php");

	if (isset($_COOKIE["user"]))	{
		$_SESSION["useronline"] = $_COOKIE["user"];
		$_SESSION["status"] = $_COOKIE["status"];
	}


	if(isset($_SESSION['useronline'])){
			
				if($_SESSION['status']!="player"){
				header("location:home.php");
				}	
	}
	else			
		header("location:home.php");	

	$query = "select * from MsMember m join TrScore ts on m.MemberId=ts.MemberId where isHighScore='yes' ";

	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

?>
	

	<hr noshade>
	<div id="content">

		<div align="center" id="showhighscore">
			Highest Score <br/>
			<?php echo $row['Username']?>
			<br/>
			<?php echo $row['Score']?>

		</div>


		<div id="play" align="center">

			<button id="btnPlay" class="submit">Play Game</button>

		</div>

	<canvas class="play" id="myCanvas" width="600px" height="400px">
		Your browser doesn`t support canvas

	</canvas>


	</div>	


</div>




<script>

		$(".play").click(function(){

			if(currmenu== "menu"){
				currmenu = "init";
				isdead = false;
				isplay = true ;
				themesound.play();
			}
			
			else if (currmenu=="dead"){
				
				isdead= false;
				isplay= true;
				h=0;
				m=0;
				s=0;
				location.reload();
				bgReady = true;
				score = 0;
				currmenu = "init";
				//animationManager();
			}
			

		});
		//var playtime =0;
		var coinsound = new Audio('audio/coin.wav');
		var gameoversound = new Audio('audio/gameover.wav');
		var h=0;
		var m=0;
		var s=0;
		var flagh=1;
		var flagm=1;
		var flags=1;
		var isHighScore = false;
		var themesound = new Audio('audio/theme.mp3');
		var canvas = document.getElementById("myCanvas");
		var context = canvas.getContext("2d");
		var context2 = canvas.getContext("2d");
		var menu = canvas.getContext("2d");
		var gameover = canvas.getContext("2d");
		var score = 0;
		var isplay = false;
		var isdead = false;
		var isCollision = false;
		var biskuit = {	
			x : 45, 
			y: canvas.height-100,
			width: 50,
			height:100,
			vY: 10,
			isJump : false,
			isDash : false
		};

		var balok={
			width:50,
			height: 75,
			x: canvas.width - 100,
			y: canvas.height - 75,
			vX: 3,
			type: Math.floor(Math.random()*2 +1)
		};

		var coin={
			width:60,
			height:60,
			x:canvas.width -60,
			y:canvas.height -60,
			vX: 3,
			type:Math.floor(Math.random()*3 +1)

		}

		var gravitasi = 0.2 ;
		var currmenu ="init";


		var bgReady = false;
		var bgImage = new Image();
		var runImage = new Array();
		var dashImage = new Array();
		var coinImage= new Array();
		var Obstacle=new Array();
		var Objcoin = new Array();
		var counterDashImage=0;
		var counterRunImage=0;
		var frameCoin = 0;
		var blockImage= new Image();

		for(var i=0;i<7;i++){
			var Img=new Image();
			Img.src="img/sonicDash/"+i+".png";
			//console.log(Img.src);
			dashImage.push(Img);
		}

		for(var i=0;i<10;i++){
			var Img=new Image();
			Img.src="img/coin/"+i+".png";
			//console.log(Img.src);
			coinImage.push(Img);
		}


		for(var i=0;i<9;i++){
		var Img=new Image();
		Img.src="img/sonicRun/"+i+".png";
		//console.log(Img.src);
		runImage.push(Img);
		}
		bgImage.src = "img/background.jpg";
		blockImage.src = "img/block.png";	
		setInterval(function(){
			 ObstacleSpawn();
			},2000);

		setInterval(function(){
			 Coinspawn();
			 if( Math.floor(Math.random()*10 +1) ==1 ) Coinspawn();
			},3000);

		setInterval(function(){
			
			 if( Math.floor(Math.random()*5 +1) ==1 ) Coinspawn();
			},1000);

		function calculateScore(){



				setInterval(function(){
					if (isdead == false) {
						score += 1 ;
						if(biskuit.isDash==true){
							//buat atur value dari animasi Dash
							if(counterDashImage+1>6)
								counterDashImage=0;
							else
								counterDashImage+=1;
						}
						else{
							//buat atur value dari animasi run	
							if(counterRunImage+1>8)
								counterRunImage=0;
							else
								counterRunImage+=1;

						}

						if(frameCoin+1 > 9)
							frameCoin=0;
						else frameCoin+=1;
						console.log("a");
					};

				},100);

				setInterval(function(){
					if (isdead == false) {
						//playtime +=1;

						s+=1;
						if(s>59){
							s=0;
							m+=1;

						}
						if(m>59){
							m=0;
							h+=1;
						}
						//s= (s < 10 ? "0" : "" ) + s;
						//m= (m < 10 ? "0" : "" ) + m;
						//h= (h < 10 ? "0" : "" ) + h;
					};

				},1000);

			currmenu ="game";
		}

		function Coinspawn(){

			var obj2 = {	
			width:60,
			height: 60,
			x: canvas.width - 60,
			y: canvas.height - 65,
			vX: Math.floor(Math.random()*3 +6),
			type: Math.floor(Math.random()*3 +1),
			
			};

			if(isplay==true && isdead ==false)
			Objcoin.push(obj2);
		}

		function ObstacleSpawn(){

		

			var obj = {	
			width:Math.floor(Math.random()*25 +40),
			height: Math.floor(Math.random()*50 +65),
			x: canvas.width - 10,
			y: canvas.height - 75,
			vX: Math.floor(Math.random()*3 +6),
			type: Math.floor(Math.random()*2 +1),
			color: "0000FF"
			};

			if(isplay==true && isdead ==false)
			Obstacle.push(obj);


		}

		function animationManager(){
				//1.hapus canvas

				context.clearRect(0,0,canvas.width,canvas.height);
				
				//2.kalkulasi
				update();

				//3.gambar canvas
					if(currmenu=="init"){
						calculateScore();
					}
					else if(currmenu=="game"){
					drawGame();				
					}
					else if(currmenu=="dead"){

						drawGameover();
					}
					else if(currmenu == "menu")
						drawMenu();
				//4. ulangi dari nomor 1
				requestAnimationFrame(animationManager);

		}		



		function drawMenu(){

			menu.drawImage(bgImage,0,-0,600,400);
			context.fillStyle = "#FF0000";
			context.font = "30px arial";
			//var widthText = context.measureText("Score :"+score).width;
			//kata, x , y
			context.fillText("Play", canvas.width/2, canvas.height/2);



		}

		function drawGameover(){
			gameover.drawImage(bgImage,0,0,600,400);
			
			//var widthText = context.measureText("Score :"+score).width;
			//kata, x , y
			if(isHighScore == false){
				gameover.fillStyle = "#FF0000";
				gameover.font = "30px arial";
				gameover.fillText("Game Over ", 260, 160);
				gameover.fillText("Your score : "+score,260, 200 );
				gameover.fillText("Playtime: "+h+":"+m+":"+s,260,240);
				gameover.fillText("Retry", 260, 280);
			
			}
			else{
				$("#showhighscore").html("Highest Score</br>	<?php echo $_SESSION['useronline'];?> <br/>	"+score);
				gameover.fillStyle = "#0000FF";
				gameover.font = "30px arial";
				gameover.fillText("Congratulations , ",200, 160);
				gameover.fillText("you beat the highest score",200,200);
				gameover.fillText("your score : "+score, 200, 240);
				gameover.fillText("Playtime: "+h+":"+m+":"+s,200,280);
				gameover.fillText("Retry", 200,320);

			}

			bgReady = false;
		}

		function Dash(){
			if(biskuit.isJump==true)
				return false;

			if(biskuit.isDash == false ){
					biskuit.isJump=false; 
					var temp=0;
					temp = biskuit.height;

					biskuit.height= biskuit.width;
					biskuit.width = temp;
					biskuit.y = canvas.height - 50;
				
				}

			biskuit.isDash = true;	
		}

		function jump(){
				if(biskuit.isDash==true){

					var temp=0;
					temp = biskuit.height;
					biskuit.height= biskuit.width;
					biskuit.width = temp;
					biskuit.y = canvas.height - 100;
					biskuit.isDash = false;
				}

		

		}


		function update(){

				
				if(biskuit.isJump ==true){

					biskuit.y -= biskuit.vY;
					biskuit.vY -= gravitasi;
					//isDash=false;



					if(biskuit.y + 100 > canvas.height-1){
						biskuit.isJump = false;
						biskuit.vY = 10;
					}
				}

				if(isdead==false && currmenu =="game")
					for (var j =0;j< Objcoin.length; j++) {
						Objcoin[j].x -= Objcoin[j].vX;
						//console.log("x coin:"+Objcoin[j].x);

							//dapetin coin
							if(Objcoin[j].x < biskuit.x+biskuit.width && ( (biskuit.y < (Objcoin[j].y +Objcoin[j].height)&&biskuit.y>Objcoin[j].y) || (biskuit.y+biskuit.height <= Objcoin[j].y+Objcoin[j].height && biskuit.y +biskuit.height > Objcoin[j].y )  ) ){
								score +=100;
								coinsound.play();
								Objcoin.splice(j,1);
							}

							else
								if(Objcoin[j].x < -Objcoin[j].width)	Objcoin.splice(j,1);
					};
					

			if(isdead == false && currmenu=="game")
				for(var i=0;i<Obstacle.length;i++){
					Obstacle[i].x -= Obstacle[i].vX;
				

					//Collision bro alias game over
					
					//if( (Obstacle[i].x < biskuit.x +biskuit.width) && (biskuit.y >300) ){

					if(isCollision == false){

						//balok di daratan
						if(Obstacle[i].type==1){
							if(Obstacle[i].x < biskuit.x+biskuit.width && (biskuit.y+biskuit.height) > Obstacle[i].y){
								isCollision = true;
								console.log("ketabrak type :" +Obstacle[i].type);
							}
						}
							//klo balok di atas
						else if(Obstacle[i].type ==2){
							if(Obstacle[i].x < biskuit.x+biskuit.width && biskuit.y < Obstacle[i].height){
								isCollision = true;	
								console.log("ketabrak type : "+Obstacle[i].type);
							}
						}
					}

					if(Obstacle[i].x < -Obstacle[i].width){
						 
						console.log("ancur 1 type:"+Obstacle[i].type);
						Obstacle.splice(i,1);
					}

					//if( Obstacle[i].x < biskuit.x +biskuit.width ){
					if(isCollision==true){
						isdead = true;
						isplay = false;
						gameoversound.play();
						//console.log("posisi Y obstacle : "+Obstacle[i].y);
						console.log("posisi Y biskuit : "+biskuit.y);
						var username = "<?php echo $_SESSION['useronline']?>";
						$.post("../biskuitlari/control/checkScore.php", { score: score , username: username ,s:s,m:m,h:h},  
            				function(result){  
		                		//klo result 1 brati high scoer
		              		  if(result == 1){  
				                   isHighScore = true;
				                }else{  
				                    //blom high score
				                    isHighScore= false;
				                }  
   						    });

   						 currmenu = "dead";     

					}
					
					

				}

				//console.log(biskuit.y);

		}

		function drawObstacle(obj){

			//tipe obstacle
			context2.fillStyle = obj.color;
			if(obj.type ==1){
				//context2.fillRect(obj.x,obj.y,obj.width,obj.height);	
				context2.drawImage(blockImage,obj.x,obj.y,obj.width,obj.height)
			}
			else {
				//context2.fillRect(obj.x,0,obj.width,obj.height);
				context2.drawImage(blockImage,obj.x,0,obj.width,obj.height)
				obj.y = 0;
				obj.height = 330;
			}
	

		}

		function drawCoin(obj){


			if(obj.type ==1){
				context2.drawImage(coinImage[frameCoin],obj.x,obj.y,obj.width, obj.height);	
			}
			else if (obj.type==2) {
				context2.drawImage(coinImage[frameCoin],obj.x,obj.y,obj.width, obj.height);
				obj.y = 300;
			}
			else {
				context2.drawImage(coinImage[frameCoin],obj.x,obj.y,obj.width, obj.height);
				obj.y = 200;

			}	
				
			
		}
		
		function drawGame(){
		



			

			
				bgReady = true;
				context.drawImage(bgImage,0,-0,600,400);
			


			
			if(biskuit.isDash==true)
			context2.drawImage(dashImage[counterDashImage],biskuit.x,biskuit.y,biskuit.width, biskuit.height);
				else
			context2.drawImage(runImage[counterRunImage],biskuit.x,biskuit.y,biskuit.width, biskuit.height);
			//context.fillRect(biskuit.x,biskuit.y,biskuit.width, biskuit.height);
			for(var j=0;j<Objcoin.length;j++)
				drawCoin(Objcoin[j]);

			for(var i=0;i<Obstacle.length;i++)
				drawObstacle(Obstacle[i]);
			context2.fillStyle = "#FF0000";
			context2.font = "30px arial";
			var widthText = context.measureText("Score :"+score).width;


			context2.fillText("Playtime: "+h+":"+m+":"+s, 0, 30);
			//kata, x , y
			context2.fillText("Score :"+score, canvas.width - widthText, 30);

		}

		$(window).on("keydown",function(e){
			console.log(e.which);
			if(isdead == false){
				switch(e.which){
					case 38 : biskuit.isJump = true; jump();break;
					case 40 : Dash(); break; 
				}
			}
		});

		$(window).on("load",function(){





			

			//gk jdi pake button
			//$("#btnPlay").click(function(){
				
				//isplay = true;
				currmenu = "menu";
				$("#play").hide();

				animationManager();

							
			//});


			
			



		});

		
	</script>