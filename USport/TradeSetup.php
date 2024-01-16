<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
	$TeamId = $_POST['TeamId'];
	$TradeTeamId = $_POST['TradeTeamId'];
    $TradePlayerId=[];
    $TradePlayerName=[];
    $PlayerId=[];
    $PlayerName=[];

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId' && TeamId = '$TeamId'")) as $row)
    {
        array_push($PlayerId,$row['PlayerId']);
        $PId = $row['PlayerId'];
        $Name =  ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$PId'"));
        array_push($PlayerName,$Name);
    }
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId' && TeamId = '$TradeTeamId'")) as $row)
    {
        array_push($TradePlayerId,$row['PlayerId']);
        $PId = $row['PlayerId'];
        $Name =  ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$PId'"));
        array_push($TradePlayerName,$Name);
    }

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>#</th>
        <th>Player getting</th>
        <th>Player Given</th>
        <?php
    echo '</tr><tbody>';
    echo '<tr>';
    echo '<td>1</td>';
    echo '<td class = "select"> 
    <select id="TradeTeam1">';
    echo '<option value="0,'.$LeagueId.','.$TradeTeamId.'">No Player Chosen</option>';
    $TradePlayerId = array_filter($TradePlayerId);
    for ($i = 0; $i < count($TradePlayerId); $i++) {        
        $N = $TradePlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$TradePlayerId[$i].','.$LeagueId.','.$TradeTeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';

    echo '<td class = "select"> 
    <select id="Team1">';
    echo '<option value="0,'.$LeagueId.','.$TeamId.'">No Player Chosen</option>';
    $PlayerId = array_filter($PlayerId);
    for ($i = 0; $i < count($PlayerId); $i++) {        
        $N = $PlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$PlayerId[$i].','.$LeagueId.','.$TeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>2</td>';
    echo '<td class = "select"> 
    <select id="TT2">';
    echo '<option value="0,'.$LeagueId.','.$TradeTeamId.'">No Player Chosen</option>';
    $TradePlayerId = array_filter($TradePlayerId);
    for ($i = 0; $i < count($TradePlayerId); $i++) {        
        $N = $TradePlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$TradePlayerId[$i].','.$LeagueId.','.$TradeTeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';

    echo '<td class = "select"> 
    <select id="T2">';
    echo '<option value="0,'.$LeagueId.','.$TeamId.'">No Player Chosen</option>';
    $PlayerId = array_filter($PlayerId);
    for ($i = 0; $i < count($PlayerId); $i++) {        
        $N = $PlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$PlayerId[$i].','.$LeagueId.','.$TeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>3</td>';
    echo '<td class = "select"> 
    <select id="TT3">';
    echo '<option value="0,'.$LeagueId.','.$TradeTeamId.'">No Player Chosen</option>';
    $TradePlayerId = array_filter($TradePlayerId);
    for ($i = 0; $i < count($TradePlayerId); $i++) {        
        $N = $TradePlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$TradePlayerId[$i].','.$LeagueId.','.$TradeTeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';

    echo '<td class = "select"> 
    <select id="T3">';
    echo '<option value="0,'.$LeagueId.','.$TeamId.'">No Player Chosen</option>';
    $PlayerId = array_filter($PlayerId);
    for ($i = 0; $i < count($PlayerId); $i++) {        
        $N = $PlayerName[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        echo '<option value="'.$PlayerId[$i].','.$LeagueId.','.$TeamId.'">'.$Name.'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';

    echo '</tr></tbody></table>';

    echo '<br><textarea id="Text1" cols="40" rows="5" placeholder="Would you like to send a message?"></textarea><br>';

    echo '<br><input type="button" name="Submit" id="'.$LeagueId.'" class="btn btn-success Submit" value="Submit Trade"> &nbsp';

?>

<script type="text/javascript">
    $(document).ready(function(){

        $(".Submit").on('click', function(){
            var e = document.getElementById("Team1");
            var Team1 = e.value;
            var split = Team1.split(",");
            var Player1Id = split[0];
            var LeagueId= split[1];
            var TeamId= split[2];

            var e = document.getElementById("TradeTeam1");
            var Trade1 = e.value;
            var split = Trade1.split(",");
            var TradePlayer1Id = split[0];
            var LeagueId= split[1];
            var TradeTeamId= split[2];

            var e = document.getElementById("T2");
            var Team2 = e.value;
            var split = Team2.split(",");
            var Player2Id = split[0];
            var LeagueId= split[1];
            var TeamId= split[2];

            var e = document.getElementById("TT2");
            var Trade2 = e.value;
            var split = Trade2.split(",");
            var TradePlayer2Id = split[0];
            var LeagueId= split[1];
            var TradeTeamId= split[2];

            var e = document.getElementById("T3");
            var Team3 = e.value;
            var split = Team3.split(",");
            var Player3Id = split[0];
            var LeagueId= split[1];
            var TeamId= split[2];

            var e = document.getElementById("TT3");
            var Trade3 = e.value;
            var split = Trade3.split(",");
            var TradePlayer3Id = split[0];
            var LeagueId= split[1];
            var TradeTeamId= split[2];

            var text = document.getElementById("Text1");
            msg = text.value;

            $.post("TradeSendToIncoming.php", {
                Player1Id:Player1Id,
                TradePlayer1Id:TradePlayer1Id,
                Player2Id:Player2Id,
                TradePlayer2Id:TradePlayer2Id,
                Player3Id:Player3Id,
                TradePlayer3Id:TradePlayer3Id,
                LeagueId:LeagueId,
                TeamId:TeamId,
                TradeTeamId:TradeTeamId,
                msg:msg
            }, function(data){
                $("#TeamInner").html(data);
            });	
        });

    });

</script>
