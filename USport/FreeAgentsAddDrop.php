<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LId'];
    $Slot = $_POST['Slot'];
    $AddPId = $_POST['addPId'];
    $Action = $_POST['Action'];
    $TeamId =  ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM fantteams WHERE LeagueId = '$LeagueId' AND OwnerId = '$UserId';"));
    $PName =  ReadScalar(ExecuteSqlQuery("SELECT Name FROM roster WHERE PlayerId = '$AddPId';"));

    $insertQuery = "UPDATE fantteams SET $Slot=? WHERE OwnerId=$UserId AND LeagueId=$LeagueId";
    ExecuteSqlQuery($insertQuery, $AddPId);

    $insertQuery = "INSERT INTO rosterchosen SET LeagueId=?, TeamId=?,PlayerId=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, $TeamId, $AddPId);

    If($Action == "Drop")
    {
        $DropPId = $_POST['dropPId'];
        $insertQuery = "DELETE FROM rosterchosen WHERE LeagueId=$LeagueId AND TeamId=$TeamId AND PlayerId=$DropPId";
        ExecuteSqlQuery($insertQuery);
        $tradeIds = [];

        $a=1;
        $b=1;
        while($a<3)
        {
            $Team = "Team$a";
            while($b<7)
            {
                if($b==1){$Col="Send1";}
                else if($b==2){$Col="Send2";}
                else if($b==3){$Col="Send3";}
                else if($b==4){$Col="Get1";}
                else if($b==5){$Col="Get2";}
                else if($b==6){$Col="Get3";}
                foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fanttrades WHERE $Team = '$TeamId' && $Col = '$DropPId' && Approved = 'P' ")) as $chosen)
                {
                    array_push($tradeIds,$chosen['Id']);
                }
                $b++;
            }
            $a++;
        }
        $count = count($tradeIds);
        while($count>0)
        {
            $FT = $tradeIds['0'];
            $insertQuery = "UPDATE fanttrades SET Approved='N' WHERE Id=?";
            ExecuteSqlQuery($insertQuery, $FT);
            $tradeIds = array_diff($tradeIds, array($FT));
            $tradeIds = array_values($tradeIds);
            $count = count($tradeIds);
        }
    }
    $Name = preg_replace('/(?<!\ )[A-Z]/', ' $0', $PName);

    echo "You have added $Name to your roster";

