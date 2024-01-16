<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$TeamId = $_POST['TeamId'];

    $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM fanttrades WHERE Team2='$TeamId' && Approved ='P'"));
    $sql2 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM fanttrades WHERE Team1='$TeamId' && Approved ='P'"));
    if($sql == 0 && $sql2 == 0)
    {
        echo "There are no trades incoming at the moment";
        die;
    }

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 800px;"><tr></tr>
    <tr>';
        ?>
        <th>From</th>
        <th>To</th>
        <th>Players sent to you</th>
        <th>Players they would get</th>
        <th>Messages</th>
        <th>Approve</th>
        <th>Decline</th>
        <?php
    echo '</tr><tbody>';

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fanttrades WHERE Team1 = '$TeamId' && Approved = 'P'")) as $row)
    {
        $T1Id = $row['Team1'];
        $T2Id = $row['Team2'];
        $P1Id = $row['Send1'];
        $P2Id = $row['Send2'];
        $P3Id = $row['Send3'];
        $TP1Id = $row['Get1'];
        $TP2Id = $row['Get2'];
        $TP3Id = $row['Get3'];
        if($P1Id!=0){$P1Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P1Id';"));}else{$P1Name = "";}
        if($P2Id!=0){$P2Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P2Id';"));}else{$P2Name = "";}
        if($P3Id!=0){$P3Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P3Id';"));}else{$P3Name = "";}
        if($TP1Id!=0){$TP1Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP1Id';"));}else{$TP1Name = "";}
        if($TP2Id!=0){$TP2Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP2Id';"));}else{$TP2Name = "";}
        if($TP3Id!=0){$TP3Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP3Id';"));}else{$TP3Name = "";}
        $N1 = $P1Name;
        $Name1 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N1);
        $N2 = $P2Name;
        $Name2 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N2);
        $N3 = $P3Name;
        $Name3 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N3);
        $TN1 = $TP1Name;
        $TName1 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN1);
        $TN2 = $TP2Name;
        $TName2 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN2);
        $TN3 = $TP3Name;
        $TName3 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN3);

        echo '<tr>';
        $TeamName = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$T1Id';"));
        $TeamName2 = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$T2Id';"));
        echo '<td>'.$TeamName.'</td>';
        echo '<td>'.$TeamName2.'</td>';
        echo '<td>'.$Name1.'<br>'.$Name2.'<br>'.$Name3.'</td>';
        echo '<td>'.$TName1.'<br>'.$TName2.'<br>'.$TName3.'</td>';
        echo '<td>'.$row['Messages'].'</td>';
        if($row['Approved'] == 'N')
        {
            echo '<td>Trade</td>';
            echo '<td>Declined</td>';
        }
        else
        {
            echo '<td>Pending</td>';
            echo '<td><input type="button" id="'.$row['Id'].'" align="right" style="height:20px;width:70px;" class="btn btn-success Decline" value="Decline"></td>';
            }
        echo '</tr>';

    }
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fanttrades WHERE Team2 = '$TeamId' && Approved = 'P'")) as $row)
    {
        $T1Id = $row['Team1'];
        $T2Id = $row['Team2'];
        $P1Id = $row['Send1'];
        $P2Id = $row['Send2'];
        $P3Id = $row['Send3'];
        $TP1Id = $row['Get1'];
        $TP2Id = $row['Get2'];
        $TP3Id = $row['Get3'];
        if($P1Id!=0){$P1Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P1Id';"));}else{$P1Name = "";}
        if($P2Id!=0){$P2Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P2Id';"));}else{$P2Name = "";}
        if($P3Id!=0){$P3Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$P3Id';"));}else{$P3Name = "";}
        if($TP1Id!=0){$TP1Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP1Id';"));}else{$TP1Name = "";}
        if($TP2Id!=0){$TP2Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP2Id';"));}else{$TP2Name = "";}
        if($TP3Id!=0){$TP3Name = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$TP3Id';"));}else{$TP3Name = "";}
        $N1 = $P1Name;
        $Name1 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N1);
        $N2 = $P2Name;
        $Name2 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N2);
        $N3 = $P3Name;
        $Name3 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N3);
        $TN1 = $TP1Name;
        $TName1 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN1);
        $TN2 = $TP2Name;
        $TName2 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN2);
        $TN3 = $TP3Name;
        $TName3 = preg_replace('/(?<!\ )[A-Z]/', ' $0', $TN1);

        echo '<tr>';
        $Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$T1Id';"));
        $Name2 = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId = '$T2Id';"));
        echo '<td>'.$Name.'</td>';
        echo '<td>'.$Name2.'</td>';
        echo '<td>'.$N1.'<br>'.$N2.'<br>'.$N3.'</td>';
        echo '<td>'.$TN1.'<br>'.$TN2.'<br>'.$TN3.'</td>';
        echo '<td>'.$row['Messages'].'</td>';
        if($row['Approved'] == 'N')
        {
            echo '<td>Trade</td>';
            echo '<td>Declined</td>';
        }
        else
        {
            echo '<td><input type="button" id="'.$row['Id'].'" align="right" style="height:20px;width:70px;" class="btn btn-success Approve" value="Approve"></td>';
            echo '<td><input type="button" id="'.$row['Id'].'" align="right" style="height:20px;width:70px;" class="btn btn-success Decline" value="Decline"></td>';
        }
        echo '</tr>';

    }

    ?>
    <script type="text/javascript">
        LeagueId = "<?php echo $LeagueId; ?>";
        TeamId = "<?php echo $TeamId; ?>";
        
        $(".Approve").on('click', function(){			
            {
                var TradeId = $(this).attr('id');
                var result = "Approve";
                $.post("IncomingTradeYayOrNay.php", {LeagueId:LeagueId, TeamId:TeamId, TradeId:TradeId, result:result}, function(data){
                    $("#TeamInner").html(data);
                });
            }
        });
        $(".Decline").on('click', function(){			
            {
                var TradeId = $(this).attr('id');
                var result = "Decline";
                $.post("IncomingTradeYayOrNay.php", {LeagueId:LeagueId, TeamId:TeamId, TradeId:TradeId, result:result}, function(data){
                    $("#TeamInner").html(data);
                });
            }
        });
    
    </script>
    
