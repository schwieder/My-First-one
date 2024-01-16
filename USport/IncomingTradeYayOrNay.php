<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
    $TradeId =  $_POST['TradeId'];
    $Result =  $_POST['result'];

    If($Result == "Decline")
    {
        $insertQuery = "UPDATE fanttrades SET Approved=? WHERE Id = $TradeId";
        ExecuteSqlQuery($insertQuery, 'N');
        echo "The trade has been declined."; 
    }
    else If($Result == "Approve")
    {

        $Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM fanttrades WHERE Id = '$TradeId';"));

        $TeamId = $Info['Team1']; //flames
        $TradeTeamId = $Info['Team2']; //leafs
        $Player1Id = $Info['Send1']; //Giving up (Joseph)
        $Player2Id = $Info['Send2'];
        $Player3Id = $Info['Send3'];
        $TradePlayer1Id = $Info['Get1']; // getting (Philpot)
        $TradePlayer2Id = $Info['Get2'];
        $TradePlayer3Id = $Info['Get3'];
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

        $insertQuery = "UPDATE fanttrades SET Approved=? WHERE Id = $TradeId";
        ExecuteSqlQuery($insertQuery, 'Y');

        echo "The trade has been approved. Make sure your starting lineup is set properly."; 
    }
