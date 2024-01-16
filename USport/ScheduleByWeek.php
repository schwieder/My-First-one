<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$TeamId = $_POST['TeamId'];
    $CurrWeek =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantweek"));
    $Week = $_POST['Week'];
    if($Week == "7"){
        $W = "PlayoffWk1Opp";
    }
    else if($Week=="8"){
        $W = "PlayoffWk2Opp";
    }
    else{
        $W = "Week".$Week."Opp";
    }
    $count = 0;
    $Teams = [];
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT TeamId FROM fantteams WHERE LeagueId = $LeagueId")) as $row)
    {
        array_push($Teams,$row);
    }


    echo "<br>";
    echo '<input type="button" name="Schedule" class="btn btn-success Schedule" value="My Schedule"> &nbsp';
    echo '<input type="button" name="Week1" class="btn btn-success Week1" value="Week 1"> &nbsp';
    echo '<input type="button" name="Week2" class="btn btn-success Week2" value="Week 2"> &nbsp';
    echo '<input type="button" name="Week3" class="btn btn-success Week3" value="Week 3"> &nbsp';
    echo '<input type="button" name="Week4" class="btn btn-success Week4" value="Week 4"> &nbsp';
    echo '<input type="button" name="Week5" class="btn btn-success Week5" value="Week 5"> &nbsp';
    echo '<input type="button" name="Week6" class="btn btn-success Week6" value="Week 6"> &nbsp';
    if($CurrWeek > "6")
    {
        echo '<input type="button" name="Week7" class="btn btn-success Week7" value="Playoff wk 1"> &nbsp';
    }
    if($CurrWeek > "7")
    {
        echo '<input type="button" name="Week8" class="btn btn-success Week8" value="Finals"> &nbsp';
    }
    
    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Week</th>
        <th>Home</th>
        <th>Away</th>
        <th>Result</th>
        <?php
    echo '</tr><tbody>';

    $Amount = count($Teams);
    while($Amount>0)
    {
        $Home = $Teams[0];
        $Opp =  ReadScalar(ExecuteSqlQuery("SELECT $W FROM fantschedule WHERE TeamId = '$Home'"));
        $HomeName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$Home'"));
        if($CurrWeek != $Week)
        {

            $HomeScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$Home' && Week = $Week"));
            if($Opp != 'bye')
            {
                $Team1 = $Opp;
                $Team2 = $Home;
                $OppName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$Opp'"));
                $OppScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$Opp' && Week = $Week"));
            }
            else{
                $OppName = $Opp;
                $OppScore="0";
                $Team1 = '0';
                $Team2 = $Home;
            }
        }
        else{
            if($Opp == NULL){
                $OppName = "No Game";
                $OppScore="0";
                $Team1 = '0';
                $Team2 = $Home;
            }
            else if($Opp != 'bye'){
                $TInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' && TeamId = '$Opp'"));
                $OppName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$Opp'"));
        
                $Team = $TInfo['TeamId'];
                $Team1 = $TInfo['TeamId'];
                $Qb = $TInfo['Qb'];
                $Rb = $TInfo['Rb'];
                $Wr1 = $TInfo['Wr1'];
                $Wr2 = $TInfo['Wr2'];
                $K = $TInfo['K'];
                $Flex = $TInfo['Flex'];

                $Stats1 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Qb"));
                $Stats2 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Rb"));
                $Stats3 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Wr1"));
                $Stats4 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Wr2"));
                $Stats5 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $K"));
                $Stats6 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Flex"));
        
        
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
            }else{$OppScore="0"; $Team1 = '0';}

            if($Home != 'bye'){
                $TInfo =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' && TeamId = '$Home'"));
        
                $Team = $TInfo['TeamId'];
                $Team2 = $TInfo['TeamId'];
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
            }else{$HomeScore="0"; $Team2 = '0';}
    
        } 

        $result = $HomeScore." - ".$OppScore;

        echo '<tr>';
        echo '<td>'.$Week.'</td>';
        echo '<td>'.$HomeName.'</td>';
        echo '<td>'.$OppName.'</td>';
        echo '<td>'.$result.'</td>';
        echo '</tr>';
     
        if($Team1 != 0)
        {
            $Teams = array_diff($Teams, array($Team1));
        }
        if($Team2 != 0)
        {
            $Teams = array_diff($Teams, array($Team2));
        }


        $Teams = array_values($Teams);

        $Amount = count($Teams);
        echo "<br>";

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
    $(".Week7").on('click', function(){			
        {
            var Week = "7";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
    $(".Week8").on('click', function(){			
        {
            var Week = "8";
            $("#TeamInner").show();
            $.post("ScheduleByWeek.php", {LeagueId:LeagueId, TeamId:TeamId, Week:Week}, function(data){
                $("#TeamInner").html(data);
            });
        }
    });
</script>
