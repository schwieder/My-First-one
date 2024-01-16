<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueId = $_POST['LeagueId'];
$_SESSION['LeagueId'] = $LeagueId;
$Commish =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantleagues WHERE (CommishId = '$UserId') AND (LeagueId = '$LeagueId');"));
$LInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
$TInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId'"));
$TeamName = $TInfo['TeamName'];
$TeamId = $TInfo['TeamId'];
$LeagueName = $LInfo['LeagueName'];
$Drafted = $LInfo['Drafted'];
$DraftTime = $LInfo['DraftTime'];
echo "$TeamName<br><br>";
if($Drafted == "N"){
    if($Commish == "1")
    {
        echo "Let others know your League's Name is '<u>$LeagueName</u>' and your League Code is '<u>$LeagueId</u>', so they can join<br><br>";
    }
    $Now = date('Y-m-d H:i:s');
    $hrMinus = date('Y-m-d H:i:s',strtotime('-30 minutes',strtotime($DraftTime)));
    if($Now>$hrMinus && $Commish == "1")
    {
        echo "Your Leagues draft time is $DraftTime<br>";
        echo '<br><input type="button" name="StartDraft" id="'.$LeagueId.'" id2="'.$TeamId.'" class="btn btn-success StartDraft" value="Start the Draft"><br>';
    }
    else
    {
        echo "Your Leagues draft time is $DraftTime<br>";
    }

}
If($Drafted=="C")
{
    if($Commish == "1")
    {
        echo '<br><input type="button" name="JoinDraft" id="'.$LeagueId.'" id2="'.$TeamId.'" class="btn btn-success JoinDraft" value="Continue the Draft"><br>';
    }
    else
    {
        echo '<br><input type="button" name="JoinDraft" id="'.$LeagueId.'" id2="'.$TeamId.'" class="btn btn-success JoinDraft" value="Join the Draft"><br>';
    }
}
if($Commish == "1")
{
    echo '<br><input type="button" name="Manage" id="'.$LeagueId.'" class="btn btn-success Manage" value="League Management"><br>';
}

echo '<br><input type="button" name="Team" id="'.$LeagueId.'" class="btn btn-success Team" value="Team"> &nbsp';
echo '<input type="button" name="League" id="'.$LeagueId.'" class="btn btn-success League" value="League"> &nbsp';
echo '<input type="button" name="Players" id="'.$LeagueId.'" class="btn btn-success Players" value="Players"> &nbsp';




?>
<script type="text/javascript">
    LeagueId = "<?php echo $LeagueId; ?>";
    TeamId = "<?php echo $TeamId; ?>";
    $(".StartDraft").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("DraftStart.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".JoinDraft").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("DraftJoin.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Manage").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeagueManagement.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Team").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("TeamManagement.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Players").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("Players.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".League").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeagueButton.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
</script>
