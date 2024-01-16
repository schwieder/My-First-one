<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
    $team =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId'"));
    $TeamId = $team['TeamId'];

    $rosterId=[];
    $rosterName=[];
    $rosterPos=[];
    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Player</th>
        <th>Position</th>
        <th>Team</th>
        <?php
    echo '</tr><tbody>';
    echo '<tr>';
        $P1Id = $team['Slot1'];
        If($P1Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P1 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P1Id'"));
            $N = $P1['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P1['Pos'].'</td>';
            echo '<td>'.$P1['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P2 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P2Id'"));
            $N = $P2['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P2['Pos'].'</td>';
            echo '<td>'.$P2['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P3 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P3Id'"));
            $N = $P3['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P3['Pos'].'</td>';
            echo '<td>'.$P3['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P4 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P4Id'"));
            $N = $P4['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P4['Pos'].'</td>';
            echo '<td>'.$P4['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P5 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P5Id'"));
            $N = $P5['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P5['Pos'].'</td>';
            echo '<td>'.$P5['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P6 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P6Id'"));
            $N = $P6['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P6['Pos'].'</td>';
            echo '<td>'.$P6['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P7 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P7Id'"));
            $N = $P7['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P7['Pos'].'</td>';
            echo '<td>'.$P7['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P8 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P8Id'"));
            $N = $P8['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P8['Pos'].'</td>';
            echo '<td>'.$P8['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P9 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P9Id'"));
            $N = $P9['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P9['Pos'].'</td>';
            echo '<td>'.$P9['Team'].'</td>';
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
            array_push($rosterId,'0');
            array_push($rosterName,'0');
            array_push($rosterPos,'0');
        }
        else
        {
            $P10 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P10Id'"));
            $N = $P10['Name'];
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo '<td>'.$Name.'</td>';
            echo '<td>'.$P10['Pos'].'</td>';
            echo '<td>'.$P10['Team'].'</td>';
            array_push($rosterId,$P10Id);
            array_push($rosterName,$P10['Name']);
            array_push($rosterPos,$P10['Pos']);
        }
    echo '</tr></tbody></table>';


?>
