<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = 2022; // will also have to change this in League Creation and League Join2

echo "Draft Order<br>";
$DraftOrder = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId =$LId"));
$LastDrafted = $DraftOrder['Current'];
$T1 = $DraftOrder['Team1'];
$T2 = $DraftOrder['Team2'];
$T3 = $DraftOrder['Team3'];
$T4 = $DraftOrder['Team4'];
$T5 = $DraftOrder['Team5'];
$T6 = $DraftOrder['Team6'];
$T7 = $DraftOrder['Team7'];
$T8 = $DraftOrder['Team8'];
$T9 = $DraftOrder['Team9'];
$T10 = $DraftOrder['Team10'];
$T11 = $DraftOrder['Team11'];
$T12 = $DraftOrder['Team12'];

$T1Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T1"));
echo "1st - $T1Name  ";
if($T2 != NULL){
	$T2Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T2"));
	echo "  2nd - $T2Name";
}
if($T3 != NULL){
	$T3Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T3"));
	echo "  3rd - $T3Name";
}
if($T4 != NULL){
	$T4Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T4"));
	echo "  4th - $T4Name";
}
if($T5 != NULL){
	$T5Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T5"));
	echo "  5th - $T5Name";
}
if($T6 != NULL){
	$T6Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T6"));
	echo "  6th - $T6Name";
}
if($T7 != NULL){
	$T7Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T7"));
	echo "  7th - $T7Name";
}
if($T8 != NULL){
	$T8Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T8"));
	echo "  8th - $T8Name";
}
if($T9 != NULL){
	$T9Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T9"));
	echo "  9th - $T9Name";
}
if($T10 != NULL){
	$T10Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T10"));
	echo "  10th - $T10Name";
}
if($T11 != NULL){
	$T11Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T11"));
	echo "  11th - $T11Name";
}
if($T12 != NULL){
	$T12Name = ReadScalar(ExecuteSqlQuery("SELECT TeamName FROM fantteams WHERE TeamId =$T12"));
	echo "  12th - $T12Name";
}



?>


<script>
	LastDrafted = "5";
	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LId; ?>";
	DraftYear = "<?php echo $DraftYear; ?>";
	$(document).ready(function(){
		setInterval(CheckForChangedCells, 1000
		);
		function NotDrafting()
        {
				$.post("DraftButtons.php", { LeagueId : LeagueId, TeamId:TeamId}, function(data){
					$("#DraftButtons").html(data);
				});
				$("#DraftButtons").show();
		}
		NotDrafting();

		function WhosDrafting()
        {
				$.post("DraftDayWhos.php", { LeagueId : LeagueId, LastDrafted:LastDrafted}, function(data){
					$("#Team2").html(data);
				});
				$("#Team2").show();
		}

        function ImDrafting()
        {
            $.post("DraftDayImDrafting.php", { LeagueId : LeagueId, TeamId:TeamId, DraftYear:DraftYear }, function(data){
				$("#Team2").html(data);
			});
        }

		function CheckForChangedCells()
		{
			$.ajax({
				url: "<?php echo 'fetch.php?LId='.$LId.'&DraftYear='.$DraftYear.'&LastDrafted='.$LastDrafted.''; ?>",
				type:"GET",
				dataType: 'json',
				success: function(result){
                    if(result.error_msg) {
						alert(result.error_msg);
					}
					else
					{
                        if(LastDrafted != result.LastDrafted)
						{
                            LastDrafted = result.LastDrafted;
                            if(LastDrafted == TeamId)
                            {
								console.log("My Team Id is");
								console.log(TeamId);
								console.log("New Team Id is");
								console.log(result.LastDrafted);
                                ImDrafting();
                            }
                            else
                            {
								console.log("My Team Id is");
								console.log(TeamId);
								console.log("New Team Id is");
								console.log(result.LastDrafted);
                                WhosDrafting();
                            }
                        }
                        else
                        {
//                            console.log("Same");
                        }
					}
				},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			  }
	
			});
		}
	});
</script>

