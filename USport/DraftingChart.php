<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$Pos = $_POST['Pos'];
$Sort = $_POST['Sort'];
$DraftYear = $_POST['DraftYear'];
$Round = $_POST['Round'];

$taken = [];

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId'")) as $chosen)
{
    array_push($taken,$chosen['PlayerId']);
}

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
    <th>Draft<th>
    <?php
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
        echo '<td><input type="button" id3="'.$Name.'" id2="'.$row['PlayerId'].'" id="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Drafted" value="Draft"></td>';
        echo '</tr>';
    }
}
echo '</tbody>';

?>

<script type="text/javascript">
    TeamId = "<?php echo $TeamId; ?>";
    LeagueId = "<?php echo $LeagueId; ?>";
    DraftYear = "<?php echo $DraftYear; ?>";
    Round = "<?php echo $Round; ?>";

$(document).ready(function(){

    function Drafting() {
			{   
                $("#Team2").show();
                $("#League").hide();
				$.post("DraftDay.php", {TeamId:TeamId, LeagueId:LeagueId }, function(data){
					$("#Team2").html(data);
				});
                alert("12");
			}
    }

    $(".FA").on('click', function(){
        var Pos = $(this).attr("fart");
        var Sort = $(this).attr("rel");
        $.post("DraftingChart.php", {Pos: Pos, LeagueId:LeagueId, Sort:Sort, TeamId:TeamId, DraftYear:DraftYear, Round:Round}, function(data){
            $("#Drafting").html(data);
        });	
    });

    $(".Chart").on('click', function(){
        var Pos = $(this).attr("fart");
        var Sort = $(this).attr("rel");
        $.post("DraftingChart.php", {Pos: Pos, LeagueId:LeagueId, Sort:Sort}, function(data){
            $("#Drafting").html(data);
        });	
    });

    $(".Drafted").on('click', function(){			
        var Chosen = $(this).attr("id2");
        var Name = $(this).attr("id3");
        $.post("DraftDayDone.php", {Name:Name, Round:Round, LeagueId : LeagueId, Chosen:Chosen, LastDrafted:LastDrafted, DraftYear:DraftYear }, function(data){
            $("#Team").html(data);
        });
        $.post("Draftbuttons.php", { LeagueId : LeagueId, TeamId:TeamId, DraftYear:DraftYear }, function(data){
            $("#DraftButtons").html(data);
        });
        $("#Drafting").hide();
    });
    

});

</script>
