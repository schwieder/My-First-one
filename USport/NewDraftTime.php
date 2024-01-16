<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];

$result =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId';"));
if($result['CommishId'] != $UserId)
{die;}
$DraftTime = $result['DraftTime'];
$val = strtotime($DraftTime);
$rand1 = date('Y-m-d', $val);
$rand2 = date('H:i:s', $val);
$DraftTime = $rand1.'T'.$rand2;

$NoOfTeams = ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantteams WHERE LeagueId = '$LeagueId';"));
$AllTeams = [];
$AllNames = [];
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId'")) as $Teams)
{
    array_push($AllTeams,$Teams['TeamId']);
    array_push($AllNames,$Teams['TeamName']);
}
$CurrOrder=[];
$x=0;
$DraftOrder = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LeagueId';"));
while($x<$NoOfTeams)
{
    $x=$x+1;
    $Slot = "Team$x";
    array_push($CurrOrder,$DraftOrder[$Slot]);
}


?>
<br>    <label for="meeting-time">Choose a time for your Draft (click the square calendar icon):</label>
    
    <input type="datetime-local" id="draft-time"
       name="meeting-time" value="<?php echo $DraftTime;?>"
       min="2022-08-22T00:00" max="2022-10-15T00:00">
<?php


    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Draft Position</th>
        <th>Team Name</th>
        <?php
    echo '</tr><tbody>';

    $y=1;
    while($y <= $NoOfTeams)
    {   
        $z=$y-1;
        echo '<tr>';
        echo '<td>Pos '.$y.'</td>';
        echo '<td class = "select"> 
        <select id="Team'.$y.'">';
        $AllTeams =array_filter($AllTeams);
        for ($i = 0; $i < count($AllTeams); $i++) {        
            $Name = $AllNames[$i];
            $Id = $AllTeams[$i];
            if($CurrOrder[$z] == $AllTeams[$i])
            {   echo '<option value="'.$AllTeams[$i].'" selected="selected">'.$Name.'</option>';   }
            else {    echo '<option value="'.$Id.'">'.$Name.'</option>';  }
        }
        echo '</select>';
        echo '</tr>';
        $y++;
    }


    echo '</tr></tbody></table>';

    echo '<br><input type="button" name="Submit" id="'.$LeagueId.'" class="btn btn-success Submit" value="Submit Starters"> &nbsp';

?>

<script type="text/javascript">
    $(document).ready(function(){

        $(".Submit").on('click', function(){
            var e = document.getElementById("Team1");
            if (e == null) {
                T1Id = "NULL";
            }
            else{var T1Id = e.value;}
            var e = document.getElementById("Team2");
            if (e == null) {
                T2Id = "NULL";
            }
            else{var T2Id = e.value;}
            var e = document.getElementById("Team3");
            if (e == null) {
                T3Id = "NULL";
            }
            else{var T3Id = e.value;}
            var e = document.getElementById("Team4");
            if (e == null) {
                T4Id = "NULL";
            }
            else{var T4Id = e.value;}
            var e = document.getElementById("Team5");
            if (e == null) {
                T5Id = "NULL";
            }
            else{var T5Id = e.value;}
            var e = document.getElementById("Team6");
            if (e == null) {
                T6Id = "NULL";
            }
            else{var T6Id = e.value;}
            var e = document.getElementById("Team7");
            if (e == null) {
                T7Id = "NULL";
            }
            else{var T7Id = e.value;}
            var e = document.getElementById("Team8");
            if (e == null) {
                T8Id = "NULL";
            }
            else{var T8Id = e.value;}
            var e = document.getElementById("Team9");
            if (e == null) {
                T9Id = "NULL";
            }
            else{var T9Id = e.value;}
            var e = document.getElementById("Team10");
            if (e == null) {
                T10Id = "NULL";
            }
            else{var T10Id = e.value;}
            var e = document.getElementById("Team11");
            if (e == null) {
                T11Id = "NULL";
            }
            else{var T11Id = e.value;}
            var e = document.getElementById("Team12");
            if (e == null) {
                T12Id = "NULL";
            }
            else{var T12Id = e.value;}
            var NewTime = document.getElementById("draft-time").value;
            var LeagueId = $(this).attr('id');



            $.post("NewDraftTime2.php", {
                LeagueId:LeagueId,
                T1Id:T1Id,
                T2Id:T2Id,
                T3Id:T3Id,
                T4Id:T4Id,
                T5Id:T5Id,
                T6Id:T6Id,
                T7Id:T7Id,
                T8Id:T8Id,
                T9Id:T9Id,
                T10Id:T10Id,
                T11Id:T11Id,
                T12Id:T12Id,
                NewTime:NewTime
            }, function(data){
                $("#Team").html(data);
            });	
               });

    });

</script>
