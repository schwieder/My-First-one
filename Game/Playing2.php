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
    $LastUpdated = $game . $LowId . $vs . $HighId. 'Update';
    $Chosen =  "Chosen";
    $Chose = $game . $LowId . $vs . $HighId . $Chosen;
    $Ch = $$Chose;
    
    $InFielders = array();
    $OutFielders = array();
    $Pitchers = array();
    if($$turn == $LowId)
    {
        if($User1==$LowId)
        {$YouThey = "you";}
        else if($User1!=$LowId)
        {$YouThey = "they";}
        
        foreach ($$LowIdLineup as $o) 
        {
            $OMLBId = $o['MLBId'];
            if($OMLBId < 153)
            {
                array_push($InFielders,$OMLBId);
            }
            else if($OMLBId > 152 && $OMLBId < 243)
            {
                array_push($OutFielders,$OMLBId);
            }
            else if($OMLBId > 242)
            {
                array_push($Pitchers,$OMLBId);
            }
        }
    }
    else if($$turn == $HighId)
    {
        if($User1==$HighId)
        {$YouThey = "you";}
        else if($User1!=$HighId)
        {$YouThey = "they";}

        foreach ($$HighIdLineup as $o) 
        {
            $OMLBId = $o['MLBId'];
            if($OMLBId < 153)
            {
                array_push($InFielders,$OMLBId);
            }
            else if($OMLBId > 152 && $OMLBId < 243)
            {
                array_push($OutFielders,$OMLBId);
            }
            else if($OMLBId > 242)
            {
                array_push($Pitchers,$OMLBId);
            }
        }
    }

$CIf = count($InFielders);
$COf =  count($OutFielders);
$CPi =  count($Pitchers);
echo "<br>";
echo "<br>";
$RemainInField = 3 - $CIf;
$RemainOutField = 2 - $COf;
$RemainPitch = 2 - $CPi;

echo "Please Remeber $YouThey can only choose $RemainInField infielders, $RemainOutField outfielders, and $RemainPitch pitchers.";

    if(isset($$GameArray))
    {
        $arr = $$GameArray;

        if(isset($_POST['val']))
        {
            $val = $_POST['val'];
            $PId = $_POST['PId'];

            if($$turn == $LowId)
            {
                if($PId < 153)
                {
                    if( $CIf < 3)
                    {
                        array_push($$LowIdLineup,$arr[$val]);
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many infielders.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                    }
                }
                else if($PId > 152 && $PId < 243)
                {
                    if ($COf  < 2)
                    {
                        array_push($$LowIdLineup,$arr[$val]);
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many outfielders.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                    }
                }
                else if($PId > 242)
                {
                    if($CPi < 2)
                    {
                        array_push($$LowIdLineup,$arr[$val]);
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many Pitchers.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $HighId;
                        $WhosActualTurn = $turn;
                    }
                }
            }
            else if($$turn == $HighId)
            {
                $InFielders = array();
                $OutFielders = array();
                $Pitchers = array();
                foreach ($$HighIdLineup as $o) 
                {
                    $OMLBId = $o['MLBId'];
                    if($OMLBId < 153)
                    {
                        array_push($InFielders,$OMLBId);
                    }
                    else if($OMLBId > 152 && $OMLBId < 243)
                    {
                        array_push($OutFielders,$OMLBId);
                    }
                    else if($OMLBId > 242)
                    {
                        array_push($Pitchers,$OMLBId);
                    }
                }
                if($PId < 153)
                {
                    $CIf = count($InFielders);
                    if( $CIf < 3)
                    {
                        array_push($$HighIdLineup,$arr[$val]);
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many infielders.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                    }
                }
                else if($PId > 152 && $PId < 243)
                {
                    $COf =  count($OutFielders);
                    if ($COf  < 2)
                    {
                        array_push($$HighIdLineup,$arr[$val]);
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many outfielders.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                    }
                }
                else if($PId > 242)
                {
                    $CPi =  count($Pitchers);
                    if($CPi < 2)
                    {
                        array_push($$HighIdLineup,$arr[$val]);
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                        unset($arr[$val]); 
                        $arr = array_values($arr);
                        $Ch = $$Chose+1;
                    }
                    else
                    {
                        $message = "Could not be added, you have too many Pitchers.";
                        echo "<script type='text/javascript'>alert('$message');</script>";                
                        $turn = $LowId;
                        $WhosActualTurn = $turn;
                    }
                }
            }

            array_multisort( array_column($$LowIdLineup, "MLBId"), SORT_ASC, $$LowIdLineup );
            array_multisort( array_column($$HighIdLineup, "MLBId"), SORT_ASC, $$HighIdLineup );

            $date = date('m/d/Y h:i:s');
            ${$game . $LowId . $vs . $HighId} = $arr;
            $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
            $LArr = var_export($$LowIdLineup, true);
            $HArr = var_export($$HighIdLineup, true);
            $var = "<?php\n\n\$$game$LowId$vs$HighId = $var_str; \n $$game$LowId$vs$HighId$Chosen = $Ch; \n $$LastUpdated = '$date'; \n $$LowIdLineup = $LArr; \n $$HighIdLineup = $HArr; \n $$game$LowId$vs$HighId$Turn = $turn; \n\n?>";
            file_put_contents("init.php",$var . "\n\n",FILE_APPEND);
        }

        echo "<br><br>";
        if($WhosActualTurn != $User1)
        {
            echo "Please wait for your opponent to select their player";
        }
        else {
            $no = 0;
        
            foreach($arr as $player)
            {
                $img = $player['img'];
                $Id = $player['MLBId'];
                echo '<img id="'.$Id.'" src="'.$img.'" width="'.$width.'" height="'.$height.'" style="margin: 0px 8px; opacity: 1;" alt="'.$no.'" onclick="clicking(this)">';
                $no++;
                if($no%5 == 0){echo "<br><br>";}
            }
            
        }
        
    }
    else{
        echo "you shouldn't be here";
        die;
    }




?>
<script>
        Ch = "<?php echo $$Chose; ?>";
        if(Ch == 14)
        {
            ChIs14();
        }

        lastUpdated = "<?php echo $$LastUpdated; ?>";

        clearInterval(Checking);
		
		var Checking = setInterval(function CheckForChange()
		{
            onload="loaded=true;" >
            console.log('checking');
			$.ajax({
				url: "<?php echo 'Get_TimeChange_Changes.php?LowId='.$LowId.'&HighId='.$HighId.'&Timestamp='; ?>"+lastUpdated,
				type:"GET",
				dataType: 'json',
				success: function(result){

					if(result.error_msg) {
						alert(result.error_msg);
					}
					else
					{
						emptyclicked();
                    }
				},
//			error: function (xhr, ajaxOptions, thrownError) {
//				alert(xhr.status);
//				alert(thrownError);
//			  }
	
			});
		}, 1000);


        function clicking(e) {
            var User2 = <?php echo $User2; ?>;
            var PId = e.id;
            var val = e.alt;
            $.post("Playing2.php", {User2: User2, val: val, PId: PId}, function(data){
                    $("#Profile").html(data);
                });
        }
        function emptyclicked() {
            var User2 = <?php echo $User2; ?>;
            $.post("Playing2.php", {User2: User2}, function(data){
                    $("#Profile").html(data);
                });
        }
        function ChIs14() {
            var User2 = <?php echo $User2; ?>;
            $("#Result").show();
            $("#Game").show();
            $("#Score").show();
            $("#Field").show();
            $("#BatPitch").show();
            $("#Profile").hide();
            $.post("BatterUp.php", {User2: User2}, function(data){
                    $("#Field").html(data);
                });
        }

</script>

