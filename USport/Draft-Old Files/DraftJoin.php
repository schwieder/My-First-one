<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = 2022;
$LastDrafted = '';

$insertQuery = "UPDATE fantdraftstatus SET Ready='Y' WHERE TeamId=$TeamId";
ExecuteSqlQuery($insertQuery);

$insertQuery = "UPDATE fantdraft SET LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
ExecuteSqlQuery($insertQuery);


Echo "Joined";


?>
<script>

i=0;
a=0;
LastDrafted = "<?php echo $LastDrafted; ?>";
TeamId = "<?php echo $TeamId; ?>";
LeagueId = "<?php echo $LeagueId; ?>";
DraftYear = "<?php echo $DraftYear; ?>";
function Away() {
    $.post("DraftAway.php", {LeagueId:LeagueId,TeamId:TeamId, i:i}, function(data){
        $("#League").html(data);
    });
}
var x = setInterval(myFunction, 100);

function myFunction() {
  let text;
  if (document.hasFocus()) {
      i=0;
      if(i==0){a++;}
      if(a=1){Away();}
  } else {
        a=0;
        if(i==3000) //1200 is 5 min
        {
            Away();            
        }
        else if(i==6000) 
        {
            away()
            clearTimeout(x);
        }
        i++;
  }
document.getElementById("League").innerHTML;
}

function Drafting() {
			{   
                $("#Team").show();
                $("#League").hide();
				$.post("DraftDay.php", {TeamId:TeamId, LeagueId:LeagueId }, function(data){
					$("#Team").html(data);
				});
			}
}
function Clock() {
			{   
                $("#Team").show();
                $("#League").hide();
				$.post("DraftClock.php", {TeamId:TeamId, LeagueId:LeagueId }, function(data){
					$("#DraftClock").html(data);
				});
			}
}
Clock();
Drafting();

</script>

