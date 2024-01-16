<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$OppId = $_POST['OppId'];
	$TeamId = $_POST['TeamId'];
    
    $Starters =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' AND TeamId = '$OppId'"));
    $OppName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$OppId'"));

    echo '<input type="button" name="Schedule" class="btn btn-success Schedule" value="Back"> &nbsp';
    echo "<br>";
    echo "<br>";
    echo "$OppName's Current Starters";
    echo "<br>";

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Position</th>
        <th>Player</th>
        <th>Team</th>
        <?php
    echo '</tr><tbody>';



    $Qb = $Starters['Qb'];
    $Rb = $Starters['Rb'];
    $Wr1 = $Starters['Wr1'];
    $Wr2 = $Starters['Wr2'];
    $K = $Starters['K'];
    $Flex = $Starters['Flex'];


    $b = 1;
    $Pos = 0;
    While($b<7)
    {
        if($b==1){$Pos=$Qb; $P="Qb";}
        else if($b==2){$Pos=$Rb; $P="Rb";}
        else if($b==3){$Pos=$Wr1; $P="Wr1";}
        else if($b==4){$Pos=$Wr2; $P="Wr2";}
        else if($b==5){$Pos=$K; $P="K";}
        else if($b==6){$Pos=$Flex; $P="Flex";}


        echo '<tr>';
        If($Pos != 0){
            $Stats =  ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = $Pos"));
            $N = $Stats['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$P.'</td>';
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$Stats['Team'].'</td>';
        }
        else{
            echo '<td>'.$P.'</td>';
            echo '<td>Not Set</td>';
            echo '<td>Not Set</td>';
        }
        echo '</tr>';
        $b++;
    }
    echo '</tr></tbody></table>';

?>
<script type="text/javascript">
    LeagueId = "<?php echo $LeagueId; ?>";
    TeamId = "<?php echo $TeamId; ?>";
    $(".Schedule").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("Schedule.php", {LeagueId:LeagueId, TeamId:TeamId}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
</script>
