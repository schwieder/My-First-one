<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$TeamId = $_POST['TeamId'];
    $Week =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantweek"));
    $row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantschedule WHERE TeamId = '$TeamId'"));
    
    if($row['Week1Opp']=="NULL"){
        echo "Schedule will be set after the draft";
        die;
    }

    echo "<br>";
    echo '<input type="button" name="Schedule" class="btn btn-success Schedule" value="My Schedule"> &nbsp';
    echo '<input type="button" name="Week1" class="btn btn-success Week1" value="Week 1"> &nbsp';
    echo '<input type="button" name="Week2" class="btn btn-success Week2" value="Week 2"> &nbsp';
    echo '<input type="button" name="Week3" class="btn btn-success Week3" value="Week 3"> &nbsp';
    echo '<input type="button" name="Week4" class="btn btn-success Week4" value="Week 4"> &nbsp';
    echo '<input type="button" name="Week5" class="btn btn-success Week5" value="Week 5"> &nbsp';
    echo '<input type="button" name="Week6" class="btn btn-success Week6" value="Week 6"> &nbsp';

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Week</th>
        <th>Vs</th>
        <th>Result</th>
        <?php
    echo '</tr><tbody>';

    $Team = $row['TeamId'];
    $a = 1;
    while($a<7)
    {
        $W = "Week$a";
        $O = "Opp";
        $Opponent = "$W$O";

        $Opp = $row[$Opponent];
        if($Opp != 'bye'){$OppName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$Opp'"));}else{$OppName="bye";}
        if($Week != $a && $Opp != 'bye'){$OppScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$Opp' && Week = '$a'"));}
        else if($Opp != 'bye'){
            $TInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' && TeamId = '$Opp'"));
    
            $Qb = $TInfo['Qb'];
            $Rb = $TInfo['Rb'];
            $Wr1 = $TInfo['Wr1'];
            $Wr2 = $TInfo['Wr2'];
            $K = $TInfo['K'];
            $Flex = $TInfo['Flex'];

            $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
            $OppScore = 0;
            $b = 1;
            $Pos = 0;
            While($b<7)
            {
                if($b==1){$Pos=$Qb;}
                else if($b==2){$Pos=$Rb;}
                else if($b==3){$Pos=$Wr1;}
                else if($b==4){$Pos=$Wr2;}
                else if($b==5){$Pos=$K;}
                else if($b==6){$Pos=$Flex;}
                $Stats =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Pos"));
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$$Pos' && Week='$Week'"));
                if($sql != 0){
                    $OpTotalPoints = 
                    (($Points['PassYds'] * ($Stats['PassYds'])/25))+
                    (($Points['PassTds']  * $Stats['PassTds']))+
                    (($Points['PassInts'] * $Stats['Ints']))+
                    (($Points['RushYds']  * ($Stats['RushYds'])/10))+
                    (($Points['RushTds']  * $Stats['RushTds']))+
                    (($Points['RecYds']   * ($Stats['RecYds']/10)))+
                    (($Points['RecTds']   * $Stats['RecTds']))+
                    (($Points['KORYds']   * ($Stats['KORYds']/10)))+
                    (($Points['KORTds']   * $Stats['KORTds']))+
                    (($Points['PRYds']    * ($Stats['PRYds']/10)))+
                    (($Points['PRTds']    * $Stats['PRTds']))+
                    (($Points['Fum']      * $Stats['Fumbles']))+
                    (($Points['FumLost']  * $Stats['FumblesLost']))+
                    ($Stats['KickPts']);
                }
                else{$OpTotalPoints = '0';}
                $OppScore = $OppScore + $OpTotalPoints;
                $b++;
            }
        }else{$OppScore="0";}

        if($Week != $a && $Opp != 'bye'){ $HomeScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$TeamId' && Week = '$a'"));}
        else if($Opp != 'bye')
        {
            $TInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' && TeamId = '$TeamId'"));

            $Qb = $TInfo['Qb'];
            $Rb = $TInfo['Rb'];
            $Wr1 = $TInfo['Wr1'];
            $Wr2 = $TInfo['Wr2'];
            $K = $TInfo['K'];
            $Flex = $TInfo['Flex'];
    
            $HomeScore = 0;
            $c = 1;
            $Pos = 0;
            While($c<7)
            {
                if($c==1){$Pos=$Qb;}
                else if($c==2){$Pos=$Rb;}
                else if($c==3){$Pos=$Wr1;}
                else if($c==4){$Pos=$Wr2;}
                else if($c==5){$Pos=$K;}
                else if($c==6){$Pos=$Flex;}
                $Stats =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Pos"));
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$$Pos' && Week='$Week'"));

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Pos' && Week='$Week'"));
                if($sql != 0)
                {
                    $HomeTotalPoints = 
                    (($Points['PassYds'] * ($Stats['PassYds'])/25))+
                    (($Points['PassTds']  * $Stats['PassTds']))+
                    (($Points['PassInts'] * $Stats['Ints']))+
                    (($Points['RushYds']  * ($Stats['RushYds'])/10))+
                    (($Points['RushTds']  * $Stats['RushTds']))+
                    (($Points['RecYds']   * ($Stats['RecYds']/10)))+
                    (($Points['RecTds']   * $Stats['RecTds']))+
                    (($Points['KORYds']   * ($Stats['KORYds']/10)))+
                    (($Points['KORTds']   * $Stats['KORTds']))+
                    (($Points['PRYds']    * ($Stats['PRYds']/10)))+
                    (($Points['PRTds']    * $Stats['PRTds']))+
                    (($Points['Fum']      * $Stats['Fumbles']))+
                    (($Points['FumLost']  * $Stats['FumblesLost']))+
                    ($Stats['KickPts']);
                }
                 else{$HomeTotalPoints = '0';}
                $HomeScore = $HomeScore + $HomeTotalPoints;
                $c++;
            }
        }else{$HomeScore="0";}

        $result = $HomeScore." - ".$OppScore;

        echo '<tr>';
        echo '<td>'.$a.'</td>';
        echo '<td>'.$OppName.'</td>';
        echo '<td> '.$result.' </td>';
        echo '</tr>';
    

        $a++;

    }

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
    $(".Week1").on('click', function(){			
        {
            var Week = "1";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week2").on('click', function(){			
        {
            var Week = "2";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week3").on('click', function(){			
        {
            var Week = "3";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week4").on('click', function(){			
        {
            var Week = "4";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week5").on('click', function(){			
        {
            var Week = "5";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week6").on('click', function(){			
        {
            var Week = "6";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
</script>
