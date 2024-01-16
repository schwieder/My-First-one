<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

echo "<br>";
echo '<input type="button" name="Weekly" id="'.$LeagueId.'" class="btn btn-success Weekly" value="Weekly Stats"> &nbsp';
echo '<input type="button" name="Leaders" id="'.$LeagueId.'" class="btn btn-success Leaders" value="Yearly Stats"> &nbsp';
echo '<input type="button" name="FreeAgents" id="'.$LeagueId.'" class="btn btn-success FreeAgents" value="Free Agents"> &nbsp';




?>
<script type="text/javascript">
    $(".FreeAgents").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("FreeAgents.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Leaders").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersYear.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Weekly").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("Weekly.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
</script>
