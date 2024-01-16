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

    if(isset($Starters['QB']))
    {
        $StarterId =[$Starters['Qb'],$Starters['Rb'],$Starters['Wr1'],$Starters['Wr2'],$Starters['Flex']];
    }
    else
    {
        $StarterId =[];
    }
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
    echo '<tr>';
        $P1Id = $team['Slot1'];
        If($P1Id == NULL){
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
            $P1 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P1Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P1Id){$Role = "Starter";}
            }
            echo '<td>'.$P1['Name'].'</td>';
            echo '<td>'.$P1['Pos'].'</td>';
            echo '<td>'.$P1['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P1Id);
            array_push($rosterName,$P1['Name']);
            array_push($rosterPos,$P1['Pos']);
            

        }
    echo '</tr>';

    echo '<tr>';
        $P2Id = $team['Slot2'];
        If($P2Id == NULL){
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
            $P2 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P2Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P2Id){$Role = "Starter";}
            }
            echo '<td>'.$P2['Name'].'</td>';
            echo '<td>'.$P2['Pos'].'</td>';
            echo '<td>'.$P2['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P2Id);
            array_push($rosterName,$P2['Name']);
            array_push($rosterPos,$P2['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P3Id = $team['Slot3'];
        If($P3Id == NULL){
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
            $P3 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P3Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P3Id){$Role = "Starter";}
            }
            echo '<td>'.$P3['Name'].'</td>';
            echo '<td>'.$P3['Pos'].'</td>';
            echo '<td>'.$P3['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P3Id);
            array_push($rosterName,$P3['Name']);
            array_push($rosterPos,$P3['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P4Id = $team['Slot4'];
        If($P4Id == NULL){
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
            $P4 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P4Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P4Id){$Role = "Starter";}
            }
            echo '<td>'.$P4['Name'].'</td>';
            echo '<td>'.$P4['Pos'].'</td>';
            echo '<td>'.$P4['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P4Id);
            array_push($rosterName,$P4['Name']);
            array_push($rosterPos,$P4['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P5Id = $team['Slot5'];
        If($P5Id == NULL){
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
            $P5 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P5Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P5Id){$Role = "Starter";}
            }
            echo '<td>'.$P5['Name'].'</td>';
            echo '<td>'.$P5['Pos'].'</td>';
            echo '<td>'.$P5['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P5Id);
            array_push($rosterName,$P5['Name']);
            array_push($rosterPos,$P5['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P6Id = $team['Slot6'];
        If($P6Id == NULL){
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
            $P6 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P6Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P6Id){$Role = "Starter";}
            }
            echo '<td>'.$P6['Name'].'</td>';
            echo '<td>'.$P6['Pos'].'</td>';
            echo '<td>'.$P6['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P6Id);
            array_push($rosterName,$P6['Name']);
            array_push($rosterPos,$P6['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P7Id = $team['Slot7'];
        If($P7Id == NULL){
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
            $P7 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P7Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P7Id){$Role = "Starter";}
            }
            echo '<td>'.$P7['Name'].'</td>';
            echo '<td>'.$P7['Pos'].'</td>';
            echo '<td>'.$P7['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P7Id);
            array_push($rosterName,$P7['Name']);
            array_push($rosterPos,$P7['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P8Id = $team['Slot8'];
        If($P8Id == NULL){
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
            $P8 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P8Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P8Id){$Role = "Starter";}
            }
            echo '<td>'.$P8['Name'].'</td>';
            echo '<td>'.$P8['Pos'].'</td>';
            echo '<td>'.$P8['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P8Id);
            array_push($rosterName,$P8['Name']);
            array_push($rosterPos,$P8['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P9Id = $team['Slot9'];
        If($P9Id == NULL){
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
            $P9 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P9Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P9Id){$Role = "Starter";}
            }
            echo '<td>'.$P9['Name'].'</td>';
            echo '<td>'.$P9['Pos'].'</td>';
            echo '<td>'.$P9['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P9Id);
            array_push($rosterName,$P9['Name']);
            array_push($rosterPos,$P9['Pos']);
        }
    echo '</tr>';

    echo '<tr>';
        $P10Id = $team['Slot10'];
        If($P10Id == NULL){
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
            $P10 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P10Id'"));
            $Role = "Bench";
            foreach ($StarterId as $value) {
                if($value == $P10Id){$Role = "Starter";}
            }
            echo '<td>'.$P10['Name'].'</td>';
            echo '<td>'.$P10['Pos'].'</td>';
            echo '<td>'.$P10['Team'].'</td>';
            echo '<td>'.$Role.'</td>';
            array_push($rosterId,$P10Id);
            array_push($rosterName,$P10['Name']);
            array_push($rosterPos,$P10['Pos']);
        }
    echo '</tr></tbody></table>';

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Postion</th>
        <th>Name</th>
        <?php
    echo '</tr><tbody>';
    echo '<tr>';
    echo '<td>QB</td>';
    echo '<td class = "select"> 
    <select id="Qb">';
    $rosterId =array_filter($rosterId);
    for ($i = 0; $i < count($rosterId); $i++) {        
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['Qb'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].','.$LeagueId.','.$TeamId.'" selected="selected">'.$P.' '.$Name.'</option>';    }
        else {    echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].','.$LeagueId.','.$TeamId.'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td>RB</td>';
    echo '<td class = "select"> 
    <select id="Rb">';
    for ($i = 0; $i < count($rosterId); $i++) {
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['Rb'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'" selected="selected">'.$P.' '.$Name.'</option>';  }
        else {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>WR1</td>';
    echo '<td class = "select"> 
    <select id="Wr1">';
    for ($i = 0; $i < count($rosterId); $i++) {
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['Wr1'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'" selected="selected">'.$P.' '.$Name.'</option>';  }
        else {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>WR2</td>';
    echo '<td class = "select"> 
    <select id="Wr2">';
    for ($i = 0; $i < count($rosterId); $i++) {
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['Wr2'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'" selected="selected">'.$P.' '.$Name.'</option>';  }
        else {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>K</td>';
    echo '<td class = "select"> 
    <select id="K">';
    for ($i = 0; $i < count($rosterId); $i++) {
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['K'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'" selected="selected">'.$P.' '.$Name.'</option>';  }
        else {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Flex (Not a QB)</td>';
    echo '<td class = "select"> 
    <select id="Flex">';
    for ($i = 0; $i < count($rosterId); $i++) {
        $N = $rosterName[$i];
        $P = $rosterPos[$i];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
        if($rosterId[$i] == $Starters['Flex'])
        {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'" selected="selected">'.$P.' '.$Name.'</option>';  }
        else {   echo '<option value="'.$rosterPos[$i].','.$rosterId[$i].'">'.$P.' '.$Name.'</option>';  }
    }
    echo '</select>';
    echo '</tr>';
    echo '</tr></tbody></table>';

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
