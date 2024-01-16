<?php

	require_once("Header.php");

    ?>	<div id="Class" style="text-align:center;">
<br><br>
<input type="button" name="Create" class="btn btn-success Create" value="Create a New League">
<br><br>
<?php
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyleagues WHERE commishId = '$UserId'")) as $row)
{
    echo '<td><input type="button" id="'.$row['leagueId'].'" align="center" class="btn btn-success League" value="League '.$row['LeagueName'].'"></td>';
}?>
</div>
<div id="Refresh" style="text-align:center;">
<br><br>
<button onclick="location.href = 'League.php';" id="myButton" class="float-left submit-button" >Refresh to see your leagues</button>
</div>
<div id="League" style="text-align:center;"></div>
<?php




?>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Refresh").hide();
        $("#League").hide();
		$(".Create").on('click', function(){			
			{   
                $("#Class").hide();
                $("#League").show();
                $("#Refresh").hide();
				$.post("LeagueCreate.php", {}, function(data){
					$("#League").html(data);
				});
			}
		});
        $(".Refresh").on('click', function(){			
			{   
				location: profile.php;
			}
		});
		$(".League").on('click', function(){			
			{   
                $("#Class").hide();
                $("#League").show();
                $("#Refresh").hide();
				var LeagueId = $(this).attr('id');
				$.post("LeagueManage.php", { LeagueId : LeagueId }, function(data){
					$("#League").html(data);
				});
			}
		});
	});

</script>

