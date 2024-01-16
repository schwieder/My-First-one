<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$NewTeamName = $_POST['NewTeamName'];
$NewOwnerName = $_POST['NewOwner'];
$LeagueId = $_POST['LeId'];
$TeamId = $_POST['TeamId'];

if(Email_Exists($NewOwnerName))
{
    $OwnerId = ReadScalar(ExecuteSqlQuery("SELECT Id FROM Users WHERE Username ='$NewOwnerName'"));
    $insertQuery = "UPDATE hkyteams SET teamName=?, ownerId=? WHERE teamId=?";
    ExecuteSqlQuery($insertQuery, $NewTeamName, $OwnerId, $TeamId);
}
else if($NewOwnerName == "Computer")
{
    $insertQuery = "UPDATE hkyteams SET teamName=?, ownerId='0' WHERE teamId=?";
    ExecuteSqlQuery($insertQuery, $NewTeamName, $TeamId);
}
else
{
    echo "That owner doesn't exist, so nothing was changed";
}

?>
<script type="text/javascript">
	$(document).ready(function(){
        var LeagueId = "<?php echo $LeagueId;?>";
        $.post("LeagueManage.php", { LeagueId : LeagueId }, function(data){
            $("#League").html(data);
        });
	});
</script>
