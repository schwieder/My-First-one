<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$CurrTime = GETDATE();

$insertQuery = "UPDATE fantleagues SET Drafted='C' WHERE LeagueId=$LeagueId";
ExecuteSqlQuery($insertQuery);

$insertQuery = "UPDATE fantdraftstatus SET Ready='Y' WHERE TeamId=$TeamId";
ExecuteSqlQuery($insertQuery);

$insertQuery = "UPDATE fantdraft SET LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
ExecuteSqlQuery($insertQuery);

$LastChanged = ReadScalar(ExecuteSqlQuery("SELECT LastChecked FROM fantdraft WHERE LeagueId =$LeagueId"));



?>
<script>

	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LeagueId; ?>";
	LastChanged = "<?php echo $LastChanged; ?>";
    function Drafting() {
			{   
                $("#Team").show();
                $("#League").hide();
				$.post("DraftDay.php", {TeamId:TeamId, LeagueId:LeagueId }, function(data){
					$("#Team").html(data);
				});
			}
    }
    function ButtonsAndChart()
        {   
            $("#DraftButtons").show();
				$.post("DraftButtons.php", {LeagueId:LeagueId}, function(data){
					$("#DraftButtons").html(data);
				});
		}
Drafting();
ButtonsAndChart();

</script>
