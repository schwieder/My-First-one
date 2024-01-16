<?php

	require_once("Header.php");
	

$_SESSION['Pos'] = "None";
$_SESSION['HScore'] = 0;
$_SESSION['AScore'] = 0;
$_SESSION['TotalTalk'] = "";
$_SESSION['Count'] = 0;

?>
<div id="Start">
<?php
echo "<br><br><br>";
echo "Your team is Washington";

echo "<br><br>";
echo '<input type="button" id="1" name="1" class="btn btn-success submit" value="Start Game">';


?>
</div>
<div id="Score"></div>
<div id="GamePlay"></div>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Gameplay").hide();
        $("#Score").hide();
		$(".Submit").on('click', function(){			
				$.post("GamePlay.php", {}, function(data){
                    $("#Start").hide();
                    $("#Gameplay").show();
                    $("#Score").show();
					$("#GamePlay").html(data);
				});
		});
    });
</script>

