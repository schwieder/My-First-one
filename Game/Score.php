<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');

    $game = "Game";
    $vs = 'vs';
    $HScore = "HScore";
    $AScore = "AScore";
    $User1 = $_SESSION['UserId'];
    $User2 = $_POST['User2'];
    $arr = array();

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
    $HS = $game.$LowId.$vs.$HighId.$HScore;
    $HScores = $$HS;
    $AS = $game.$LowId.$vs.$HighId.$AScore;
    $AScores = $$AS;
    echo "<h1> Home: $HScores";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Balls: $AScores";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Strikes: $AScores";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Outs: $AScores";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Away: $AScores";

    echo "</h1><br>";

?>
<script>
//    clearInterval(Checking);

    function score() {
        var User2 = <?php echo $User2; ?>;
        $.post("Score.php", {User2: User2}, function(data){
            $("#Score").html(data);
        });
    }

</script>