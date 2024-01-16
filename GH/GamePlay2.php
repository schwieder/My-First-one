<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    $Pos = $_SESSION['Pos'];
    $Zone = $_SESSION['Zone'];
    $PosNo = $_SESSION['PosNo'];
    $_SESSION['Count']++;
    $Count = $_SESSION['Count'];
    echo $Count;
    if($Count > 100){
        $H = $_SESSION['HScore'];
        $A = $_SESSION['AScore'];
    
        echo "<br><br>Washington: $H      Carolina: $A<br>";
    
        die;
    }
    $HId = $_POST['Id'];
    $AId = $PosNo;
    $HRoll = rand(1,6);
    $ARoll = rand(1,6);
    while($PosNo == $AId)
    {
        $AId =  rand(1,5);
    }

///////////////////// Washington //////////////////////
{
    $NameH1 = "Ovechkin"; $ScoreH1 = "5"; $PassH1 =  "4"; $DefH1 =   "4"; 
    $NameH2 = "Wilson"; $ScoreH2 = "4"; $PassH2 =  "4"; $DefH2 =   "4";
    $NameH3 = "Keznetsov"; $ScoreH3 = "4"; $PassH3 =  "4"; $DefH3 =   "4";
    $NameH4 = "Carlson"; $ScoreH4 = "5"; $PassH4 =  "5"; $DefH4 =   "3";
    $NameH5 = "Orlov"; $ScoreH5 = "4"; $PassH5 =  "4"; $DefH5 =   "4";
    $NameHG = "Vanecek"; $HGH1 =   "2"; $HGH2 =   "3"; $HGH3 =   "3"; $HGH4 =   "3"; $HGH5 =   "4";

}///////////////////////Carolina/////////////////
{
    $NameA1 = "Trocheck"; $ScoreA1 = "4"; $PassA1 =  "4"; $DefA1 =   "4";
    $NameA2 = "Aho"; $ScoreA2 = "4"; $PassA2 =  "4"; $DefA2 =   "4";
    $NameA3 = "Svechnikov"; $ScoreA3 = "4"; $PassA3 =  "4"; $DefA3 =   "4";
    $NameA4 = "DeAngelo"; $ScoreA4 = "4"; $PassA4 =  "4"; $DefA4 =   "5";
    $NameA5 = "Skjei"; $ScoreA5 = "4"; $PassA5 =  "4"; $DefA5 =   "4";
    $NameAG = "Raanta"; $AGH1 =   "1"; $AGH2 =   "3"; $AGH3 =   "3"; $AGH4 =   "3"; $AGH5 =   "3";
}

