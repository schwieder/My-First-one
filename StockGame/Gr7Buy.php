<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	$Grade = $_SESSION['Grade'];
	if($Grade != "7"){ echo "You're not in Gr 7, if you are please contact the administrator"; die; }

	$StockId = $_POST['StockId'];
	$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks7 WHERE StockId ='$StockId'"));
	$StockName = $Stock['Company'];
	$StockPrice = $Stock['PrevPrice'];
	$Money = $_SESSION['Money'];
	
	$StockMax = floor(($Money)/$StockPrice);

	echo "How many $StockName would you like to buy at $StockPrice?" 
	?><br><?php
	echo "(It is free to buy stocks, but will cost $25 to sell any amount of stock, doesn't matter if it's 1 or 1,000. <br> Max is: $StockMax shares)";
	?>
	<br><br><?php
	echo "<input type='number' id='amount' class='form-control amount' name='amount' placeholder='amount' required>";
	?><br><?php
	echo '<input type="button" id="'.$StockId.'" name="submit" class="btn btn-success submit" value="submit">';
	?><br><?php

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Submit").on('click', function(){			
			var StockId = $(this).attr("id");
			var amount = $('input[id="amount"]').val();
			if($('#amount').val() == ''){
				alert('Amount can not be left blank');
			}
			else{
				$.post("Gr7BuyExecute.php", {amount : amount, StockId : StockId}, function(data){
					$("#Chart").html(data);
				});
			}
		});
	});

</script>

