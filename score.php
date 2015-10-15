<script src="js/jquery-2.1.1.js"></script>

<div id="main">

<?php
	include("header.php");
	include("control/connect.php");

	$status = "nonmember";
	if(isset($_SESSION['status']))
		if($_SESSION['status'] == "admin") $status = "admin";
?>

<hr noshade>
	<div id="content">
	

		<div id="scoreheader">
			<div align="right">
				
				<div id="searchinput">
					Search by: 
				<select id="choosesearch">
					<option value="username">Username</option>
					<option value="rank">Rank</option>	
				
				</select>
					<form class="formsrc" method="POST" action="score.php">
						<input type="text" id="inputname" name="search" value="" placeholder="input username..">
					</form>

					<form class="formsrcrank" method="POST" action="score.php">
						<input type="text" id="inputrank" name="limit" value="" placeholder="input rank.." hidden>
					</form>
				
				</div>

			</div>

			Score List <br/>
			
		</div>

		Sort rank by: 
		<select id="changeorder">
				<option  value="score">High score</option>
				<option  value="playtime">Play Time</option>	
		</select>

		Ranks per Page : 
		<input type="radio" name="dataPerPage" value="5">5
		<input type="radio" name="dataPerPage" value="10">10
		

		<div id="loading"> </div>
		<table class="score">

			
				<tr>
					<td>Rank</td>
					<td>Username</td>
					<td>Play Time</td>
					<td>High Score</td>
					<?php if($status == "admin"){ ?>
					<td>Reset Score</td>
					<?php  } ?>
				</tr>
			
			
		<?php
			$order = "score";
			
			$search = "";
			
			/*
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$order = $_POST['orderby'];
				echo $order;
			}
			*/
			$dataPerPage =5;
			$noPage = 1;
			if(isset($_REQUEST['page']))
				$noPage = $_REQUEST['page'];
			$offset = ($noPage-1) * $dataPerPage;


			$limit="limit $offset,$dataPerPage";
			if(isset($_POST['search']))
				$search = $_POST['search'];

			if(isset($_POST['limit'])){
				$top = $_POST['limit'];
				$limit = "limit ".$top;
			}
			$query = "select * from MsMember m join TrScore ts on m.MemberId=ts.MemberId where username like '%$search%' and status!='admin' order by $order desc $limit";
			$i=1;
			
			$result = mysql_query($query);

			while ($row=mysql_fetch_array($result)) {
									
		?>
			
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['Username'];?></td>
				<td><?php echo $row['PlayTime'];?></td>
				<td><?php echo $row['Score']?></td>
				<?php if($status == "admin"){ ?>
				<td><a href="control/doResetScore.php?id=<?php echo $row['Memberid']?>"><button>Reset</button> </a></td>

				<?php } ?>
			</tr>
				

		<?php
			$i++;
			}
		?>
			
		</table>
		<br />
		<div align="center">
		Page
		<?php 
					//untuk mengetahui jumlah data
				$query3 = "select count(*) as jmlhData from msmember m join trscore ts on m.Memberid=ts.Memberid where status!='admin'";
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


</div>


<script>

//$("#inputname").hide();

	$("#choosesearch").change(function(){

		if( $("#choosesearch").val() == "username" ){

			$("#inputrank").hide();
			$("#inputname").show();

		}

		else {


			$("#inputname").hide();
			$("#inputrank").show();
			
		}
	});
	


/*
$("#search").click(function(){

	alert("ganti");
	$("#search").hide();
	$("#limit").show();

});

$("#limit").click(function(){
	$("#limit").hide();

	$("#search").show();

});


$("#changeorder").change(function(){
	//$(".score").hide();
	//$("#loading").show();
	//$("#loading").fadeIn("slow").html('Loading..');
	var orderby = $("#changeorder").val();
	$.ajax({
			type: "POST",
			url: "$_SERVER[PHP_SELF]",
			data:{
				orderby: orderby
			},
			success : function(data){

				alert("sukses")
				
			}
		})
			
			//$("#loading").hide();			
			//$(".score").show();
			

		
		});

});
*/
</script>