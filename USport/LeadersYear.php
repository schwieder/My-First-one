<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];


echo '<br><input type="button" rel="PassYds" id="QB" id2="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="QB"> &nbsp';
echo '<input type="button" rel="RushYds" id="RB" id2="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="RB"> &nbsp';
echo '<input type="button" rel="RecYds" id="WR" id2="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="WR"> &nbsp';
echo '<input type="button" rel="KORYds" id="Ret" id2="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="Returns"> &nbsp';
echo '<input type="button" rel="KickPts" id="K" id2="'.$LeagueId.'" align="right" style="height:20px;width:150px;" class="btn btn-success FA" value="K"> &nbsp';


?>

<script type="text/javascript">
$(document).ready(function(){
	$(".FA").on('click', function(){
		var Pos = $(this).attr("id");
		var LId = $(this).attr("id2");
		var Sort = $(this).attr("rel");
		$.post("LeadersYearChart.php", {Pos: Pos, LId: LId, Sort:Sort}, function(data){
			$("#TeamInner").html(data);
		});
	});
});

</script>
