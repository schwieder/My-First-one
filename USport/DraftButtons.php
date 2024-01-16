<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

echo "<br>";
echo '<input type="button" name="Activity" class="btn btn-success Activity" value="User Activity"> &nbsp &nbsp';    
echo '<input type="button" name="Players" class="btn btn-success Players" value="Players Available"> &nbsp &nbsp';
echo '<input type="button" name="MyTeam" class="btn btn-success MyTeam" value="My Team"> &nbsp &nbsp';
echo "<br>";



?>
    <script type="text/javascript">
	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LeagueId; ?>";
    Pos = 'QB';
    Sort = 'PlayerId';

    $(".Activity").on('click', function(){			
        {
            $("#Drafting").show();
            $.post("DraftActivity.php", {TeamId:TeamId, LeagueId:LeagueId}, function(data){
                $("#Drafting").html(data);
            });
        }
	});

    $(".Players").on('click', function(){			
        {
            $("#Drafting").show();
            $.post("DraftChart.php", {LeagueId:LeagueId, Pos:Pos, Sort:Sort}, function(data){
                $("#Drafting").html(data);
            });
        }
	});

    $(".MyTeam").on('click', function(){			
        {
            $("#Drafting").show();
            $.post("DraftMyTeam.php", {LeagueId:LeagueId, Pos:Pos, Sort:Sort}, function(data){
                $("#Drafting").html(data);
            });
        }
	});
</script>

