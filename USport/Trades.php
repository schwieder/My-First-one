<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$TeamId = $_POST['TeamId'];
    echo "Trade with: ";
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId'")) as $row)
    {
        $TradeTeamId = $row['TeamId'];
        $TradeTeamName = $row['TeamName'];
        if($TradeTeamId != $TeamId){echo '<input type="button" name="Trade" id="'.$TradeTeamId.'" class="btn btn-success Trade" value="'.$TradeTeamName.'"> &nbsp';}
    }

?>
<script type="text/javascript">
    LeagueId = "<?php echo $LeagueId; ?>";
    TeamId = "<?php echo $TeamId; ?>";
    
    $(".Trade").on('click', function(){			
        {
            var TradeTeamId = $(this).attr('id');
            $.post("TradeSetup.php", {LeagueId:LeagueId, TeamId:TeamId, TradeTeamId:TradeTeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});

</script>
