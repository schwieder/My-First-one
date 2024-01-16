<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId'")) as $row)
{
    $TeamName = $row['TeamName'];
    $Ready = ReadScalar(ExecuteSqlQuery("SELECT Ready FROM fantdraftstatus WHERE TeamId =".$row['TeamId'].""));
    if($Ready == 'Y'){$Status = "Ready";}
    else if ($Ready == 'N'){$Status = "Not Online";}
    else if ($Ready == 'A'){$Status = "Away";}
    echo "$TeamName are $Status &nbsp";
}
$Started = ReadScalar(ExecuteSqlQuery("SELECT Current FROM fantdraft WHERE LeagueId =$LeagueId"));
echo $Started;
echo "<br><br>";
if($Started == 0){
    echo '<input type="button" name="Start" id="'.$LeagueId.'" class="btn btn-success Start" value="Start the Draft"> &nbsp &nbsp';    
}
echo '<input type="button" name="EndDraft" id="'.$LeagueId.'" class="btn btn-success EndDraft" value="End The Draft"> &nbsp &nbsp';
echo "<br>";



?>
    <script type="text/javascript">

    $(".Start").on('click', function(){			
        {
            $("#Team").show();
            var LeagueId = $(this).attr('id');
            $.post("DraftStartCommish.php", {LeagueId:LeagueId}, function(data){
                $("#Team").html(data);
            });
            $.post("DraftButtons.php", {LeagueId:LeagueId}, function(data){
                $("#DraftButtons").html(data);
            });
        }
	});

</script>

