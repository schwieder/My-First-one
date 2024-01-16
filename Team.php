<?php

	require_once("Header.php");

    ?>	<div id="Class" style="text-align:center;">
<br><br>
<?php
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyteams WHERE ownerId = '$UserId'")) as $row)
{
    echo '<td><input type="button" id="'.$row['teamId'].'" align="center" class="btn btn-success Team" value="'.$row['teamName'].'"></td>';
}?>
</div>
<div id="Team" style="text-align:center;"></div>
<div id="Team2" style="text-align:center;"></div>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Team").hide();
        $("#Team2").hide();
        $(".Refresh").on('click', function(){			
			{   
				location: profile.php;
			}
		});
		$(".Team").on('click', function(){			
			{   
                $("#Class").hide();
                $("#Team").show();
                $("#Refresh").hide();
                var TeamId = $(this).attr("id");
				$.post("TeamManage.php", {TeamId : TeamId}, function(data){
					$("#Team").html(data);
				});
			}
		});
	});

</script>

