<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueId = $_POST['LeagueId'];
$Pos = $_POST['Pos'];
$Sort = $_POST['Sort'];
$taken = [];
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId'")) as $chosen)
{
    array_push($taken,$chosen['PlayerId']);
}
echo '<br><input type="button" rel="PlayerId" fart="QB" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="QB"> &nbsp';
echo '<input type="button" rel="PlayerId" fart="RB" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="RB"> &nbsp';
echo '<input type="button" rel="PlayerId" fart="WR" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="WR"> &nbsp';
echo '<input type="button" rel="PlayerId" fart="K" id="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="K"> &nbsp';

echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 700px;"><tr></tr>
<tr>';
    ?>
    <th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Name'></th>
    <th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Team'></th>
    <?php
    //change Chosen to a button? Or only show Free Agents?
echo '</tr><tbody>';

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM roster WHERE Pos = '$Pos' ORDER BY $Sort")) as $row)
{
    if (!in_array($row['PlayerId'], $taken))
    {
        $N = $row['Name'];
        $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);

        echo '<tr>';
        echo '<td>'.$Name.'</td>';
        echo '<td>'.$row['Team'].'</td>';
        echo '</tr>';
    }
}
echo '</tbody>';

?>

<script type="text/javascript">
 	LeagueId = "<?php echo $LeagueId; ?>";

$(document).ready(function(){
    $(".FA").on('click', function(){
        var Pos = $(this).attr("fart");
        var Sort = $(this).attr("rel");
        $.post("DraftChart.php", {Pos: Pos, LeagueId:LeagueId, Sort:Sort}, function(data){
            $("#Drafting").html(data);
        });	
    });

    $(".Chart").on('click', function(){
        var Pos = $(this).attr("fart");
        var Sort = $(this).attr("rel");
        $.post("DraftChart.php", {Pos: Pos, LeagueId:LeagueId, Sort:Sort}, function(data){
            $("#Drafting").html(data);
        });	
    });

});

</script>
