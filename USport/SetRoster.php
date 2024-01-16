<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
    $team =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId'"));
    $TeamId = $team['TeamId'];
    $Starters =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId' AND TeamId = '$TeamId'"));

    $teamMembers = [$team['Slot1'], $team['Slot2'], $team['Slot3'], $team['Slot4'], $team['Slot5'], $team['Slot6'], $team['Slot7'], $team['Slot8'], $team['Slot9'], $team['Slot10']];
    $StarterId =[$Starters['Qb'],$Starters['Rb'],$Starters['Wr1'],$Starters['Wr2'],$Starters['K'],$Starters['Flex']];

    $rosterId=[];
    $rosterName=[];
    $rosterPos=[];
    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Player</th>
        <th>Position</th>
        <th>Team</th>
        <th>Role</th>
        <?php
    echo '</tr><tbody>';
    $count = count($teamMembers);
    while($count>0)
    {
        echo '<tr>';
        $PId = $teamMembers['0'];
        If($PId == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $PAll = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$PId'"));
            $Role = "Bench";
            if (array_search($PId, $StarterId) !== FALSE ) {
                $Role = "Starter";
            }
            $N = $PAll['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$PAll['Pos'].'</td>';
            echo '<td>'.$PAll['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$PId);
            array_push($rosterName,$PAll['Name']);
            array_push($rosterPos,$PAll['Pos']);
        }
        $teamMembers = array_diff($teamMembers, array($PId));
        $teamMembers = array_values($teamMembers);
        $count = count($teamMembers);
        echo '</tr>';
    }        


    echo '</tbody></table>';

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Postion</th>
        <th>Name</th>
        <?php
    echo '</tr><tbody>';

    $j = 0;
    while($j<6)
    {
        if($j==0){$Pos = "Qb";}
        else if($j==1){$Pos = "Rb";}
        else if($j==2){$Pos = "Wr1";}
        else if($j==3){$Pos = "Wr2";}
        else if($j==4){$Pos = "K";}
        else if($j==5){$Pos = "Flex";}

        echo '<tr>';
        echo '<td>'.$Pos.'</td>';
        echo '<td class = "select"> 
        <select id="'.$Pos.'">';
        $rosterId =array_filter($rosterId);
        for ($i = 0; $i < count($rosterId); $i++) {        
            $N = $rosterName[$i];
            $P = $rosterPos[$i];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            if($rosterId[$i] == $StarterId[$j])
            {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].','.$LeagueId.','.$TeamId.'" selected="selected">'.$P.' '.$Name.'</option>';    }
            else {    echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].','.$LeagueId.','.$TeamId.'">'.$P.' '.$Name.'</option>';  }
        }
        echo '</select>';
        echo '</tr>';
        $j++;
    }


    echo '</tbody></table>';

    if(6 > count($rosterId))
    {
        echo "You cannot set a roster with less than 6 players";
    }
    else 
    {
        echo '<br><input type="button" name="Submit" id="'.$LeagueId.'" class="btn btn-success Submit" value="Submit Starters"> &nbsp';
    }

?>

<script type="text/javascript">
    $(document).ready(function(){

        $(".Submit").on('click', function(){
            var e = document.getElementById("Qb");
            var Qb = e.value;
            var split = Qb.split(",");
            var QbPos = split[0];
            var QbId = split[1];
            var LeagueId= split[2];
            var TeamId= split[3];

            var e = document.getElementById("Rb");
            var Rb = e.value;
            var split = Rb.split(",");
            var RbPos = split[0];
            var RbId = split[1];

            var e = document.getElementById("Wr1");
            var Wr1 = e.value;
            var split = Wr1.split(",");
            var Wr1Pos = split[0];
            var Wr1Id = split[1];

            var e = document.getElementById("Wr2");
            var Wr2 = e.value;
            var split = Wr2.split(",");
            var Wr2Pos = split[0];
            var Wr2Id = split[1];

            var e = document.getElementById("K");
            var K = e.value;
            var split = K.split(",");
            var KPos = split[0];
            var KId = split[1];

            var e = document.getElementById("Flex");
            var Flex = e.value;
            var split = Flex.split(",");
            var FlexPos = split[0];
            var FlexId = split[1];

            $.post("SetRosterActions.php", {
                QbPos:QbPos,
                QbId:QbId,
                RbPos:RbPos,
                RbId:RbId,
                Wr1Pos:Wr1Pos,
                Wr1Id:Wr1Id,
                Wr2Pos:Wr2Pos,
                Wr2Id:Wr2Id,
                KPos:KPos,
                KId:KId,
                FlexPos:FlexPos,
                FlexId:FlexId,
                LeagueId:LeagueId,
                TeamId:TeamId
            }, function(data){
                $("#TeamInner").html(data);
            });	
        });

    });

</script>
