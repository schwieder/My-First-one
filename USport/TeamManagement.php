<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

echo "<br>";
echo '<input type="button" name="SetRoster" id="'.$LeagueId.'" class="btn btn-success SetRoster" value="Set Roster"> &nbsp';
echo '<input type="button" name="Trades" id="'.$LeagueId.'" class="btn btn-success Trades" value="Trades"> &nbsp';
echo '<input type="button" name="IncomingTrades" id="'.$LeagueId.'" class="btn btn-success IncomingTrades" value="Incoming Trades"> &nbsp';

?>
<script type="text/javascript">
    $(".SetRoster").on('click', function(){			
        {
            var LeagueId = $(this).attr('id');
            $.post("SetRoster.php", {LeagueId:LeagueId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Trades").on('click', function(){			
        {
            var LeagueId = $(this).attr('id');
            $.post("Trades.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".IncomingTrades").on('click', function(){			
        {
            var LeagueId = $(this).attr('id');
            $.post("IncomingTrades.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
</script>
