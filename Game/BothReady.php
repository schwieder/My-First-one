<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');

    $game = "Game";
    $vs = 'vs';
    $Ready = 'Ready';
    $Choice = 'Choice';
    $Both = 'Both';
    $User1 = $_SESSION['UserId'];
    $User2 = $_POST['User2'];
    $PId = $_POST['PId'];
    $BId = $_POST['BId'];

    $Pitcher = ReadScalar(ExecuteSqlQuery("SELECT * FROM mlbplayers WHERE MLBId='$PId'"));
    $Batter = ReadScalar(ExecuteSqlQuery("SELECT * FROM mlbplayers WHERE MLBId='$BId'"));
    $Bat = $Batter['Bat'];
    $P1 = $Pitcher['Def'];
    $P2 = $Pitcher['Bat'];
    $P3 = $Pitcher['Speed'];

    if($User1 < $User2){$LowId = $User1; $HighId = $User2;}
    else if($User1 > $User2){$LowId = $User2; $HighId = $User1;}

    $Boths = $game.$LowId.$vs.$HighId.$Both;
    $Boths = $$Boths;
    $LowIdReady = $game . $LowId . $vs . $HighId. $LowId . 'Ready';
    $HighIdReady = $game . $LowId . $vs . $HighId. $HighId . 'Ready';
    $LowIdChoice = $game . $LowId . $vs . $HighId. $LowId . 'Choice';
    $HighIdChoice = $game . $LowId . $vs . $HighId. $HighId . 'Choice';
    $LowIdLineup = $game . $LowId . $vs . $HighId. $LowId . 'Lineup';
    $HighIdLineup = $game . $LowId . $vs . $HighId. $HighId . 'Lineup';
    
    echo "LowIdChoice is ";
    echo $$LowIdChoice;
    echo "HighIdChoice is ";
    echo $$HighIdChoice;
    echo "Bat is $Bat... p1 is $P1, P2 is $P2, P3 is $P3";

    if($$LowIdChoice == $$HighIdChoice)
    {
        if($$LowIdChoice == '1')
        {
            if($Bat > $P1)
            {
                //It's a hit, where does it go
                $Place = rand(1,6);
                $Catch = rand(1,6);
                if($Place == '6'){
                    //it's a homerun!
                }
                else{
                    if($Place == '1')
                    {

                    }
                }

            }
            else 
            {
                echo "321";
            }
        }        
        if($$LowIdChoice == '2')
        {
            if($Bat > $P2)
            {
                echo "123";
            }
            else 
            {
                echo "321";
            }
        }        
        if($$LowIdChoice == '3')
        {
            if($Bat > $P3)
            {
                echo "123";
            }
            else 
            {
                echo "321";
            }
        }        
    }
    else {
        echo "456";
    }

    if($Boths == '0' && $LowId == $User1)
    {
        $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
        $var = "<?php\n
        \n $$game$LowId$vs$HighId$Both = '1';
        \n ?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);
    }
    else if($Boths == '1' && $HighId == $User1)
    {
        $var_str = var_export(${$game . $LowId . $vs . $HighId}, true);
        $var = "<?php\n
        \n $$game$LowId$vs$HighId$Both = '0';
        \n $$game$LowId$vs$HighId$LowId$Ready = '0';
        \n $$game$LowId$vs$HighId$LowId$Choice = '0';
        \n $$game$LowId$vs$HighId$HighId$Ready = '0';
        \n $$game$LowId$vs$HighId$HighId$Choice = '0';
        \n ?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);        
    }

