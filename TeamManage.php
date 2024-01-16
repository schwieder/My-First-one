<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$TeamName = ReadScalar(ExecuteSqlQuery("SELECT teamName FROM hkyteams WHERE teamId ='$TeamId' AND ownerId = $UserId"));

echo "<br><br>Welcome to the $TeamName Management screen!<br><br>";

echo '<input type="button" name="Edit" id="'.$TeamId.'" class="btn btn-success Edit" value="Edit the '.$TeamName.' Lineup">';
echo '<input type="button" name="Players" id="'.$TeamId.'" class="btn btn-success Players" value="View the Players">';
echo '<input type="button" name="Lineup" id="'.$TeamId.'" class="btn btn-success Lineup" value="School/Finance Management">';
echo '<input type="button" name="Schedule" id="'.$TeamId.'" class="btn btn-success Schedule" value="'.$TeamName.' Schedule">';



?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Edit").on('click', function(){			
			{
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
				$.post("TeamManageSetLineup.php", {TeamId : TeamId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
		$(".Players").on('click', function(){			
			{   
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
				$.post("TeamManageViewPlayers.php", {TeamId : TeamId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
		$(".Lineup").on('click', function(){			
			{   
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
				$.post("TeamManageSchoolAndFinanceManagement.php", {TeamId : TeamId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
		$(".Schedule").on('click', function(){			
			{   
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
				$.post("TeamManageSchedule.php", {TeamId : TeamId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});

</script>

