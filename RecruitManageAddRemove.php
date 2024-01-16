<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");


$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$LeagueId = $_POST['LeagueId'];
$TeamNo = $_POST['teamNo'];
$recruitId = $_POST['recruitId'];
$YN = $_POST['YN'];
if($TeamNo == "1"){$List = "team1List";}
else if($TeamNo == "2"){$List = "team2List";}
else if($TeamNo == "3"){$List = "team3List";}
else if($TeamNo == "4"){$List = "team4List";}
else if($TeamNo == "5"){$List = "team5List";}
else if($TeamNo == "6"){$List = "team6List";}

$insertQuery = "UPDATE recruits SET ".$List."='".$YN."' WHERE recruitId=?";
ExecuteSqlQuery($insertQuery, $recruitId);


echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
<tr>'
    ?>
    <th>Name</th>
    <th>Potential</th>
    <th><a href="#" onclick="Pos();">Position</a></th>
    <th>Shooting</th>
    <th>Defending</th>
    <th>Goaltending</th>
    <th>Interest</th>
    <th>Add to List</th>
    <?php
echo '
    ';
echo '</tr><tbody class="gridtable">';

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM recruits WHERE leagueId = ".$LeagueId."")) as $row)
    {
        $RecruitId = $row['recruitId'];
        echo '<tr>';
        echo '<td>'.$row['playerName'].'</td>';

        if($row['potential'] == "")
        {$Potential = "N/A";}
        else if($row['potential'] >= 95)
        {$Potential = "A+";}
        else if($row['potential'] >= 90)
        {$Potential = "A";}
        else if($row['potential'] >= 80)
        {$Potential = "B";}
        else if($row['potential'] >= 70)
        {$Potential = "C";}
        else if($row['potential'] >= 60)
        {$Potential = "D";}
        else if($row['potential'] > 50)
        {$Potential = "F";}
        else if($row['potential'] >= 50)
        {$Potential = "F-";}
    
        echo '<td>'.$Potential.'</td>';
 
        echo '<td>'.$row['position'].'</td>';
        if($row['shotPercent'] == "")
        {$Shot = "N/A";}
        else if($row['shotPercent'] >= 19)
        {$Shot = "A+";}
        else if($row['shotPercent'] >= 15)
        {$Shot = "A";}
        else if($row['shotPercent'] >= 10)
        {$Shot = "B";}
        else if($row['shotPercent'] >= 6)
        {$Shot = "C";}
        else if($row['shotPercent'] >= 3)
        {$Shot = "D";}
        else if($row['shotPercent'] > 1)
        {$Shot = "F";}
        else if($row['shotPercent'] == 1)
        {$Shot = "F-";}
        else if($row['shotPercent'] == 0)
        {$Shot = "F-";}
        if($row['blockPercent'] == "")
        {$Block = "N/A";}
        else if($row['blockPercent'] >= 95)
        {$Block = "A+";}
        else if($row['blockPercent'] >= 85)
        {$Block = "A";}
        else if($row['blockPercent'] >= 75)
        {$Block = "B";}
        else if($row['blockPercent'] >= 65)
        {$Block = "C";}
        else if($row['blockPercent'] >= 55)
        {$Block = "D";}
        else if($row['blockPercent'] >= 50)
        {$Block = "F";}
        else if($row['blockPercent'] == 45)
        {$Block = "F-";}
        if($row['savePercentAbility'] == "")
        {$Save = "N/A";}
        else if($row['savePercentAbility'] >= 930)
        {$Save = "A+";}
        else if($row['savePercentAbility'] >= 920)
        {$Save = "A";}
        else if($row['savePercentAbility'] >= 910)
        {$Save = "B";}
        else if($row['savePercentAbility'] >= 900)
        {$Save = "C";}
        else if($row['savePercentAbility'] >= 890)
        {$Save = "D";}
        else if($row['savePercentAbility'] >= 880)
        {$Save = "F";}
        else if($row['savePercentAbility'] < 870)
        {$Save = "F-";}
        echo '<td>'.$Shot.'</td>';
        echo '<td>'.$Block.'</td>';
        echo '<td>'.$Save.'</td>';

        if($TeamNo == "1")
        {$TeamInterest = $row['team1Int'];}
        else if($TeamNo == "2")
        {$TeamInterest = $row['team2Int'];}
        else if($TeamNo == "3")
        {$TeamInterest = $row['team3Int'];}
        else if($TeamNo == "4")
        {$TeamInterest = $row['team4Int'];}
        else if($TeamNo == "5")
        {$TeamInterest = $row['team5Int'];}
        else if($TeamNo == "6")
        {$TeamInterest = $row['team6Int'];}
        
        if($TeamInterest >= 550)
        {$Interest = "A+";}
        else if($TeamInterest >= 500)
        {$Interest = "A";}
        else if($TeamInterest >= 400)
        {$Interest = "B";}
        else if($TeamInterest >= 300)
        {$Interest = "C";}
        else if($TeamInterest >= 150)
        {$Interest = "D";}
        else
        {$Interest = "F";}

        echo '<td>'.$Interest.'</td>';

        if($TeamNo == "1")
        {$TeamList = $row['team1List'];}
        else if($TeamNo == "2")
        {$TeamList = $row['team2List'];}
        else if($TeamNo == "3")
        {$TeamList = $row['team3List'];}
        else if($TeamNo == "4")
        {$TeamList = $row['team4List'];}
        else if($TeamNo == "5")
        {$TeamList = $row['team5List'];}
        else if($TeamNo == "6")
        {$TeamList = $row['team6List'];}
        
        if($TeamList== 'N')
        {
            echo '<td><input type="button" name="Add" id="'.$TeamNo.'" idR="'.$RecruitId.'" class="btn btn-success Add" value="Add to list"></td>';
        }
        else{
            echo '<td><input type="button" name="Remove" id="'.$TeamNo.'" idR="'.$RecruitId.'" class="btn btn-success Remove" value="Remove from list"></td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
?>

<script>
     function Pos() {
        var TeamId = <?php echo $TeamId; ?>;
        var LeagueId = <?php echo $LeagueId; ?>;
        $.post("RecruitManagePlayersSortByPos.php", {TeamId : TeamId, LeagueId: LeagueId}, function(data){
            $("#Team2").html(data);
        });
     }
     $(".Add").on('click', function(){			
        {
            var TeamId = <?php echo $TeamId; ?>;
            var recruitId = $(this).attr('idR');
            var teamNo = $(this).attr('id');
            var LeagueId = <?php echo $LeagueId; ?>;
            var YN = "Y";
            $.post("RecruitManageAddRemove.php", {YN : YN, recruitId : recruitId, teamNo : teamNo, LeagueId: LeagueId, TeamId: TeamId}, function(data){
                $("#Team2").html(data);
            });
        }
    });
    $(".Remove").on('click', function(){			
        {
            var TeamId = <?php echo $TeamId; ?>;
            var recruitId = $(this).attr('idR');
            var teamNo = $(this).attr('id');
            var LeagueId = <?php echo $LeagueId; ?>;
            var YN = "N";
            $.post("RecruitManageAddRemove.php", {YN : YN, recruitId : recruitId, teamNo : teamNo, LeagueId: LeagueId, TeamId: TeamId}, function(data){
                $("#Team2").html(data);
            });
        }
    });

</script>
