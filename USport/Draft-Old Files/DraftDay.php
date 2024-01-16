<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = 2022; // will also have to change this in League Creation and League Join2

$LastDrafted = '';
echo "<h3>Time taken:</h3>";
echo "<h3 id='demo'>Time taken:</h3>";
?>


<script>
	LastDrafted = "<?php echo $LastDrafted; ?>";
	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LId; ?>";
	DraftYear = "<?php echo $DraftYear; ?>";
	$(document).ready(function(){
		setInterval(CheckForChangedCells, 1000
		);

//		function WhosDrafting()
//        {   
//				$.post("DraftDayWhos.php", { LeagueId : LeagueId, LastDrafted:LastDrafted, DraftYear:DraftYear }, function(data){
//					$("#Team").html(data);
//				});
//		}

//        function ImDrafting()
//        {
//            $.post("DraftDayImDrafting.php", { LeagueId : LeagueId, TeamId:TeamId, DraftYear:DraftYear }, function(data){
//					$("#Team").html(data);
//				});
//        }

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
                            console.log("Same");
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

