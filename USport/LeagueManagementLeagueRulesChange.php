<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueId = $_POST['LeagueId'];
$LeagueName = $_POST['LeagueName'];
$TeamNo = $_POST['TeamNo'];
$PassYds= $_POST['PassYds'];
$PassTds= $_POST['PassTds'];
$PassInts= $_POST['PassInts'];
$RushYds= $_POST['RushYds'];
$RushTds= $_POST['RushTds'];
$RecYds= $_POST['RecYds'];
$RecTds= $_POST['RecTds'];
$KORYds= $_POST['KORYds'];
$KORTds= $_POST['KORTds'];
$PRYds= $_POST['PRYds'];
$PRTds= $_POST['PRTds'];
$Fum= $_POST['Fum'];
$FumLost= $_POST['FumLost'];

    $insertQuery = "UPDATE fantleagues SET CommishId=?, LeagueName=?, PassYds=?,PassTds=?,PassInts=?,RushYds=?,RushTds=?,RecYds=?,RecTds=?,KORYds=?,KORTds=?,PRYds=?,PRTds=?,Fum=?,FumLost=? WHERE LeagueId=$LeagueId"; 
    ExecuteSqlQuery($insertQuery, $UserId, $LeagueName, $PassYds, $PassTds, $PassInts, $RushYds, $RushTds, $RecYds, $RecTds, $KORYds, $KORTds, $PRYds, $PRTds, $Fum, $FumLost); 

    echo "$LeagueName has been updated";


?>

<script type="text/javascript">
	LeagueId = "<?php echo $LeagueId; ?>";
	$(document).ready(function(){
            $.post("LeagueManagement.php", {LeagueId:LeagueId}, function(data){
                $("#Team").html(data);
            });

	});

</script>
