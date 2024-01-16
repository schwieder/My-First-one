<?php

//////////////////////send the first part into trades (both need to see, and both need to delete... if player is offered somewhere, you can't offer him again), put the second (the updating part) into accepted

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
    $TeamId = $_POST['TeamId']; //flames
    $TradeTeamId = $_POST['TradeTeamId']; //leafs
    $Player1Id = $_POST['Player1Id']; //Giving up (Joseph)
    $TradePlayer1Id = $_POST['TradePlayer1Id']; // getting (Philpot)
    $Player2Id = $_POST['Player2Id'];
    $TradePlayer2Id = $_POST['TradePlayer2Id'];
    $Player3Id = $_POST['Player3Id'];
    $TradePlayer3Id = $_POST['TradePlayer3Id'];
    $Players =[];
    $TradeTeamPlayers= [];
    $PlayersOriginal =[];
    $TradeTeamPlayersOriginal= [];
    $Msg = $_POST['msg'];
    array_push($Players, $Player1Id, $Player2Id, $Player3Id);
    array_push($TradeTeamPlayers, $TradePlayer1Id, $TradePlayer2Id, $TradePlayer3Id);

    $Players = \array_filter($Players, static function ($element) {
        return $element !== "0";
    });
    array_values($Players);

    $TradeTeamPlayers = \array_filter($TradeTeamPlayers, static function ($element) {
        return $element !== "0";
    });
    array_values($TradeTeamPlayers);
    $Count = count($Players);
    $TTCount = count($TradeTeamPlayers);

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fanttrades WHERE Team1 = '$TeamId' && Approved = 'P'")) as $row)
    {
        if($Player1Id == $row['Send1'] || $Player1Id == $row['Send2'] || $Player1Id == $row['Send3']){
            $N = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$Player1Id'"));
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo "You can only offer $Name to one team at a time. You can decline the other trade in 'Incoming Trades'"; die;}
        else if($Player2Id == $row['Send1'] || $Player2Id == $row['Send2'] || $Player2Id == $row['Send3']){
            $N = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$Player2Id'"));
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo "You can only offer a player to one team at a time. You can decline the other trade in 'Incoming Trades'"; die;}
        else if($Player3Id == $row['Send1'] || $Player3Id == $row['Send2'] || $Player3Id == $row['Send3']){
            $N = ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$Player3Id'"));
            $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $N);
            echo "You can only offer a player to one team at a time. You can decline the other trade in 'Incoming Trades'"; die;}
    }


    if($Player1Id !=0 && $Player2Id !=0 && $Player1Id == $Player2Id){echo "There was a player chosen twice";die;}
    else if($Player1Id !=0 && $Player3Id !=0 && $Player1Id == $Player3Id){echo "There was a player chosen twice";die;}
    else if($Player2Id !=0 && $Player3Id !=0 && $Player2Id == $Player3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id !=0 && $TradePlayer2Id !=0 && $TradePlayer1Id == $TradePlayer2Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id !=0 && $TradePlayer3Id !=0 && $TradePlayer1Id == $TradePlayer3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer2Id !=0 && $TradePlayer3Id !=0 && $TradePlayer2Id == $TradePlayer3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id ==0 && $TradePlayer2Id ==0 && $TradePlayer3Id ==0 && $Player1Id ==0 && $Player2Id ==0 && $Player3Id ==0){echo "Nobody was chosen";}
    else if($Count != $TTCount){echo "The amount of players sent have to equal the amount players returned <br>(I don't want to check to see if there are empty spots on the teams yet... it's all still in Beta)";}
    else {

        $insertQuery = "INSERT INTO fanttrades SET Team1=?, Team2=?, Send1=?,Send2=?,Send3=?,Get1=?,Get2=?,Get3=?,Messages=?";
        ExecuteSqlQuery($insertQuery, $TeamId, $TradeTeamId, $Player1Id, $Player2Id, $Player3Id, $TradePlayer1Id, $TradePlayer2Id, $TradePlayer3Id,$Msg);
    
        echo "Your trade proposal has been sent"; 
    }
