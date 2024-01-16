 <?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$LeagueId = $_POST['LeagueId'];

echo "<br><br>Welcome to the Recruiting screen!<br><br>";

echo '<input type="button" name="All" id="'.$TeamId.'" idL="'.$LeagueId.'" class="btn btn-success All" value="View All Recruits">';
echo '<input type="button" name="Chosen" id="'.$TeamId.'" idL="'.$LeagueId.'" class="btn btn-success Chosen" value="View My List">';



?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".All").on('click', function(){			
			{
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
                var LeagueId = $(this).attr("idL");
				$.post("RecrutingManageAll.php", {TeamId : TeamId, LeagueId: LeagueId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
		$(".Chosen").on('click', function(){			
			{
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
                var LeagueId = $(this).attr("idL");
				$.post("RecrutingManageList.php", {TeamId : TeamId, LeagueId: LeagueId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});

</script>

