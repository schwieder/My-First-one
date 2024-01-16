<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM hkyteams WHERE teamId ='$TeamId'"));
$LeagueId = $Info['leagueId'];
$TeamName = $Info['teamName'];
$OwnerId = $Info['ownerId'];
if($OwnerId == "0"){
    $UserName = "Computer";
}
else{
    $UserName = ReadScalar(ExecuteSqlQuery("SELECT Username FROM Users WHERE Id ='$OwnerId'"));
}

    echo '<br/><p style = "text-align: center; font-size: 25px; color: Blue; " >New Team Name</p>';
    echo "<label>New Owner Team Name :</label><br/>";
    echo '<input type="text" name="TeamName" id="TeamName" value="'.$TeamName.'" /><br/>';

    echo '<p style = "text-align: center; font-size: 25px; color: Blue; " >New Owner</p>';
    echo "<label>New Owner Username :</label><br/>";
    echo '<input type="text" name="NewOwner" id="NewOwner" value="'.$UserName.'" /><br/><br/>';

    echo '<input type="button" class="btn btn-success New" value="Change Info">';

?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".New").on('click', function(){			
			{
                $("#Refresh").show();
                var NewTeamName = document.getElementById('TeamName').value;
                var NewOwner = document.getElementById('NewOwner').value;
                var LeId = "<?php echo $LeagueId; ?>";
                var TeamId = "<?php echo $TeamId; ?>";
				$.post("LeagueManageChangeNameExecute.php", {TeamId:TeamId, LeId:LeId, NewTeamName:NewTeamName, NewOwner: NewOwner}, function(data){
					$("#Refresh").html(data);
				});
			}
		});
	});
</script>
