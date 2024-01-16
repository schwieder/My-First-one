<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];


echo "<br><br><br><input type='text' id='LeagueName' class='form-control LeagueName' name='LeagueName' placeholder='LeagueName' required><br><br>";

echo "<input type='text' id='YourTeamName' class='form-control YourTeamName' name='YourTeamName' placeholder='YourTeamName' required><br><br>";

echo '<input type="button" id="'.$UserId.'" name="submit" class="btn btn-success submit" value="submit">';

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".submit").on('click', function(){			
            var TeamName = $('input[id="YourTeamName"]').val();
			var LeagueName = $('input[id="LeagueName"]').val();
            {
                $("#League").hide();
                $("#Class").hide();
                $("#Refresh").hide();
				$.post("LeagueCreation.php", {TeamName : TeamName, LeagueName : LeagueName}, function(data){
					$("#Class").html(data);
				});
			}
		});
	});

</script>

