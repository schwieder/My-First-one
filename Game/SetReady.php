<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');

    $game = "Game";
    $vs = 'vs';
    $Ready = 'Ready';
    $Choice = 'Choice';
    $User1 = $_SESSION['UserId'];
    $User2 = $_POST['User2'];
    $Pitch = $_POST['Pitch'];
    if($User1 < $User2){$LowId = $User1; $HighId = $User2;}
    else if($User1 > $User2){$LowId = $User2; $HighId = $User1;}

    $LowIdReady = $game . $LowId . $vs . $HighId. $LowId . 'Ready';
    $HighIdReady = $game . $LowId . $vs . $HighId. $HighId . 'Ready';
    if($LowId == $User1)
    {
        $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
        $var = "<?php\n
        \n $$game$LowId$vs$HighId$LowId$Ready = '$Ready';
        \n $$game$LowId$vs$HighId$LowId$Choice = '$Pitch';
        \n ?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);
    }
    else
    {
        $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
        $var = "<?php\n
        \n $$game$LowId$vs$HighId$HighId$Ready = '$Ready';
        \n $$game$LowId$vs$HighId$HighId$Choice = '$Pitch';
        \n ?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);
    }
    echo "Waiting for the other player";