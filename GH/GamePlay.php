<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	$Pos = $_SESSION['Pos'];
    $_SESSION['Zone'] = "N";
    $Zone = $_SESSION['Zone'];
    $_SESSION['Count']++;
    $_SESSION['Count']++;
    $Count = $_SESSION['Count'];
    echo $Count;
    if($Count > 100){
        $H = $_SESSION['HScore'];
        $A = $_SESSION['AScore'];
    
        echo "<br><br>Washington: $H      Carolina: $A<br>";
    
        die;
    }
///////////////////// Washington //////////////////////
{
    $NameH1 = "Ovechkin"; $ScoreH1 = "5"; $PassH1 =  "4"; $DefH1 =   "4"; 
    $NameH2 = "Wilson"; $ScoreH2 = "4"; $PassH2 =  "4"; $DefH2 =   "4";
    $NameH3 = "Keznetsov"; $ScoreH3 = "4"; $PassH3 =  "4"; $DefH3 =   "4";
    $NameH4 = "Carlson"; $ScoreH4 = "5"; $PassH4 =  "5"; $DefH4 =   "3";
    $NameH5 = "Orlov"; $ScoreH5 = "4"; $PassH5 =  "4"; $DefH5 =   "4";
    $NameHG = "Vanecek"; $HGH1 =   "3"; $HGH2 =   "4"; $HGH3 =   "4"; $HGH4 =   "4"; $HGH5 =   "5";

}///////////////////////Carolina/////////////////
{
    $NameA1 = "Trocheck"; $ScoreA1 = "4"; $PassA1 =  "4"; $DefA1 =   "4";
    $NameA2 = "Aho"; $ScoreA2 = "4"; $PassA2 =  "4"; $DefA2 =   "4";
    $NameA3 = "Svechnikov"; $ScoreA3 = "4"; $PassA3 =  "4"; $DefA3 =   "4";
    $NameA4 = "DeAngelo"; $ScoreA4 = "4"; $PassA4 =  "4"; $DefA4 =   "5";
    $NameA5 = "Skjei"; $ScoreA5 = "4"; $PassA5 =  "4"; $DefA5 =   "4";
    $NameAG = "Raanta"; $AGH1 =   "1"; $AGH2 =   "4"; $AGH3 =   "4"; $AGH4 =   "4"; $AGH5 =   "4";
}

echo "<br><br><br>";
if($Pos = 'None'){
    $H = 0;
    $A = 0;
    While($H == $A)
    {
        $H = rand(1,5);
        $A = rand(1,5);
    }
    if($H>$A){
        $Pos = "H";
        $PosNo = $H;
        $_SESSION['PosNo'] = $H;
        echo "Washington Wins the faceoff. ";
        $Name = "NameH$H";
        echo $$Name;
        echo " has the puck";
        $_SESSION['Pos'] = "H";
    }
    else if($H<$A){
        $Pos = "A";
        $PosNo = $A;
        $_SESSION['PosNo'] = $A;
        echo "Carolina wins the faceoff. ";
        $Name = "NameA$A";
        echo $$Name;
        echo " has the puck";
        $_SESSION['Pos'] = "A";
    }
    echo "<br><br>";
}

/*
if($Pos == "H")
{
    If($Zone != "A"){
        echo "Who would you like to pass to?";
        echo "<br><br>";
        if($PosNo != '1'){echo '<input type="button" id="1" name="1" class="btn btn-success enter" value="'.$NameH1.'">&nbsp&nbsp';}
        if($PosNo != '2'){echo '<input type="button" id="2" name="2" class="btn btn-success enter" value="'.$NameH2.'">&nbsp&nbsp';}
        if($PosNo != '3'){echo '<input type="button" id="3" name="3" class="btn btn-success enter" value="'.$NameH3.'">&nbsp&nbsp';}
        if($PosNo != '4'){echo '<input type="button" id="4" name="4" class="btn btn-success enter" value="'.$NameH4.'">&nbsp&nbsp';}
        if($PosNo != '5'){echo '<input type="button" id="5" name="5" class="btn btn-success enter" value="'.$NameH5.'">&nbsp&nbsp';}
    }

}
else if($Pos == "A")
{
    If($Zone != "H")
    {
        echo "Who would you like to defend?";
        echo "<br><br>";
        if($PosNo != '1'){echo '<input type="button" id="1" name="1" class="btn btn-success enter" value="'.$NameA1.'">&nbsp&nbsp';}
        if($PosNo != '2'){echo '<input type="button" id="2" name="2" class="btn btn-success enter" value="'.$NameA2.'">&nbsp&nbsp';}
        if($PosNo != '3'){echo '<input type="button" id="3" name="3" class="btn btn-success enter" value="'.$NameA3.'">&nbsp&nbsp';}
        if($PosNo != '4'){echo '<input type="button" id="4" name="4" class="btn btn-success enter" value="'.$NameA4.'">&nbsp&nbsp';}
        if($PosNo != '5'){echo '<input type="button" id="5" name="5" class="btn btn-success enter" value="'.$NameA5.'">&nbsp&nbsp';}
    }

}
*/

?>
<script type="text/javascript">
$(document).ready(function () {
    yourFunction();
});
function yourFunction(){
    var Id = Math.floor(Math.random() * (6 - 0 + 1))
    $.post("GamePlay2.php", {Id:Id}, function(data){
        $("#GamePlay").html(data);
    });
}
</script>
