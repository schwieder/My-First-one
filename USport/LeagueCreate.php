<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 

echo "<br><br><br><input type='text' id='LeagueName' class='form-control LeagueName' name='LeagueName' placeholder='LeagueName' required><br><br>";

echo "<input type='text' id='YourTeamName' class='form-control YourTeamName' name='YourTeamName' placeholder='YourTeamName' required> &nbsp; ";

echo "<label for='TeamNo'># of Teams: (max 12) </label>";
echo "<input type='Number' id='TeamNo' name='TeamNo' style = 'width:50px;' value='6' <br><br><br>";
echo "<label for='PassYds'>Passing Pts per 25 yds:</label>";
echo "<input type='Number' id='PassYds' name='PassYds' style = 'width:50px;' value='1'>  &nbsp; ";
echo "<label for='PassTds'>Passing Td Pts:</label>";
echo "<input type='Number' id='PassTds' name='PassTds' style = 'width:50px;' value='4'> &nbsp; ";
echo "<label for='PassInts'>Passing Ints:</label>";
echo "<input type='Number' id='PassInts' name='PassInts' style = 'width:50px;' value='-1'><br><br>";

echo "<label for='RushYds'>Rushing Pts per 10 yds:</label>";
echo "<input type='Number' id='RushYds' name='RushYds' style = 'width:50px;' value='1'>  &nbsp; ";
echo "<label for='RushTds'>Rushing Td Pts:</label>";
echo "<input type='Number' id='RushTds' name='RushTds' style = 'width:50px;' value='6'> &nbsp; ";
echo "<label for='RecYds'>Receiving Pts per 10 yds:</label>";
echo "<input type='Number' id='RecYds' name='RecYds' style = 'width:50px;' value='1'>  &nbsp; ";
echo "<label for='RecTds'>Receiving Td Pts:</label>";
echo "<input type='Number' id='RecTds' name='RecTds' style = 'width:50px;' value='6'> &nbsp; <br><br>";

echo "<label for='KORYds'>KOR Pts per 10 yds:</label>";
echo "<input type='Number' id='KORYds' name='KORYds' style = 'width:50px;' value='1'>  &nbsp; ";
echo "<label for='KORTds'>KOR Td Pts:</label>";
echo "<input type='Number' id='KORTds' name='KORTds' style = 'width:50px;' value='6'> &nbsp; ";
echo "<label for='PRYds'>PR Pts per 10 yds:</label>";
echo "<input type='Number' id='PRYds' name='PRYds' style = 'width:50px;' value='1'>  &nbsp; ";
echo "<label for='PRTds'>PR Td Pts:</label>";
echo "<input type='Number' id='PRTds' name='PRTds' style = 'width:50px;' value='6'> &nbsp; <br><br>";

echo "<label for='Fum'>Fumbles:</label>";
echo "<input type='Number' id='Fum' name='Fum' style = 'width:50px;' value='0'>  &nbsp; ";
echo "<label for='FumLost'>Fumbles Lost:</label>";
echo "<input type='Number' id='FumLost' name='FumLost' style = 'width:50px;' value='-1'>  &nbsp; <br><br>";

echo '<input type="button" id="'.$UserId.'" name="submit" class="btn btn-success submit" value="submit">';

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".submit").on('click', function(){			
			var LeagueName = $('input[id="LeagueName"]').val();
            var TeamName = $('input[id="YourTeamName"]').val();
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
                $("#League").hide();
                $("#Class").show();
                $("#Refresh").show();
				$.post("LeagueCreation.php", {
					TeamName : TeamName, 
					LeagueName : LeagueName,
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
					$("#Class").html(data);
				});
			}
		});
	});

</script>

