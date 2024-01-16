<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$Sort = $_POST['Sort'];
echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
<tr>'
    ?>
    <th><a href="#" onclick="Name();">Name</a></th>
    <th><a href="#" onclick="Year();">Yr</a></th>
    <th><a href="#" onclick="Pot();">Potential</a></th>
    <th><a href="#" onclick="Pos();">Position</a></th>
    <th><a href="#" onclick="Shot();">Shooting</a></th>
    <th><a href="#" onclick="Def();">Defending</a></th>
    <th><a href="#" onclick="Tend();">Goaltending</a></th>
    <th><a href="#" onclick="Goals();">Goals</a></th>
    <th><a href="#" onclick="Blocked();">Shots Blocked</a></th>
    <th><a href="#" onclick="Save();">Save %</a></th>
    <?php
echo '
    ';
echo '</tr><tbody class="gridtable">';

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = ".$TeamId." && year < 5 ORDER by ".$Sort." DESC")) as $row)
    {
        echo '<tr>';
        echo '<td>'.$row['playerName'].'</td>';
        echo '<td>'.$row['year'].'</td>';

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
        $Goals = $row['goals'];
        $ShotsBlocked = $row['shotsBlocked'];
        $SavePercent = $row['savePercentage'];
        if($Goals == "0")
        {echo '<td>-</td>';}
        else{echo '<td>'.$Goals.'</td>';}
        if($ShotsBlocked == "0")
        {echo '<td>-</td>';}
        else{echo '<td>'.$ShotsBlocked.'</td>';}
        if($SavePercent == "0")
        {echo '<td>-</td>';}
        else{echo '<td>'.$SavePercent.'</td>';}
        echo '</tr>';
    }
    echo '</tbody>';
?>

<script>
     function Name() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByName.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Year() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByYear.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Pos() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByPos.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Shot() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByShot.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Def() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByDef.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Tend() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByGoalTend.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Goals() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByGoals.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Blocked() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByBlock.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Save() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortBySave.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
     function Pot() {
        var TeamId = <?php echo $TeamId; ?>;
        $.post("TeamManageViewPlayersSortByPot.php", {TeamId : TeamId}, function(data){
            $("#Team2").html(data);
        });
     }
</script>
