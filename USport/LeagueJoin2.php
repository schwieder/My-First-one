<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueName = $_POST['LeagueName'];
$LeagueCode = $_POST['LeagueCode'];
$TeamName = $_POST['TeamName'];
if (!trim($TeamName ?? '')) {
    echo "There was no Team Name, please try again.";
    die;
}
$DraftYear = 2022;

$result =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantleagues WHERE (LeagueId = '$LeagueCode') AND (LeagueName = '$LeagueName');"));
$result2 =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantteams WHERE (LeagueId = '$LeagueCode') AND (OwnerId = '$UserId');"));
$result3 =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantteams WHERE (LeagueId = '$LeagueCode');"));
$MaxTeams =  ReadScalar(ExecuteSqlQuery("SELECT MaxTeams FROM fantleagues WHERE (LeagueId = '$LeagueCode') AND (LeagueName = '$LeagueName');"));

if($result == "0")
{
    echo "There is no League with that name and that Code. Sorry";
}
else if($result2 !="0")
{
    echo "You already have a team in this league";
}
else if($MaxTeams <= $result3)
{
    echo "This league is full already";
}
else
{
    $row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LeagueCode' AND Yr = '$DraftYear'"));
    $Round = $row['Round'];
    $DraftOrder = [];
    $DraftOrder=[$row['Team1'],$row['Team2'],$row['Team3'],$row['Team4'],$row['Team5'],$row['Team6'],$row['Team7'],$row['Team8'],$row['Team9'],$row['Team10'],$row['Team11'],$row['Team12']];
    
    $NextDraftPlace = array_search(NULL, $DraftOrder);
    
    if($Round>10)
    {
        echo "This league has already started, so you can't join. You could try starting your own.";
        die;
    }
    else if($NextDraftPlace>11)
    {
        echo "there are too many teams for you to draft, you'll have to Free Agency that shit. Good Luck Sucka";
        die;
    }
    else
    {
        $insertQuery = "INSERT INTO fantteams SET LeagueId=?, OwnerId=?, TeamName=?";
        ExecuteSqlQuery($insertQuery, $LeagueCode, $UserId, $TeamName); 
        sleep(1);

        $TeamId = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM fantteams WHERE LeagueId ='$LeagueCode' && OwnerId = '$UserId'"));
        $insertQuery = "INSERT INTO fantteamsstarters SET LeagueId=?, TeamId=?, OwnerId=?";
        ExecuteSqlQuery($insertQuery, $LeagueCode, $TeamId, $UserId);
    
    
        $NextDraftPlace = $NextDraftPlace+1;
        $Slot = "Team$NextDraftPlace";

        $insertQuery = "UPDATE fantdraft SET $Slot=? WHERE LeagueId=$LeagueCode AND Yr=$DraftYear";
        ExecuteSqlQuery($insertQuery, $TeamId);

        $insertQuery = "INSERT INTO fantschedule SET LeagueId=?, TeamId=?";
        ExecuteSqlQuery($insertQuery, $LeagueCode, $TeamId);

        $insertQuery = "INSERT INTO fantdraftstatus SET TeamId=?";
        ExecuteSqlQuery($insertQuery, $TeamId);

        $i = 0;
        while($i<8)
        {
            $i++;
            $insertQuery = "INSERT INTO fantresult SET Week=?, Team=?";
            ExecuteSqlQuery($insertQuery, $i, $TeamId);
        }
    }
    
    
    echo "You have joined $LeagueName and are the proud owners of $TeamName";
}

?>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Refresh").show();
	});

	LeagueId = "<?php echo $LeagueCode; ?>";
    function MakeSchedule() {
			{
				$.post("ScheduleCreate.php", {LeagueId:LeagueId }, function(data){
				});   
			}
    }
    MakeSchedule();


</script>
