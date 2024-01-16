<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

echo "<br>";
echo '<input type="button" name="Schedule" id="'.$LeagueId.'" class="btn btn-success Schedule" value="Schedule"> &nbsp';
echo '<input type="button" name="Standings" id="'.$LeagueId.'" class="btn btn-success Standings" value="Standings"> &nbsp';




?>
<script type="text/javascript">
        TeamId = "<?php echo $TeamId; ?>";

    $(".Schedule").on('click', function(){			
        {
            $.post("Schedule.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Standings").on('click', function(){			
        {
            $.post("Standings.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
</script>
