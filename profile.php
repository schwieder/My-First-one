<?php

	require_once("Header.php");
	
	$error = "";

?>
	<html>
<head>
<title>Page Title</title>
</head>
<body>

<script type="text/javascript">
function Gr4()
{

	$.ajax({

			url:"Gr4Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr5()
{

	$.ajax({

			url:"Gr5Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr6()
{

	$.ajax({

			url:"Gr6Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}

$(document).ready(function(){

<?php

if($Grade == "4"){
?>
	Gr4();
<?php
}
else if($Grade == "5"){
?>
	Gr5();
<?php
}
else if($Grade == "6"){
?>
	Gr6();
<?php
}
else {
?>

<?php
}
?>

});

</script>


<br>
<h1 align=center>Instructions - PLEASE READ!!!!	</h1>
<p>

Math

	<span>
		<br><br>
		<input name="submit" id="submitme" type="image" src="Images/Bobsleigh.png" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:450px;" />
        <span style="padding-left:460px;">Bobsled</span>
		<br><br>
		<input name="submit" id="submitme" type="image" src="Images/Luge.png" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:330px;" />
		<input name="submit" id="submitme" type="image" src="Images/Biathalon.png" onclick="SignMeUp();" style="width:80px;height:80px; margin-left: 160px;" />
        <span style="padding-left:350px;">Luge</span>
        <span style="padding-left:210px;">Luge</span>
		<br><br>
		<input name="submit" id="submitme" type="image" src="Images/Luge.png" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:210px;" />
		<input name="submit" id="submitme" type="image" src="Images/Biathalon.png" onclick="SignMeUp();" style="width:80px;height:80px; margin-left: 160px;" />
		<input name="submit" id="submitme" type="image" src="Images/Biathalon.png" onclick="SignMeUp();" style="width:80px;height:80px; margin-left: 160px;" />
	</span>

<?php
if ($Grade == "4")
{
	?>
<br>
<br>
<a href="Gr4Research.php"  > Research </a>
<br>
<br>
<a href="Gr4BuySell.php"  > Buy and Sell </a>

<?php
}
?>
</p>

</body>
</html>
		</div>
		<div align="Center" id="Research">
		<br>
		Research - Need to get rid of this later. 
		</div>
		
	</body>
	
</html>

<script type="text/javascript">
    function SignMeUp()
    {
		window.location = "Bobsleigh.php";
    }
	$(document).ready(function(){
		$(".All").on('click', function(){			
			{
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
                var LeagueId = $(this).attr("idL");
				$.post("RecrutingManageAll.php", {TeamId : TeamId, LeagueId: LeagueId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
		$(".Chosen").on('click', function(){			
			{
                $("#Team").show();
                $("#Team2").show();
                var TeamId = $(this).attr("id");
                var LeagueId = $(this).attr("idL");
				$.post("RecrutingManageList.php", {TeamId : TeamId, LeagueId: LeagueId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});

</script>

