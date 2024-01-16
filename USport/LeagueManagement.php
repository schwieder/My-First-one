<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];


// Drafting

    // Draft order Before the Draft

    // Start Draft within 30 min of Draft time

        // During Draft - Skip players, whatelse?????? 

echo "<br>";
$Drafted =  ReadScalar(ExecuteSqlQuery("SELECT Drafted FROM fantleagues WHERE LeagueId = '$LeagueId'"));
if($Drafted == 'N')
{
    echo '<input type="button" name="Draft" id="'.$LeagueId.'" class="btn btn-success Draft" value="Change Draft Info"> &nbsp';
}

echo '<input type="button" name="Rules" id="'.$LeagueId.'" class="btn btn-success Rules" value="League Rules/Points"><br>';


?>
<script type="text/javascript">
    $(".Rules").on('click', function(){			
        {
            var LeagueId = $(this).attr('id');
            $.post("LeagueManagementLeagueRules.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Draft").on('click', function(){			
        {
            var LeagueId = $(this).attr('id');
            $.post("NewDraftTime.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});

</script>
