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

    if($Player1Id !=0 && $Player2Id !=0 && $Player1Id == $Player2Id){echo "There was a player chosen twice";die;}
    else if($Player1Id !=0 && $Player3Id !=0 && $Player1Id == $Player3Id){echo "There was a player chosen twice";die;}
    else if($Player2Id !=0 && $Player3Id !=0 && $Player2Id == $Player3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id !=0 && $TradePlayer2Id !=0 && $TradePlayer1Id == $TradePlayer2Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id !=0 && $TradePlayer3Id !=0 && $TradePlayer1Id == $TradePlayer3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer2Id !=0 && $TradePlayer3Id !=0 && $TradePlayer2Id == $TradePlayer3Id){echo "There was a player chosen twice";die;}
    else if($TradePlayer1Id ==0 && $TradePlayer2Id ==0 && $TradePlayer3Id ==0 && $Player1Id ==0 && $Player2Id ==0 && $Player3Id ==0){echo "Nobody was chosen";}
    else if($Count != $TTCount){echo "The amount of players sent have to equal the amount players returned <br>(I don't want to check to see if there are empty spots on the teams yet... it's all still in Beta)";}
    else {
        $a=0;
        while($a < $Count)
        {
            //this part works
            $insertQuery = "UPDATE rosterchosen SET TeamId=$TeamId WHERE LeagueId=$LeagueId AND PlayerId=$TradeTeamPlayers[$a]";
            ExecuteSqlQuery($insertQuery);

            $insertQuery2 = "UPDATE rosterchosen SET TeamId=$TradeTeamId WHERE LeagueId=$LeagueId AND PlayerId=$Players[$a]";
            ExecuteSqlQuery($insertQuery2);
            
            $TeamSlot =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE TeamId = '$TeamId'")); //select all slots from flames
            $b=1;
            while($b<11)
            {
                $Slot = "Slot$b";
                if($TeamSlot[$Slot] == $Players[$a])
                {
                    $b=20;
                }
                else {$b++;}
            }
            $PId = $Players[$a];
                
            $TradeTeamSlot =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE TeamId = '$TradeTeamId'"));
            $c=1;
            while($c<11)
            {
                $TradeSlot = "Slot$c";
                if($TradeTeamSlot[$TradeSlot] == $TradeTeamPlayers[$a])
                {
                    $c=20;
                }
                else {$c++;}
            }

            $TPId = $TradeTeamPlayers[$a];
            $insertQuery = "UPDATE fantteams SET $TradeSlot=? WHERE TeamId = $TradeTeamId";
            ExecuteSqlQuery($insertQuery, $PId);
            $insertQuery = "UPDATE fantteams SET $Slot=? WHERE TeamId = $TeamId";
            ExecuteSqlQuery($insertQuery, $TPId);

            /////////////////////////////////////////////////////////////////////

            $StarterSlot =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE TeamId = '$TeamId'"));
            $b=1;
            while($b<7)
            {
                if($b == 1){$Slot='Qb';}else if($b == 2){$Slot='Rb';}else if($b == 3){$Slot='Wr1';}
                else if($b == 4){$Slot='Wr2';}else if($b == 5){$Slot='K';}else if($b == 6){$Slot='Flex';}
                if($StarterSlot[$Slot] == $Players[$a])
                {
                    $b=20;
                    $PId = $Players[$a];
                    $insertQuery = "UPDATE fantteamsstarters SET $Slot=? WHERE TeamId = $TeamId";
                    ExecuteSqlQuery($insertQuery, '0');
                }
                else {$b++;}
            }
                
            $TradeStarterSlot =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE TeamId = '$TradeTeamId'"));
            $b=1;
            while($b<7)
            {
                if($b == 1){$TradeSlot='Qb';}else if($b == 2){$TradeSlot='Rb';}else if($b == 3){$TradeSlot='Wr1';}
                else if($b == 4){$TradeSlot='Wr2';}else if($b == 5){$TradeSlot='K';}else if($b == 6){$TradeSlot='Flex';}
                if($TradeStarterSlot[$TradeSlot] == $TradeTeamPlayers[$a])
                {
                    $b=20;
                    $TPId = $TradeTeamPlayers[$a];
                    $insertQuery = "UPDATE fantteamsstarters SET $TradeSlot=? WHERE TeamId = $TradeTeamId";
                    ExecuteSqlQuery($insertQuery, '0');
                }
                else {$b++;}
            }



            $a++;
        }

        echo "Your trade proposal has been sent"; 
    }
