<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$NewTime = $_POST['NewTime'];
$DraftYear = 2022;

$Time = explode("T",$NewTime);
$SqlTime = $Time[0].' '.$Time[1];

$insertQuery = "UPDATE fantleagues SET DraftTime=? WHERE LeagueId=$LeagueId AND CommishId=$UserId";
ExecuteSqlQuery($insertQuery, $SqlTime);

$T1Id = $_POST['T1Id'];
$T2Id = $_POST['T2Id'];
$T3Id = $_POST['T3Id'];
$T4Id = $_POST['T4Id'];
$T5Id = $_POST['T5Id'];
$T6Id = $_POST['T6Id'];
$T7Id = $_POST['T7Id'];
$T8Id = $_POST['T8Id'];
$T9Id = $_POST['T9Id'];
$T10Id = $_POST['T10Id'];
$T11Id = $_POST['T11Id'];
$T12Id = $_POST['T12Id'];

If($T2Id == "NULL" ){
    $insertQuery = "UPDATE fantdraft SET Team1=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id);
}
else If($T3Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id);
}
else If($T4Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id);
}
else If($T5Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id);
}
else If($T6Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id);
}
else If($T7Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id);
}
else If($T8Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id);
}
else If($T9Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=?,Team8=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id,$T8Id);
}
else If($T10Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=?,Team8=?,Team9=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id,$T8Id,$T9Id);
}
else If($T11Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=?,Team8=?,Team9=?,Team10=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id,$T8Id,$T9Id,$T10Id);
}
else If($T12Id=="NULL"){
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=?,Team8=?,Team9=?,Team10=?,Team11=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id,$T8Id,$T9Id,$T10Id,$T11Id);
}
else
{
    $insertQuery = "UPDATE fantdraft SET Team1=?,Team2=?,Team3=?,Team4=?,Team5=?,Team6=?,Team7=?,Team8=?,Team9=?,Team10=?,Team11=?,Team12=? WHERE LeagueId=$LeagueId AND Yr=$DraftYear";
    ExecuteSqlQuery($insertQuery, $T1Id,$T2Id,$T3Id,$T4Id,$T5Id,$T6Id,$T7Id,$T8Id,$T9Id,$T10Id,$T11Id,$T12Id);
}
echo "<br>Updated";


?>
<script type="text/javascript">
setTimeout(function (){
  
    var LeagueId = <?php echo $LeagueId ?>;
        $.post("LeagueManagement.php", { LeagueId : LeagueId }, function(data){
            $("#Team").html(data);
    });

            
}, 2000);


</script>