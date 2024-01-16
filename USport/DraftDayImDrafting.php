<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = $_POST['DraftYear'];
$Pos = 'WR';
$Sort = 'PlayerId';
$taken=[];

$Round =  ReadScalar(ExecuteSqlQuery("SELECT Round FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));

if($Round > 10)
{
    echo "The draft has been concluded";
    die;
}
echo "<h4>It's round $Round, who would you like to draft? </h4>";

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LId'")) as $chosen)
{
    array_push($taken,$chosen['PlayerId']);
}
echo '<br><input type="button" rel="PlayerId" id="QB" id2="'.$LId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="QB"> &nbsp';
echo '<input type="button" rel="PlayerId" id="RB" id2="'.$LId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="RB"> &nbsp';
echo '<input type="button" rel="PlayerId" id="WR" id2="'.$LId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="WR"> &nbsp';

echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 700px;"><tr></tr>
<tr>';
    ?>
	<th>Pos</th>
    <th><input type='button' rel="Name" id=<?php echo $LId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success FA' value='Name'></th>
    <th><input type='button' rel="Team" id=<?php echo $LId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success FA' value='Team'></th>
    <th></th>
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
        echo '<td>'.$row['Pos'].'</td>';
        echo '<td>'.$Name.'</td>';
        echo '<td>'.$row['Team'].'</td>';
        echo '<td><input type="button" id3="'.$Name.'" id2="'.$row['PlayerId'].'" id="'.$LId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Draft" value="Draft"></td>';
        echo '</tr>';
    }
}
echo '</tbody>';

?>

<div id="Alert" style="text-align:center;"></div>

<script>
TeamId = "<?php echo $TeamId; ?>";
LeagueId = "<?php echo $LId; ?>";
DraftYear = "<?php echo $DraftYear; ?>";
Round = "<?php echo $Round; ?>";
 
function DoneDrafting()
{
    $.post("DraftDayDone.php", { LeagueId : LeagueId, LastDrafted:LastDrafted, DraftYear:DraftYear, Round:Round }, function(data){
        $("#Team").html(data);
    });
}

$(".Draft").on('click', function(){			
    var Chosen = $(this).attr("id2");
    var Name = $(this).attr("id3");
    $.post("DraftDayDone.php", {Name:Name, Round:Round, LeagueId : LeagueId, Chosen:Chosen, LastDrafted:LastDrafted, DraftYear:DraftYear }, function(data){
        $("#Team").html(data);
    });
});


$(".FA").on('click', function(){
    var Pos = $(this).attr("id");
    var LId = $(this).attr("id2");
    var Sort = $(this).attr("rel");
    $.post("DraftDayChart.php", {Pos: Pos, LId: LId, Sort:Sort, remain:remain, TeamId:TeamId, DraftYear:DraftYear}, function(data){
        $("#Team").html(data);
    });	
});
</script>
