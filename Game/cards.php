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

    if($User1 < $User2){$LowId = $User1; $HighId = $User2;}
    else if($User1 > $User2){$LowId = $User2; $HighId = $User1;}
    $GameArray = $game . $LowId . $vs . $HighId;
    $Turn = 'Turn';
    $turn = $game.$LowId.$vs.$HighId.'Turn';
    $WhosActualTurn = $$turn;
    $LowIdLineup = $game . $LowId . $vs . $HighId. $LowId . 'Lineup';
    $HighIdLineup = $game . $LowId . $vs . $HighId. $HighId . 'Lineup';

    if($$turn == 1)
    {
        $Cards = $$LowIdLineup;
    }
    else if($$turn == 2)
    {
        $Cards = $$HighIdLineup;
    }

    $no = 4;
    While($no > '-1')
    {
        $PlayerArray = $Cards[$no];
        if($no == 4){echo "Rolling a 6 = HomeRun!! <br>OutField<br>";}
        else if($no == 2){echo "Infield<br>";}
        $img = $PlayerArray['img'];
        $Id = $PlayerArray['MLBId'];
        $Num = $no+1;
        echo "$Num =";
        echo '<img id="'.$Id.'" src="'.$img.'" width="'.$width.'" height="'.$height.'" style="margin: 0px 8px; opacity: 1;" alt="'.$no.'">';
        $no=$no-1;
        if($no == 2){echo "<br>";}
        else if($no == -1){echo "<br>";}
    }

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