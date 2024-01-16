<?php

	require_once("Header.php");

    echo "<div id='Profile' style='text-align:center;'>";


	echo "<br><br><br>";
	echo "Before you work on this.... make sure you've done the class changes for each kid!!!";
	echo "<br><br>";
	echo "Now to figure out how to add players to who's playing for each team... do I make a table? or do I add to init? (what's the downfall of writing to a file vs a table? Can people edit the file?";
//	die; 

	$Playing = ReadScalar(ExecuteSqlQuery("SELECT Playing FROM users WHERE Id ='$UserId'"));

	$error = "";

echo "<br><br><br>";


if($Playing == NULL)
{
	echo '<button type="button" value="Search" id='.$UserId.' onclick="clicked(this)">Challenge someone</button>';
}
else 
{
	echo '<button type="button" value="Continue" id='.$UserId.' onclick="clicked(this)">Continue Game</button>';
	echo "- Or -";
	echo '<button type="button" value="End" id='.$UserId.' onclick="clicked(this)">End Game</button>';
}

echo "</div>";
echo "<div id='Result' style='background-color:#32CD32; text-align:center;'><br><br><br>";
echo "<div id='Game' style='background-color:#32CD32; text-align:center;'><br><br><br>";
echo "<div id='Score' style='background-color:#32CD32; text-align:center;'>Score</div>";
echo "<div id='Field' style='background-color:#32CD32; text-align:center;'>Field</div>";
echo "<div id='BatPitch' style='background-color:#32CD32; text-align:center;'>Bat Pitch</div></div>";

?>
</p>

</body>
</html>


<script type="text/javascript">
$(document).ready(function(){
	$("#Result").hide();
	$("#Game").hide();
	$("#Score").hide();
	$("#Field").hide();
	$("#BatPitch").hide();
})
function clicked(e) {
		var UserId = e.id;
		var val = e.value;
		$.post("profileClicked.php", {UserId: UserId, val: val}, function(data){
					$("#Profile").html(data);
				});
	}

</script>