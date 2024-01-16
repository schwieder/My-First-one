<?php

    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LId'];
	$Pos = $_POST['Pos'];
	$Sort = $_POST['Sort'];
    $Remain = $_POST['remain'];
    $Remain=$Remain-1000;
    $TeamId = $_POST['TeamId'];
    $DraftYear = $_POST['DraftYear'];
    $taken = [];
    
    $Round =  ReadScalar(ExecuteSqlQuery("SELECT Round FROM fantdraft WHERE LeagueId = '$LeagueId' AND Yr = '$DraftYear'"));

    echo "<h3 id='demo'>Time Remaining</h3>";
    echo "<h4>It's round $Round, who would you like to draft? </h4>";
    
    

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM rosterchosen WHERE LeagueId = '$LeagueId'")) as $chosen)
	{
        array_push($taken,$chosen['PlayerId']);
    }
	echo '<br><input type="button" rel="PlayerId" id="QB" id2="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="QB"> &nbsp';
	echo '<input type="button" rel="PlayerId" id="RB" id2="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="RB"> &nbsp';
	echo '<input type="button" rel="PlayerId" id="WR" id2="'.$LeagueId.'" align="right" style="height:20px;width:200px;" class="btn btn-success FA" value="WR"> &nbsp';

    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 700px;"><tr></tr>
	<tr>';
		?>
		<th>Pos</th>
		<th><input type='button' rel="Name" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success FA' value='Name'></th>
		<th><input type='button' rel="Team" id=<?php echo $LeagueId;?> fart=<?php echo $Pos;?> align="right" style="height:20px;width:100px;" class='btn btn-success FA' value='Team'></th>
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
            echo '<td><input type="button" id3="'.$Name.'" id2="'.$row['PlayerId'].'" id="'.$LeagueId.'" align="right" style="height:20px;width:70px;" class="btn btn-success Draft" value="Draft"></td>';
            echo '</tr>';
        }
    }
	echo '</tbody>';

?>

<script type="text/javascript">

remain = "<?php echo $Remain; ?>";
var add = parseInt(remain);
$(document).ready(function(){

var currentDate = new Date();
var futureDate = new Date(currentDate.getTime() + add);
TeamId = "<?php echo $TeamId; ?>";
LeagueId = "<?php echo $LeagueId; ?>";
DraftYear = "<?php echo $DraftYear; ?>";
Round = "<?php echo $Round; ?>";

function DoneDrafting()
{
    clearInterval(x);
    $.post("DraftDayDone.php", { LeagueId : LeagueId, TeamId:TeamId, DraftYear:DraftYear }, function(data){
        $("#Team").html(data);
    });
}

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = futureDate - now;
        remain = distance;
        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = minutes + "m " + seconds + " remain ";

        // If the count down is finished, write some text
        if (distance < 0) {
            document.getElementById("demo").innerHTML = "EXPIRED";
            DoneDrafting()
        }
    }, 1000);


    $(".FA").on('click', function(){
        var Pos = $(this).attr("id");
        var LId = $(this).attr("id2");
        var Sort = $(this).attr("rel");
        clearInterval(x);
        $.post("DraftDayChart.php", {Pos: Pos, LId: LId, Sort:Sort, remain:remain, TeamId:TeamId, DraftYear:DraftYear}, function(data){
            $("#Team").html(data);
        });	
    });

        $(".Draft").on('click', function(){
			var Chosen = $(this).attr("id2");
			var Name = $(this).attr("id3");
			clearTimeout(x);
            $.post("DraftDayDone.php", {Name:Name, Round:Round, LeagueId : LeagueId, Chosen:Chosen, TeamId:TeamId, DraftYear:DraftYear }, function(data){
                $("#Team").html(data);
            });
		});
	});

</script>
