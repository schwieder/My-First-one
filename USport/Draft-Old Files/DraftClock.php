<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$DraftYear = 2022; // will also have to change this in League Creation and League Join2

$LastDrafted = '';
echo "123";
echo "<h3 id='demo'>Time taken:</h3>";
?>


<script>
    // Set the date we're counting down to
    var currentDate = new Date();
    var startingDate = new Date(currentDate.getTime());
    LastDrafted = "<?php echo $LastDrafted; ?>";
	TeamId = "<?php echo $TeamId; ?>";
	LeagueId = "<?php echo $LId; ?>";
	DraftYear = "<?php echo $DraftYear; ?>";

	$(document).ready(function(){
		setInterval(CheckForChangedCells, 1000
		);

		var remain = 120000;
		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get today's date and time
		var now = new Date().getTime();

		// Find the distance between now and the count down date
		var distance = now - startingDate;
		remain = distance;
		// Time calculations for days, hours, minutes and seconds
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Display the result in the element with id="demo"
		document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

		// If the count down is finished, write some text
		if (distance < 0) {
		document.getElementById("demo").innerHTML = "EXPIRED";
		//DoneDrafting()
        console.log("x");
		}
		}, 1000);


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
								clearInterval(x);
								console.log("My Team Id is");
								console.log(TeamId);
								console.log("New Team Id is");
								console.log(result.LastDrafted);
                            }
                            else
                            {
								clearInterval(x);
								console.log("My Team Id is");
								console.log(TeamId);
								console.log("New Team Id is");
								console.log(result.LastDrafted);
                            }
                        }
                        else
                        {
                            console.log("Sames");
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

