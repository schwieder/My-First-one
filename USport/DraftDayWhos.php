<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
echo "<br>";
$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$LastDrafted = $_POST['LastDrafted'];
$DraftYear = 2022;
$Round =  ReadScalar(ExecuteSqlQuery("SELECT Round FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
$Team1 =  ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM rosterchosen WHERE LeagueId = '$LId'"));
if($Round > 10)
{
    echo "The draft has been concluded";
    die;
}
else 
{
    if($Team1 > 1){
        $DraftOrder = [];
        $row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
        $DraftOrder=[$row['Team1'],$row['Team2'],$row['Team3'],$row['Team4'],$row['Team5'],$row['Team6'],$row['Team7'],$row['Team8'],$row['Team9'],$row['Team10'],$row['Team11'],$row['Team12']];
        $DraftOrder = array_filter($DraftOrder);
        $index = array_search($LastDrafted, $DraftOrder);
        $count = count($DraftOrder)-1;
        $Previous = $index-1;
        if($Previous < 0)
        {
            $Previous = $count;
        }
        $Prev = $DraftOrder[$Previous];
        $PrevTeamName =  ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE LeagueId = '$LId' AND TeamId = '$Prev'"));
        $PrevPlayer =  ReadScalar(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LId' AND TeamId = '$Prev' ORDER BY Id DESC LIMIT 1"));
        $PrevPlayer = $PrevPlayer['PlayerId'];
        $PrevPlayerName =  ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$PrevPlayer'"));
        $N = $PrevPlayerName;
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo "$PrevTeamName chose $Name";
    }
    $TeamName =  ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE LeagueId = '$LId' AND TeamId = '$LastDrafted'"));
    echo "<br>Team $TeamName is currently drafting.";
    $Commish =  ReadScalar(ExecuteSqlQuery("SELECT CommishId FROM fantleagues WHERE LeagueId = '$LId'"));
    if($Commish == $UserId)
    {
        echo '<br><br><input type="button" name="Skip" class="btn btn-success Skip" value="Skip this Drafter"> &nbsp &nbsp';
    }
}

?>

<div id="Alert" style="text-align:center;"></div>

<script>
LastDrafted = "<?php echo $LastDrafted; ?>";
LeagueId = "<?php echo $LId; ?>";
DraftYear = "<?php echo $DraftYear; ?>";
Round = "<?php echo $Round; ?>";

$(".Skip").on('click', function(){
    $.post("DraftDayDone.php", {LeagueId:LeagueId, LastDrafted:LastDrafted, DraftYear:DraftYear, Round:Round}, function(data){
        $("#Team2").html(data);
    });
});
</script>
