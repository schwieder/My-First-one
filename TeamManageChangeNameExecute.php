<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$NewName = $_POST['NewName'];
$PlayerId = $_POST['PlayerId'];

    
$insertQuery = "UPDATE hkyplayers SET playerName=? WHERE playerId=?";
ExecuteSqlQuery($insertQuery, $NewName, $PlayerId)

?>
<script type="text/javascript">
	$(document).ready(function(){
            var playerId = "<?php echo $PlayerId; ?>";
            $.post("TeamManageEditPlayer.php", {playerId: playerId}, function(data){
                $("#Team2").html(data);
		});
	});
</script>
