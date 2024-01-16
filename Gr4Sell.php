<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	$Grade = $_SESSION['Grade'];
	$UserId = $_SESSION['UserId'];
	$Money = $_SESSION['Money'];
	if($Grade != "4"){ echo "You're not in Gr 4, if you are please contact the administrator"; die; }

	$StockId = $_POST['StockId'];
	$Trade = ReadScalar(ExecuteSqlQuery("SELECT * FROM trades WHERE CompanyId ='$StockId' AND UserId = $UserId"));
	$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks4 WHERE StockId ='$StockId'"));
	$StockName = $Stock['Company'];
	$StockPrice = $Stock['PrevPrice'];
	$Amount = $Trade['Amount'];

	echo "How many $StockName would you like to sell at $StockPrice?" 
	?><br><?php
	echo "(It cost $25 to sell any amount of stock, doesn't matter if it's 1 or 1,000. Max is: $Amount shares)";
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
				$.post("Gr4SellExecute.php", {amount : amount, StockId : StockId}, function(data){
					$("#Research").html(data);
				});
			}
		});
	});

</script>

