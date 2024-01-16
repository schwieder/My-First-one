<?php

	require_once("Header.php");
	
?>

<html>
<head>
<title>Page Title</title>
</head>
<body>

<div id="Main">

	<span>
		<br><br>

		<input name="submit" id="submitme" type="image" src="Images/BobAthletes.jpg" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:450px;" />
        <span style="padding-left:460px;">Training</span>
        
		<br><br>
		<input name="submit" id="submitme" type="image" src="Images/BobSled.png" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:330px;" />
		<input name="submit" id="submitme" type="image" src="Images/BobTrack.jpg" onclick="SignMeUp();" style="border-radius: 50%; width:80px;height:80px; margin-left: 160px;" />
        <span style="padding-left:315px;">Sled Technology</span>
        <span style="padding-left:170px;">Track</span>
		<br><br>
		<input name="submit" id="submitme" type="image" src="Images/Luge.png" onclick="SignMeUp();" style="width:80px;height:80px; padding-left:210px;" />
		<input name="submit" id="submitme" type="image" src="Images/Biathalon.png" onclick="SignMeUp();" style="width:80px;height:80px; margin-left: 160px;" />
		<input name="submit" id="submitme" type="image" src="Images/Biathalon.png" onclick="SignMeUp();" style="width:80px;height:80px; margin-left: 160px;" />
	</span>

</div>
<div align="Center" id="sub">
</div>


</body>
</html>
		
	</body>
	
</html>

<script type="text/javascript">
    $("#sub").hide();
    function SignMeUp()
    {
        $.post("BobTech.php", {}, function(data){
					$("#sub").html(data);
                    $("#Main").hide();
                    $("#sub").show();
				});
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

