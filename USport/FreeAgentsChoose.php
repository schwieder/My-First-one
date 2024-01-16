<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LId'];
	$PId = $_POST['PId'];
    //    Check if draft day has happened or not. If not they can't add anyone
    $draft =  ReadScalar(ExecuteSqlQuery("SELECT Drafted FROM fantleagues WHERE LeagueId = '$LeagueId';"));
    if($draft=="N"){
        echo "The draft hasn't happened yet, so you can't add anyone yet."; 
        die;
    }
/*
    $date=date('w');
    $time=date('h');
    if($date == 0){echo "You can't add people on Sunday's as some teams play on Sunday";die;}
    else if($date == 6){echo "You can't add people on Saturday's";die;}
    else if($date == 5 && $time >= '3'){echo "You can't add people on Friday's after 3pm mt as some teams play on Friday";die;}
*/
    echo "Choose who to drop";

//    Confirm that he's not been chosen in the league
    $taken = [];
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId'")) as $chosen)
    {
        array_push($taken,$chosen['PlayerId']);
    }
    if (in_array($PId, $taken))
    {
        echo "You can't choose that player, he is on another team... please email schwieder@gmail.com and explain to this noob coder how you're cheating so he can fix that hole, become a better coder and make a better USports Fantasy League, Thanks";
        die;
    }

//    Check if there are any extra slots
//    If not then Show their Team and allow them to "drop" a player to add
    $team =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId'"));
    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 700px;"><tr></tr>
    <tr>';
        ?>
        <th>Player</th>
        <th>Position</th>
        <th>Team</th>
        <th>Chosen</th>
        <?php
    echo '</tr><tbody>';
    echo '<tr>';
        $P1Id = $team['Slot1'];
        If($P1Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot1" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P1 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P1Id'"));
            echo '<td>'.$P1['Name'].'</td>';
            echo '<td>'.$P1['Pos'].'</td>';
            echo '<td>'.$P1['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot1" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P1Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P2Id = $team['Slot2'];
        If($P2Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot2" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P2 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P2Id'"));
            echo '<td>'.$P2['Name'].'</td>';
            echo '<td>'.$P2['Pos'].'</td>';
            echo '<td>'.$P2['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot2" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P2Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P3Id = $team['Slot3'];
        If($P3Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot3" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P3 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P3Id'"));
            echo '<td>'.$P3['Name'].'</td>';
            echo '<td>'.$P3['Pos'].'</td>';
            echo '<td>'.$P3['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot3" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P3Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P4Id = $team['Slot4'];
        If($P4Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot4" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P4 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P4Id'"));
            echo '<td>'.$P4['Name'].'</td>';
            echo '<td>'.$P4['Pos'].'</td>';
            echo '<td>'.$P4['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot4" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P4Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P5Id = $team['Slot5'];
        If($P5Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot5" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P5 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P5Id'"));
            echo '<td>'.$P5['Name'].'</td>';
            echo '<td>'.$P5['Pos'].'</td>';
            echo '<td>'.$P5['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot5" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P5Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P6Id = $team['Slot6'];
        If($P6Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot6" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P6 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P6Id'"));
            echo '<td>'.$P6['Name'].'</td>';
            echo '<td>'.$P6['Pos'].'</td>';
            echo '<td>'.$P6['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot6" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P6Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P7Id = $team['Slot7'];
        If($P7Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot7" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P7 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P7Id'"));
            echo '<td>'.$P7['Name'].'</td>';
            echo '<td>'.$P7['Pos'].'</td>';
            echo '<td>'.$P7['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot7" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P7Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P8Id = $team['Slot8'];
        If($P8Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot8" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P8 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P8Id'"));
            echo '<td>'.$P8['Name'].'</td>';
            echo '<td>'.$P8['Pos'].'</td>';
            echo '<td>'.$P8['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot8" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P8Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P9Id = $team['Slot9'];
        If($P9Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot9" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P9 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P9Id'"));
            echo '<td>'.$P9['Name'].'</td>';
            echo '<td>'.$P9['Pos'].'</td>';
            echo '<td>'.$P9['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot9" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P9Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';

    echo '<tr>';
        $P10Id = $team['Slot10'];
        If($P10Id == NULL){
            echo '<td>Empty</td>';
            echo '<td> --- </td>';
            echo '<td> --- </td>';
            echo '<td><input type="button" Slot="Slot10" addPId="'.$PId.'" Lid="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Add" value="Add"></td>';
        }
        else
        {
            $P10 = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId = '$P10Id'"));
            echo '<td>'.$P10['Name'].'</td>';
            echo '<td>'.$P10['Pos'].'</td>';
            echo '<td>'.$P10['Team'].'</td>';
            echo '<td><input type="button" Slot="Slot10" addPId="'.$PId.'" Lid="'.$LeagueId.'" dropPid="'.$P10Id.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drop" value="Drop"></td>';
        }
    echo '</tr>';


?>

<script type="text/javascript">
    $(document).ready(function(){

        $(".Add").on('click', function(){
            var LId = $(this).attr("Lid");
            var Action = "Add";
            var Slot = $(this).attr("Slot");
            var addPId = $(this).attr("addPid");
            $.post("FreeAgentsAddDrop.php", {addPId:addPId, Action: Action, Slot:Slot, LId: LId}, function(data){
                $("#TeamInner").html(data);
            });	
        });

        $(".Drop").on('click', function(){
            var LId = $(this).attr("Lid");
            var dropPId = $(this).attr("dropPid");
            var addPId = $(this).attr("addPid");
            var Action = "Drop";
            var Slot = $(this).attr("Slot");
            $.post("FreeAgentsAddDrop.php", {dropPId: dropPId, addPId:addPId, LId: LId, Action:Action, Slot:Slot}, function(data){
                $("#TeamInner").html(data);
            });	
        });
    });

</script>
