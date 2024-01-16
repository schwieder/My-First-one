<?php

	require_once("Header.php");
	$Inbox = "3";
?>


<html>
	<head>
		<title>Get States</title>
	</head>

		<body>

	<script type="text/javascript">
function Inbox()
{

	$.ajax({

			url:"9Inbox.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#inbox").html(show_students);

				}
			}

		});

}

function Create(){

	$.ajax({

			url:"9Create.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#create").html(show_students);

				}
			}

		});

}	
function Outbox(){

	$.ajax({

			url:"9Outbox.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#outbox").html(show_students);

				}
			}

		});

}
function Delbox(){

	$.ajax({

			url:"9Delbox.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Delbox").html(show_students);

				}
			}

		});

}

	$(document).ready(function(){
	$("#Delbox").hide();
	$("#InnerDelbox").hide();
	$("#inbox").hide();
	$("#create").hide();
	$("#InnerInbox").hide();
	$("#InnerCreate").hide();
	$("#outbox").hide();
	$("#InnerOutbox").hide();

		
		$(".Inbox").on('click', function(){
			$("#InnerInbox").hide();
			$("#InnerCreate").hide();
			$("#create").hide();
			$("#inbox").show();
			$("#outbox").hide();
			$("#InnerOutbox").hide();
			$("#Delbox").hide();
			$("#InnerDelbox").hide();
			Inbox();
			
		});
		
		$(".Delbox").on('click', function(){
			$("#InnerInbox").hide();
			$("#InnerCreate").hide();
			$("#create").hide();
			$("#Delbox").show();
			$("#inbox").hide();
			$("#outbox").hide();
			$("#InnerOutbox").hide();
			$("#InnerDelbox").hide();
			Delbox();
			
		});

		$(".Create").on('click', function(){
			$("#InnerInbox").hide();
			$("#InnerCreate").hide();
			$("#create").show();
			$("#inbox").hide();
			$("#outbox").hide();
			$("#InnerOutbox").hide();
			$("#Delbox").hide();
			$("#InnerDelbox").hide();
			Create();
			
		});
		
		$(".Outbox").on('click', function(){
			$("#InnerInbox").hide();
			$("#InnerCreate").hide();
			$("#create").hide();
			$("#inbox").hide();
			$("#InnerOutbox").hide();
			$("#outbox").show();
			$("#Delbox").hide();
			$("#InnerDelbox").hide();
			Outbox();
			
		});

			
	});

</script>

	
<form method="post" action="Message.php">

	<div align="Center" id="Initial-Title">
	<br><br>
	<input type='button' rel="This" align="right" style="height:20px;width:300px;" class='btn btn-success Inbox' value='Inbox - <?php echo $Inbox; ?>'>
	<input type='button' rel="This" align="left" style="height:20px;width:300px;" class='btn btn-success Create' value='Create Trade'>	
	<input type='button' rel="This" align="left" style="height:20px;width:300px;" class='btn btn-success Outbox' value='Sent Mail'>	
	<input type='button' rel="This" align="left" style="height:20px;width:300px;" class='btn btn-success Delbox' value='Deleted Mail'>	
	

	</div>
	<br><br>
	<div id="InnerInbox" align="center">

	</div>
	<br><br><br>
	<div id="InnerDelbox" align="center">

	</div>
	<br><br><br>

	<div id="inbox" align="center">

	</div>
	<div id="Delbox" align="center">

	</div>

	<div id="create" align="center">

	</div>

	<div id="InnerCreate" align="center">

	</div>

	<div id="outbox" align="center">

	</div>
	<div id="InnerOutbox" align="center">

	</div>


</form>
	
</body>
</html>
</form>
			