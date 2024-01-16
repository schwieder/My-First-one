<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");


$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];


echo "Recruits set training budget, progression? Set max levels for each part?";
echo "<br> Block @ 100, D shot @ 10%, Goalie Max @0.950, Fwds @ 20%... Train as a team so it doesn't matter";
echo "<br><br> Training divided by 10, (10 weeks @ 5 games each?) divided by a set # (each $ gives you X amount of team training) <br>
and multiplied by their potential to see how much they get out of the points allocated.";
echo "<br> each 'B' player goes up 3 points/year. Each C goes up 2, D - 1, F - 0, A - 4, A+ - 5";
echo "<br> 3/10 = 0.3/advance, so at the start it needs to be 1/3 of that, b/c triaing starts at 1/5 3/5 gives you normal... 5/5 gives you 167% of normal";
echo "<br><br> How much do they get per season as a base... $10k? then the alumni starts to give $, what ever is below 65% 
<br> (penalized for taking dummies) takes away, what every is above 75% brings in $";
echo "<br><br> Things to improve - (Level squared, *5000) School, Training, Competitive - (last 5 seasons win% [win/losses - ties mean nothing] added up together";
echo "<br><br> recruits value proximity, competitive, school, training facilities, strength of alumni, anything else?
<br> (A+ intellegence will only go to 5, A to 4+, B to 3+, C to 1+)";
echo "<br> Recruits will have a pre-interest in each team.";
echo "<br><br> How do I run the AI of the computer? Always set as team B does this? Or Random? I'd prefer random... but I don't know how, yet"; 

