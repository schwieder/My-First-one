<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$CurrTime = GETDATE();
$DraftYear = '2022';
$FirstTeam =  ReadScalar(ExecuteSqlQuery("SELECT Team1 FROM fantdraft WHERE LeagueId = '$LeagueId' AND Yr = '$DraftYear'"));

$insertQuery = "UPDATE fantleagues SET Drafted='C' WHERE LeagueId=$LeagueId"; //C = currently drafting
ExecuteSqlQuery($insertQuery);

$insertQuery = "UPDATE fantdraft SET Round='1', Current=$FirstTeam WHERE LeagueId=$LeagueId";
ExecuteSqlQuery($insertQuery);

?>
<script>

	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LeagueId; ?>";
    function DraftJoin() {
			{
                $("#Team2").show();
                $("#League").hide();
				$.post("DraftJoin.php", {TeamId:TeamId, LeagueId:LeagueId }, function(data){
					$("#League").html(data);
				});
			}
    }
DraftJoin();

</script>
