<?php

	require_once("Header.php");
	
	$error = "";

?>
	<html>
<head>
<title>Page Title</title>
</head>
<body>




<script type="text/javascript">
function Gr4()
{

	$.ajax({

			url:"Gr4Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr5()
{

	$.ajax({

			url:"Gr5Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr7()
{

	$.ajax({

			url:"Gr7Update.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}

$(document).ready(function(){

<?php

if($Grade == "4"){
?>
	Gr4();
<?php
}
else if($Grade == "5"){
?>
	Gr5();
<?php
}
else if($Grade == "7"){
?>
	Gr7();
<?php
}
else {
?>

<?php
}
?>

});



// Set the date we're counting down to
var countDownDate = new Date("<?php echo $NextAdvance;?>").getTime() + (2* 24 * 3600 * 1000);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
	location.href = "www.yoursite.com";
  }
  
}, 1000);


</script>


<br>
<h1 align=center>Instructions - PLEASE READ!!!!	</h1>
<p id="demo"  align=center>
	This is where it goes?
</p>
<p id="Research"  align=center>
	Advance?
</p>

<p align=center>

	Please ensure that you know the following Ratios:
	<br><br>
	Gr 4 - <a href="https://www.investopedia.com/terms/p/price-earningsratio.asp">PE</a>
	<br>
	Gr 5 - <a href="https://www.investopedia.com/terms/p/pegratio.asp">PEG</a>
	<br>
	Gr 7 - <a href="https://www.investopedia.com/terms/p/pegratio.asp">PEG</a>,
	 <a href="https://www.investopedia.com/terms/q/quickratio.asp">Quick</a>,
	 <a href="https://www.investopedia.com/terms/c/currentratio.asp">Current</a>, 
	 <a href="https://www.investopedia.com/terms/d/debtratio.asp">Debt</a>, 
	 <a href="https://www.investopedia.com/terms/d/debtequityratio.asp">Debt to Equity</a>, and 
	 <a href="https://www.investopedia.com/terms/t/tie.asp">TIE</a>
	<br><br>
	<H3 align=center>Remember not to guess</h3> <p align=center>use the Math to find out the best choices,<br>that other investors are irrational and may mess with the market a bit, and finally<br>it's better to diversify than to put all your money into one stock! </p>
<?php
if ($Grade == "4")
{
	?>
<br>
<br>
<a href="Gr4Research.php"  > Research </a>
<br>
<br>
<a href="Gr4BuySell.php"  > Buy and Sell </a>

<?php
}
?>
</p>

</body>
</html>

<script type="text/javascript">

</script>

