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
    $inning = "inning";
    $TopBot = "TopBot";
    $Turn = 'Turn';
    $AtBat = "AtBat";
    $turn = $game.$LowId.$vs.$HighId.'Turn';
    $WhosActualTurn = $$turn;
    $LowIdLineup = $game . $LowId . $vs . $HighId. $LowId . 'Lineup';
    $HighIdLineup = $game . $LowId . $vs . $HighId. $HighId . 'Lineup';
    
    $LowIdReady = $game . $LowId . $vs . $HighId. $LowId . 'Ready';
    $HighIdReady = $game . $LowId . $vs . $HighId. $HighId . 'Ready';
    $LowReady = $$LowIdReady;
    $HighReady = $$HighIdReady;

    $Inn = $game . $LowId . $vs . $HighId . $inning;
    $TopBottom = $game . $LowId . $vs . $HighId . $TopBot;

    if($$TopBottom == 'Top')
    {
        if($User1 = $HighId)
        {
            $GuessChoose = "Guess the pitch";
        }
        else
        {
            $GuessChoose = "Choose your pitch";
        }
        $Cards = $$LowIdLineup;
        //Top means it's Team 2 at bat, team 1 is pitching because they're at home.
        $Bat = $game . $LowId . $vs . $HighId . $HighId . $AtBat;
        if($$Bat == 0){$$Bat = 1;}
        $Batter = $$HighIdLineup[$$Bat];
        if($$Inn%2 == 0)
        {
            $Pitcher = $$LowIdLineup['6'];
            $PNo = 6;
        }
        else
        {
            $Pitcher = $$LowIdLineup['5'];
            $PNo = 5;
        }

    }
    else if($$TopBottom == 'Bot')
    {
        if($User1 = $HighId)
        {
            $GuessChoose = "Guess the pitch";
        }
        else
        {
            $GuessChoose = "Choose your pitch";
        }
        //Top means it's Team 1 at bat, team 2 is pitching because they're at home.
        $Cards = $$HighIdLineup;
        $Bat = $game . $LowId . $vs . $HighId . $LowId . $AtBat;
        if($$Bat == 0){$$Bat = 1;}
        $Batter = $$LowIdLineup[$$Bat];
        if($$Inn%2 == 0)
        {
            $Pitcher = $$HighIdLineup['6'];
            $PNo = 6;
        }
        else
        {
            $Pitcher = $$HighIdLineup['5'];
            $PNo = 5;
        }
    }

    $Pimg = $Pitcher['img'];
    $PId = $Pitcher['MLBId'];
    echo '<img id="'.$PId.'" src="'.$Pimg.'" width="'.$width.'" height="'.$height.'" style="margin: 0px 8px; opacity: 1;" onclick="clicking(this)">';
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo $GuessChoose;
    echo ";";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	echo '<button type="button" value="Continue" id=1 onclick="clicker(this)">Pitch 1</button>';
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	echo '<button type="button" value="Continue" id=2 onclick="clicker(this)">Pitch 2</button>';
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
	echo '<button type="button" value="Continue" id=3 onclick="clicker(this)">Pitch 3</button>';
    $Bimg = $Batter['img'];
    $BId = $Batter['MLBId'];
    echo '<img id="'.$BId.'" src="'.$Bimg.'" width="'.$width.'" height="'.$height.'" style="margin: 0px 8px; opacity: 1;" alt="'.$$Bat.'">';

?>
<script>
//    clearInterval(Checking);

clearInterval(Checking);

var Checking = setInterval(function CheckForChange()
{
    onload="loaded=true;" >
    console.log('Both?');
    $.ajax({
        url: "<?php echo 'Get_Button_Choices.php?LowId='.$LowId.'&HighId='.$HighId; ?>",
        type:"GET",
        dataType: 'json',
        success: function(result){

            if(result.error_msg) {
                alert(result.error_msg);
            }
            else
            {
                console.log('Both!!');
                Both();
            }
        },
//			error: function (xhr, ajaxOptions, thrownError) {
//				alert(xhr.status);
//				alert(thrownError);
//			  }

    });
}, 1000);

function clicker(e) {
                var User2 = <?php echo $User2; ?>;
                var Pitch = e.id;
                $.post("SetReady.php", {User2: User2, Pitch: Pitch}, function(data){
                        $("#Profile").html(data);
                });
            }
    function score() {
        var User2 = <?php echo $User2; ?>;
        $.post("Score.php", {User2: User2}, function(data){
            $("#Score").html(data);
        });
    }
    function Both() {
        var User2 = <?php echo $User2; ?>;
        var PId = <?php echo $PId; ?>;
        var BId = <?php echo $BId; ?>;
        alert("Re-set the BatPitch line 158... have to set BothReady so that it does the logic for batting and then sets the on base, how many bases, outs, if there are strikes, etc.");
//        $.post("BothReady.php", {User2: User2, PId:PId, BId:BId}, function(data){
//            $("#Result").html(data);
//        });
    }

</script>