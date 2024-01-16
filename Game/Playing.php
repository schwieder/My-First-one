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
    $User2 = ReadScalar(ExecuteSqlQuery("SELECT Playing FROM users WHERE Id='$User1'"));
    $arr = array();
    echo "Loaded Playing";


    if($User1 < $User2){$LowId = $User1; $HighId = $User2;}
    else if($User1 > $User2){$LowId = $User2; $HighId = $User1;}
    $GameArray = $game . $LowId . $vs . $HighId;
    if(isset($$GameArray))
    {
        $arr = $$GameArray;
    }
    else
    {
        // hasn't been set yet, so need to choose X amount of players and put them into the array and go set it. and then push to roll?
        $InField = range(1, 152);
        shuffle($InField);
        $InF = array_slice($InField,0,6);

        $OutField = range(153, 242);
        shuffle($OutField);
        $OutF = array_slice($OutField,0,4);
    
        $Pitch = range(243, 302);
        shuffle($Pitch);
        $Pit = array_slice($Pitch,0,4);

        $i = 0;
        while($i <6)
        {
            $Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM mlbplayers WHERE MLBId='$InF[$i]'"));
            $Team = $Info['Team'];
            $Last = $Info['Last'];
            $Img = "pics/$Team/$Last.png";
            $Player = array('MLBId' => $Info['MLBId'], 'Team' => $Info['Team'], 'Name' => $Info['Last'], 'Pos' => $Info['Pos'], 'Def' => $Info['Def'], 'Bat' => $Info['Bat'], 'Speed' => $Info['Speed'], 'img' => $Img);

            array_push($arr,$Player);
            $i++;
        }
        $i = 0;
        while($i <4)
        {
            $Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM mlbplayers WHERE MLBId='$OutF[$i]'"));
            $Team = $Info['Team'];
            $Last = $Info['Last'];
            $Img = "pics/$Team/$Last.png";
            $Player = array('MLBId' => $Info['MLBId'], 'Team' => $Info['Team'], 'Name' => $Info['Last'], 'Pos' => $Info['Pos'], 'Def' => $Info['Def'], 'Bat' => $Info['Bat'], 'Speed' => $Info['Speed'], 'img' => $Img);

            array_push($arr,$Player);
            $i++;
        }
        $i = 0;
        while($i <4)
        {
            $Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM mlbplayers WHERE MLBId='$Pit[$i]'"));
            $Team = $Info['Team'];
            $Last = $Info['Last'];
            $Img = "pics/$Team/$Last.png";
            if($Last == "Kelly"){
                $Img = "pics/ARI/KellyM.png";
            }
            $Player = array('MLBId' => $Info['MLBId'], 'Team' => $Info['Team'], 'Name' => $Info['Last'], 'Pos' => $Info['Pos'], 'Def' => $Info['Def'], 'Bat' => $Info['Bat'], 'Speed' => $Info['Speed'], 'img' => $Img);

            array_push($arr,$Player);
            $i++;
        }

        $Chosen =  "Chosen";
        $LastUpdated = $game . $LowId . $vs . $HighId. 'Update';
        $date = date('m/d/Y h:i:s');
        $turn = "Turn";
        $inning = "inning";
        $TopBot = "TopBot";
        $Top = "Top";
        $HScore = "HScore";
        $AScore = "AScore";
        $Outs = "Outs";
        $Strikes = "Balls";
        $AtBat = "AtBat";
        $Ready = "Ready";
        $Choice = "Choice";
        $Both = "Both";
        $LowIdLineup = $game . $LowId . $vs . $HighId. $LowId . 'Lineup';
        $HighIdLineup = $game . $LowId . $vs . $HighId. $HighId . 'Lineup';
        $GameArray = $game . $LowId . $vs . $HighId;
        ${$game . $LowId . $vs . $HighId} = $arr;
        $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
        $var = "<?php\n
        \n $$LastUpdated = '$date'; 
        \n $$game$LowId$vs$HighId = $var_str; 
        \n $$game$LowId$vs$HighId$Chosen = 0; 
        \n $$game$LowId$vs$HighId$turn = $LowId; 
        \n $$LowIdLineup = array(); 
        \n $$HighIdLineup = array(); 
        \n $$game$LowId$vs$HighId$inning = 1;
        \n $$game$LowId$vs$HighId$TopBot = '$Top';
        \n $$game$LowId$vs$HighId$HScore = 0;
        \n $$game$LowId$vs$HighId$AScore = 0;
        \n $$game$LowId$vs$HighId$Outs = 0;
        \n $$game$LowId$vs$HighId$Strikes = 0;
        \n $$game$LowId$vs$HighId$LowId$AtBat = 0;
        \n $$game$LowId$vs$HighId$HighId$AtBat = 0;
        \n $$game$LowId$vs$HighId$LowId$Ready = 0;
        \n $$game$LowId$vs$HighId$HighId$Ready = 0;
        \n $$game$LowId$vs$HighId$LowId$Choice = 0;
        \n $$game$LowId$vs$HighId$HighId$Choice = 0;
        \n $$game$LowId$vs$HighId$Both = 0;
        \n ?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);

    }

    
    ?>
    <script>
    clicked(); 

    function clicked() {
        var User2 = <?php echo $User2; ?>;
        $.post("Playing2.php", {User2: User2}, function(data){
            $("#Profile").html(data);
        });
    }
    
    </script>
    
    
