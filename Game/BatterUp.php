<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');

    $width = "150";
    $height = "107";

    $game = "Game";
    $vs = 'vs';
    $User1 = $_SESSION['UserId'];
    $User2 = $_POST['User2'];
    $arr = array();
    echo "this is field"; 

    /*
    if($User1 < $User2){$LowId = $User1; $HighId = $User2;}
    else if($User1 > $User2){$LowId = $User2; $HighId = $User1;}
    $GameArray = $game . $LowId . $vs . $HighId;
    $Turn = 'Turn';
    $turn = $game.$LowId.$vs.$HighId.'Turn';
    $WhosActualTurn = $$turn;
    $LowIdLineup = $game . $LowId . $vs . $HighId. $LowId . 'Lineup';
    $HighIdLineup = $game . $LowId . $vs . $HighId. $HighId . 'Lineup';
    $LastUpdated = $game . $LowId . $vs . $HighId. 'Update';
    $Chosen =  "Chosen";
    $Chose = $game . $LowId . $vs . $HighId . $Chosen;


    \n $$LastUpdated = '$date'; 
    \n $$game$LowId$vs$HighId = $var_str; 
    \n $$game$LowId$vs$HighId$Chosen = 0; 
    \n $$game$LowId$vs$HighId$turn = $LowId; 
    \n $$LowIdLineup = array(); 
    \n $$HighIdLineup = array(); 
    \n $$game$LowId$vs$HighId$inning = 1;
    \n $$game$LowId$vs$HighId$TopBot = $Top;
    \n $$game$LowId$vs$HighId$HScore = 0;
    \n $$game$LowId$vs$HighId$AScore = 0;
    \n $$game$LowId$vs$HighId$Outs = 0;
    \n $$game$LowId$vs$HighId$Strikes = 0;
    \n $$game$LowId$vs$HighId$LowId$AtBat = 0;
    \n $$game$LowId$vs$HighId$HighId$AtBat = 0;


*/

    echo "Game Time!!";

?>
<script>
    clearInterval(Checking);
    score();
    cards();
    BP();

    function score() {
        var User2 = <?php echo $User2; ?>;
        $.post("Score.php", {User2: User2}, function(data){
            $("#Score").html(data);
        });
    }
    function cards() {
        var User2 = <?php echo $User2; ?>;
        $.post("cards.php", {User2: User2}, function(data){
            $("#Field").html(data);
        });
    }
    function BP() {
        var User2 = <?php echo $User2; ?>;
        $.post("BatPitch.php", {User2: User2}, function(data){
            $("#BatPitch").html(data);
        });
    }

</script>