if($HId == $AId && $Pos == 'H')
{
    if($Zone == "A"){
        $rand = rand(1,5);
        $Name = "NameA$rand";
        echo "$NameAG with the glove save!! He passes it to ";
        echo $$Name;
        $_SESSION['Pos']='A';
        $_SESSION['PosNo']=$rand;
    }
    else if ($Zone == "N")
    {
        $D = "DefA$AId";
        $Name = "NameA$AId";
        echo $$Name;
        if($ARoll <= $D){
            echo "&nbsp stole the puck! Carolina's puck in the Neutral Zone. &nbsp";
            $_SESSION['Pos']='A';
            $_SESSION['PosNo']=$AId;
        }
        else{
            echo "&nbsp tried to steal the puck, but missed. Washington's puck in Carolina's Zone. &nbsp";
            $_SESSION['Zone']='A';
            $_SESSION['PosNo']=$HId;
        }
    }
    else if ($Zone == "H")
    {
        $D = "DefA$AId";
        $Name = "NameA$AId";
        echo $$Name;
        if($ARoll <= $D){
            echo "&nbsp stole the puck! Carolina steals the puck in the Washington Zone. &nbsp";
            $_SESSION['Pos']='A';
            $_SESSION['PosNo']=$AId;
        }
        else{
            echo "&nbsp tried to steal the puck, but missed. Washington's puck in the Neutral Zone. &nbsp";
            $_SESSION['Zone']='N';
            $_SESSION['PosNo']=$HId;
        }
    }
}
else if($HId == $AId && $Pos == 'A')
{
    if($Zone == "H"){
        $rand = rand(1,5);
        $Name = "NameH$rand";
        echo "$NameHG with the glove save!! He passes it to &nbsp";
        echo $$Name;
        $_SESSION['Pos']='H';
        $_SESSION['PosNo']=$rand;

    }
    else if ($Zone == "N")
    {
        $D = "DefH$HId";
        $Name = "NameH$HId";
        echo $$Name;
        if($HRoll <= $D){
            echo " stole the puck! Washington's puck in the Neutral Zone";
            $_SESSION['Pos']='H';
            $_SESSION['PosNo']=$HId;
        }
        else{
            echo " tried to steal the puck, but missed. Carolina's puck in Carolina's Zone";
            $_SESSION['Zone']='H';
            $_SESSION['PosNo']=$AId;
        }
    }
    else if ($Zone == "A")
    {
        $D = "DefH$HId";
        $Name = "NameH$HId";
        echo $$Name;
        if($HRoll <= $D){
            echo "&nbsp stole the puck! Washington steals the puck in the Carolina Zone. &nbsp";
            $_SESSION['Pos']='H';
            $_SESSION['PosNo']=$HId;
        }
        else{
            echo "&nbsp tried to steal the puck, but missed. Carolina's puck in the Neutral Zone. &nbsp";
            $_SESSION['Zone']='N';
            $_SESSION['PosNo']=$AId;
        }
    }
    
}
else if($HId != $AId && $Pos == 'H' && $Zone != "A")
{
    $P = "PassH$PosNo";
    $Name = "NameH$PosNo";
    $PassRecName = "NameH$HId";
    echo $$Name;
    if($HRoll <= $P){
        echo "&nbsp passes to ".$$PassRecName."!&nbsp";
        if($Zone == "H")
        {
            $_SESSION['Zone']='N';
            $_SESSION['PosNo']=$HId;
            echo "&nbsp Washington's puck in the Neutral Zone.&nbsp";
        }
        else if($Zone == "N")
        {
            $_SESSION['Zone']='A';
            $_SESSION['PosNo']=$HId;
            echo "&nbsp Washington's puck in Carolina's Zone.&nbsp";
        }
    }
    else{
        echo "&nbsp misses the pass to ".$$PassRecName."! It's turned over.&nbsp";
        $DefName = "NameA$HId";
        if($Zone == "N")
        {
            $_SESSION['Pos']='A';
            $_SESSION['PosNo']=$HId;
            echo "$DefName's puck in the Neutral Zone.&nbsp";
        }
        if($Zone == "H")
        {
            $_SESSION['Pos']='A';
            $_SESSION['PosNo']=$HId;
            echo "$DefName has a chance to shoot on net!&nbsp";
        }
    }
}
else if($HId != $AId && $Pos == 'A' && $Zone != "H")
{
    $P = "PassA$PosNo";
    $Name = "NameA$PosNo";
    $PassRecName = "NameA$AId";
    echo $$Name;
    if($ARoll <= $P){
        echo " Passes to ".$$PassRecName."!&nbsp";
        if($Zone == "A")
        {
            $_SESSION['Zone']='N';
            $_SESSION['PosNo']=$AId;
            echo "Carolina's puck in the Neutral Zone.&nbsp";
        }
        else if($Zone == "N")
        {
            $_SESSION['Zone']='H';
            $_SESSION['PosNo']=$AId;
            echo "Carolina's puck in Washington's Zone.&nbsp";
        }
    }
    else{
        echo " misses the pass to ".$$PassRecName."! It's turned over. &nbsp";
        $DefName = "NameH$AId";
        if($Zone == "N")
        {
            $_SESSION['Pos']='H';
            $_SESSION['PosNo']=$AId;
            echo "$DefName's puck in the Neutral Zone.&nbsp";
        }
        if($Zone == "A")
        {
            $_SESSION['Pos']='H';
            $_SESSION['PosNo']=$AId;
            echo "$DefName has a chance to shoot on net!&nbsp";
        }
    }
}
else if($HId != $AId && $Pos == 'H' && $Zone == "A")
{
    $S = "ScoreH$PosNo";
    $Name = "NameH$PosNo";
    echo $$Name;
    echo " shoots ";
    if($HRoll <= $$S){
        $Hole = "HGH$HId";
        if($ARoll <= $$Hole){
            echo "&nbspBut it's saved,&nbsp";
            $ReboundHome = rand(1,5);
            $ReboundAway = rand(1,5);
            if($ReboundAway >= $ReboundHome){
                $Name = "NameA$ReboundAway";
                echo $$Name;
                echo "&nbspgets the rebound and will try to get it out of the zone.&nbsp";
                $_SESSION['PosNo']=$HId;
                $_SESSION['Pos']='A';
            }
            else if($ReboundAway < $ReboundHome){
                $Name = "NameH$ReboundHome";
                echo $$Name;
                echo "&nbspgets the rebound and will keep the pressure on.&nbsp";
                $_SESSION['PosNo']=$HId;
            }
        }
        else{
            echo "AND SCORES!!!";
            $_SESSION['HScore']++;
            echo "<script>";
//            echo "sleep(5);";
//            echo "alert('SCORES!!!!');";
            echo "$.post('GamePlay.php', {}, function(data){
                $('#GamePlay').html(data);
            });";
            echo "</script>";
            die; 
        }
    }
    else{
        echo "&nbspBut he misses,&nbsp";
            $ReboundHome = rand(1,5);
            $ReboundAway = rand(1,5);
            if($ReboundAway >= $ReboundHome){
                $Name = "NameA$ReboundAway";
                echo $$Name;
                echo "&nbspgets the rebound and will try to get it out of the zone.&nbsp";
                $_SESSION['PosNo']=$HId;
                $_SESSION['Pos']='A';
            }
            else if($ReboundAway < $ReboundHome){
                $Name = "NameH$ReboundHome";
                echo $$Name;
                echo "&nbsp gets the rebound and will keep the pressure on. &nbsp";
                $_SESSION['PosNo']=$HId;
            }
    }
}
else if($AId != $HId && $Pos == 'A' && $Zone == "H")
{
    $S = "ScoreA$PosNo";
    $Name = "NameA$PosNo";
    echo $$Name;
    echo " shoots ";
    if($ARoll <= $$S){
        $Hole = "AGH$AId";
        if($HRoll <= $$Hole){
            echo "&nbsp but it's saved, &nbsp";
 
            $ReboundHome = rand(1,5);
            $ReboundAway = rand(1,5);
            if($ReboundHome >= $ReboundAway){
                $Name = "NameH$ReboundHome";
                echo $$Name;
                echo "&nbsp gets the rebound and will try to get it out of the zone. &nbsp";
                $_SESSION['PosNo']=$AId;
                $_SESSION['Pos']='H';
            }
            else if($ReboundHome < $ReboundAway){
                $Name = "NameA$ReboundAway";
                echo $$Name;
                echo "&nbsp gets the rebound and will keep the pressure on. &nbsp";
                $_SESSION['PosNo']=$AId;
            }
        }
        else{
            echo "AND SCORES!!!";
            $_SESSION['AScore']++;
            echo "<script>";
//                echo "alert('SCORES!!!!');";
                echo "$.post('GamePlay.php', {}, function(data){
                $('#GamePlay').html(data);
            });";
            echo "</script>";
            die; 
        }
    }
    else{
        echo "&nbsp but he misses, &nbsp";
            $ReboundHome = rand(1,5);
            $ReboundAway = rand(1,5);
            if($ReboundHome >= $ReboundAway){
                $Name = "NameH$ReboundHome";
                echo $$Name;
                echo "&nbsp gets the rebound and will try to get it out of the zone. &nbsp";
                $_SESSION['PosNo']=$AId;
                $_SESSION['Pos']='H';
            }
            else if($ReboundHome < $ReboundAway){
                $Name = "NameA$ReboundAway";
                echo $$Name;
                echo "&nbsp gets the rebound and will keep the pressure on. &nbsp";
                $_SESSION['PosNo']=$AId;
            }
    }
}

$Pos = $_SESSION['Pos'];
$Zone = $_SESSION['Zone'];
$PosNo = $_SESSION['PosNo'];

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
