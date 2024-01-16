<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];

$result =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantleagues WHERE (CommishId = '$UserId') AND (LeagueId = '$LeagueId');"));
if($result != "1")
{die;}

$Drafted =  ReadScalar(ExecuteSqlQuery("SELECT Drafted FROM fantleagues WHERE LeagueId = '$LeagueId'"));
$Info =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId';"));
$LeagueName = $Info['LeagueName'];
$TeamNo = $Info['MaxTeams'];
$PassYds = $Info['PassYds'];
$PassTds = $Info['PassTds'];
$PassInts = $Info['PassInts'];
$RushYds = $Info['RushYds'];
$RushTds = $Info['RushTds'];
$RecYds = $Info['RecYds'];
$RecTds = $Info['RecTds'];
$KORYds = $Info['KORYds'];
$KORTds = $Info['KORTds'];
$PRYds = $Info['PRYds'];
$PRTds = $Info['PRTds'];
$Fum = $Info['Fum'];
$FumLost = $Info['FumLost'];


echo "<br><input type='text' id='LeagueName' class='form-control LeagueName' name='LeagueName' value='$LeagueName' required><br><br>";

if($Drafted == "N")
{
    echo "<label for='TeamNo'>How Many Teams:</label>";
    echo "<input type='Number' id='TeamNo' name='TeamNo' style = 'width:50px;' value='$TeamNo' <br><br><br>";
}

echo "<label for='PassYds'>Passing Pts per 25 yds:</label>";
echo "<input type='Number' id='PassYds' name='PassYds' style = 'width:50px;' value='$PassYds'>  &nbsp; ";
echo "<label for='PassTds'>Passing Td Pts:</label>";
echo "<input type='Number' id='PassTds' name='PassTds' style = 'width:50px;' value='$PassTds'> &nbsp; ";
echo "<label for='PassInts'>Passing Td Ints:</label>";
echo "<input type='Number' id='PassInts' name='PassInts' style = 'width:50px;' value='$PassInts'><br><br>";

echo "<label for='RushYds'>Rushing Pts per 10 yds:</label>";
echo "<input type='Number' id='RushYds' name='RushYds' style = 'width:50px;' value='$RushYds'>  &nbsp; ";
echo "<label for='RushTds'>Rushing Td Pts:</label>";
echo "<input type='Number' id='RushTds' name='RushTds' style = 'width:50px;' value='$RushTds'> &nbsp; ";
echo "<label for='RecYds'>Receiving Pts per 10 yds:</label>";
echo "<input type='Number' id='RecYds' name='RecYds' style = 'width:50px;' value='$RecYds'>  &nbsp; ";
echo "<label for='RecTds'>Receiving Td Pts:</label>";
echo "<input type='Number' id='RecTds' name='RecTds' style = 'width:50px;' value='$RecTds'> &nbsp; <br><br>";

echo "<label for='KORYds'>KOR Pts per 10 yds:</label>";
echo "<input type='Number' id='KORYds' name='KORYds' style = 'width:50px;' value='$KORYds'>  &nbsp; ";
echo "<label for='KORTds'>KOR Td Pts:</label>";
echo "<input type='Number' id='KORTds' name='KORTds' style = 'width:50px;' value='$KORTds'> &nbsp; ";
echo "<label for='PRYds'>PR Pts per 10 yds:</label>";
echo "<input type='Number' id='PRYds' name='PRYds' style = 'width:50px;' value='$PRYds'>  &nbsp; ";
echo "<label for='PRTds'>PR Td Pts:</label>";
echo "<input type='Number' id='PRTds' name='PRTds' style = 'width:50px;' value='$PRTds'> &nbsp; <br><br>";

echo "<label for='Fum'>Fumbles:</label>";
echo "<input type='Number' id='Fum' name='Fum' style = 'width:50px;' value='$Fum'>  &nbsp; ";
echo "<label for='FumLost'>Fumbles Lost:</label>";
echo "<input type='Number' id='FumLost' name='FumLost' style = 'width:50px;' value='$FumLost'>  &nbsp; <br><br>";

echo '<input type="button" id="'.$UserId.'" name="submit" class="btn btn-success submit" value="submit">';


?>

<script type="text/javascript">
	LeagueId = "<?php echo $LeagueId; ?>";
	$(document).ready(function(){
		$(".submit").on('click', function(){			
			var LeagueName = $('input[id="LeagueName"]').val();
            var TeamNo = $('input[id="TeamNo"]').val();
            var PassYds = $('input[id="PassYds"]').val();
            var PassTds = $('input[id="PassTds"]').val();
            var PassInts = $('input[id="PassInts"]').val();
            var RushYds = $('input[id="RushYds"]').val();
            var RushTds = $('input[id="RushTds"]').val();
            var RecYds = $('input[id="RecYds"]').val();
            var RecTds = $('input[id="RecTds"]').val();
            var KORYds = $('input[id="KORYds"]').val();
            var KORTds = $('input[id="KORTds"]').val();
            var PRYds = $('input[id="PRYds"]').val();
            var PRTds = $('input[id="PRTds"]').val();
            var Fum = $('input[id="Fum"]').val();
            var FumLost = $('input[id="FumLost"]').val();
            {
				$.post("LeagueManagementLeagueRulesChange.php", {
					LeagueName : LeagueName,
					LeagueId : LeagueId,
					TeamNo:TeamNo,
					PassYds:PassYds,
					PassTds:PassTds,
					PassInts:PassInts,
					RushYds:RushYds,
					RushTds:RushTds,
					RecYds:RecYds,
					RecTds:RecTds,
					KORYds:KORYds,
					KORTds:KORTds,
					PRYds:PRYds,
					PRTds:PRTds,
					Fum:Fum,
					FumLost:FumLost
				}, function(data){
					$("#TeamInner").html(data);
				});
			}
		});
	});

</script>

