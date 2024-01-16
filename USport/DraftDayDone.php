<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$TeamId = $_POST['LastDrafted'];
$DraftYear = $_POST['DraftYear'];
$Round = $_POST['Round'];

if(!isset($_POST['Chosen']))
{
    /// this happens if the commish skips a person
    $DraftOrder = [];
    $row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
    $DraftOrder=[$row['Team1'],$row['Team2'],$row['Team3'],$row['Team4'],$row['Team5'],$row['Team6'],$row['Team7'],$row['Team8'],$row['Team9'],$row['Team10'],$row['Team11'],$row['Team12']];

    $index = array_search($TeamId, $DraftOrder);
    if($index !== false && $index < count($DraftOrder)-1) $next = $DraftOrder[$index+1];
    if($next == NULL)
    {
        $next = $DraftOrder['0'];
        $Round = $Round+1;
        if($Round > 10)
        {
            $insertQuery = "UPDATE fantdraft SET Current='0', LastChecked=CURRENT_TIMESTAMP, Round='11' WHERE LeagueId=$LId AND Yr=$DraftYear";
            ExecuteSqlQuery($insertQuery);
            $insertQuery = "UPDATE fantleagues SET Drafted='Y' WHERE LeagueId=$LId";
            ExecuteSqlQuery($insertQuery);
        }
        else
        {
            $insertQuery = "UPDATE fantdraft SET Current=$next, LastChecked=CURRENT_TIMESTAMP, Round=$Round WHERE LeagueId=$LId AND Yr=$DraftYear";
            ExecuteSqlQuery($insertQuery);
        }
    }
    {
        $insertQuery = "UPDATE fantdraft SET Current=$next, LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LId AND Yr=$DraftYear";
        ExecuteSqlQuery($insertQuery);
    }

    echo "Nobody was drafted for you, you can choose someone in Free Agency after the draft";
}
else
{
    $Draft = $_POST['Chosen'];
    $Name = $_POST['Name'];
    $Slot = "Slot$Round";
    $DraftOrder = [];
    $row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
    $DraftOrder=[$row['Team1'],$row['Team2'],$row['Team3'],$row['Team4'],$row['Team5'],$row['Team6'],$row['Team7'],$row['Team8'],$row['Team9'],$row['Team10'],$row['Team11'],$row['Team12']];

    $index = array_search($TeamId, $DraftOrder);
    if($index !== false && $index < count($DraftOrder)-1) $next = $DraftOrder[$index+1];
    if($next == NULL)
    {
        $next = $DraftOrder['0'];
        $Round = $Round+1;
        if($Round > 10)
        {
            $insertQuery = "UPDATE fantdraft SET Current='0', LastChecked=CURRENT_TIMESTAMP, Round='11' WHERE LeagueId=$LId AND Yr=$DraftYear";
            ExecuteSqlQuery($insertQuery);
            $insertQuery = "UPDATE fantleagues SET Drafted='Y' WHERE LeagueId=$LId";
            ExecuteSqlQuery($insertQuery);
        }
        else
        {
            $insertQuery = "UPDATE fantdraft SET Current=?, LastChecked=CURRENT_TIMESTAMP, Round=? WHERE LeagueId=$LId AND Yr=$DraftYear";
            ExecuteSqlQuery($insertQuery, $next,$Round);
        }

    }

    $insertQuery = "UPDATE fantdraft SET Current=$next, LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery);

    $insertQuery = "UPDATE fantteams SET $Slot=? WHERE LeagueId=$LId AND OwnerId=$UserId";
    ExecuteSqlQuery($insertQuery, $Draft);

    $insertQuery = "INSERT INTO rosterchosen SET PlayerId=?, LeagueId=?, TeamId=?";
    ExecuteSqlQuery($insertQuery, $Draft,$LId,$TeamId);

    echo "You chose $Name id";
}



?>

<script>
/*	LeagueId = "<?php echo $LId; ?>";
	round = "<?php echo $Round; ?>";
    function ScheduleCreate() {
			{   
                $("#Team").show();
				$.post("ScheduleCreate.php", {round:round, LeagueId:LeagueId }, function(data){
					$("#Team").html(data);
				});
			}
    }
    if(round>10)
    {
        alert("create sched here");
//        ScheduleCreate();
    }
*/
</script>
