<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 

echo "<label for='LeagueName'>Name of the League:</label>";
echo "<input type='text' id='LeagueName' class='form-control LeagueName' name='LeagueName' placeholder='LeagueName' required> &nbsp";
echo "<label for='LeagueCode'>League Code:</label>";
echo "<input type='Number' id='LeagueCode' name='LeagueCode' style = 'width:50px;'  required>  &nbsp;<br><br> ";
echo "<label for='TeamName'>Name of Your Team:</label>";
echo "<input type='text' id='TeamName' class='form-control TeamName' name='TeamName' required>";

echo '<input type="button" id="'.$UserId.'" name="submit" class="btn btn-success submit" value="submit">';

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".submit").on('click', function(){
			var LeagueName = $('input[id="LeagueName"]').val();
			var LeagueCode = $('input[id="LeagueCode"]').val();
            var TeamName = $('input[id="TeamName"]').val();
            {
                $("#League").hide();
                $("#Class").show();
                $("#Refresh").show();
				$.post("LeagueJoin2.php", {
					TeamName : TeamName, 
					LeagueName : LeagueName,
					LeagueCode : LeagueCode,
				}, function(data){
					$("#Class").html(data);
				});
			}
		});
	});

</script>

