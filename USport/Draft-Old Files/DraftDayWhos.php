<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$LastDrafted = $_POST['LastDrafted'];
$DraftYear = 2022;
$Round =  ReadScalar(ExecuteSqlQuery("SELECT Round FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
if($Round > 10)
{
    echo "The draft has been concluded";
    die;
}
else if($LastDrafted == 0)
{
    echo "<br>Waiting for the draft to start";
}
else 
{
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
// Set the date we're counting down to
var currentDate = new Date();
var startingDate = new Date(currentDate.getTime());
LastDrafted = "<?php echo $LastDrafted; ?>";
LeagueId = "<?php echo $LId; ?>";
DraftYear = "<?php echo $DraftYear; ?>";
Round = "<?php echo $Round; ?>";


function DoneDrafting()
{
    $.post("DraftDayDone.php", { LeagueId : LeagueId, LastDrafted:LastDrafted, DraftYear:DraftYear, Round:Round }, function(data){
        $("#Team").html(data);
    });
}



$(".Skip").on('click', function(){
    $.post("DraftDayDone.php", {LeagueId:LeagueId, LastDrafted:LastDrafted, DraftYear:DraftYear, Round:Round}, function(data){
        $("#Team").html(data);
    });
});
</script>
