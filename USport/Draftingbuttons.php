<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = $_POST['DraftYear'];

$Round =  ReadScalar(ExecuteSqlQuery("SELECT Round FROM fantdraft WHERE LeagueId = '$LeagueId' AND Yr = '$DraftYear'"));
echo "Round is $Round <br>";
if($Round > 10)
{
    echo "The draft has been concluded";
    die;
}
echo "<h4>It's round $Round, who would you like to draft? </h4>";
echo '<input type="button" name="Activity" class="btn btn-success Activity" value="User Activity"> &nbsp &nbsp';    
echo '<input type="button" name="Draft" class="btn btn-success Draft" value="Draft"> &nbsp &nbsp';
echo '<input type="button" name="MyTeam" class="btn btn-success MyTeam" value="My Team"> &nbsp &nbsp';
echo "<br>";



?>
    <script type="text/javascript">
    Round = "<?php echo $Round; ?>";
    DraftYear = "<?php echo $DraftYear; ?>";
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

    $(".Draft").on('click', function(){			
        {
            $("#Drafting").show();
            $.post("DraftingChart.php", {LeagueId:LeagueId, Pos:Pos, Sort:Sort, DraftYear:DraftYear, Round:Round, TeamId:TeamId}, function(data){
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

