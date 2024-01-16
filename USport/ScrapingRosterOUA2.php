<?php
// made by following https://www.youtube.com/watch?v=iTZyuszEkxI

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$UserId = $_SESSION['UserId'];
echo "User Id = $UserId";
if($UserId != 2){echo "You can't be here"; die;}

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);

////////////     Things to change from week to week      //////////////////////////
// email to send to - sheetsphp@myfirstphpandsheets.iam.gserviceaccount.com 
$spreadsheetId = "1l_AIoKbW7b0GmrTcvQHGo1BdHIHMT961fZKXVJ3JcRA";


//    Queens     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "Queens!D2:E120";
$Team = "Queens";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        $Name = $row[0];
        $Length = strlen($Name);
        if ($Length > 0)
        {
            $Name = str_replace("'", '', $Name);
            $Name = str_replace(" ", '', $Name);
            $Pos = $row[1];
            if(strtoupper($Pos) == "REC"){$Pos="WR";}
            else if($Pos == "K/P"){$Pos="K";}
            else if($Pos == "TE"){$Pos="REC";}
            else if(strtoupper($Pos) == "H"){$Pos="RB";}
            else if(strtoupper($Pos) == "FB"){$Pos="RB";}
            $insertQuery = "INSERT INTO roster(Name, Team, Pos) VALUES(?,?,?)";
            ExecuteSqlQuery($insertQuery, $Name, $Team, $Pos);
            echo "Insert";
            echo $Name;
            echo "<br>";
        }
    }
}

//    Toronto     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "Toronto!D2:E120";
$Team = "Toronto";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        $Name = $row[0];
        $Length = strlen($Name);
        if ($Length > 0)
        {
            $Name = str_replace("'", '', $Name);
            $Name = str_replace(" ", '', $Name);
            $Pos = $row[1];
            if(strtoupper($Pos) == "REC"){$Pos="WR";}
            else if($Pos == "K/P"){$Pos="K";}
            else if($Pos == "TE"){$Pos="REC";}
            else if(strtoupper($Pos) == "H"){$Pos="RB";}
            else if(strtoupper($Pos) == "FB"){$Pos="RB";}
            $insertQuery = "INSERT INTO roster(Name, Team, Pos) VALUES(?,?,?)";
            ExecuteSqlQuery($insertQuery, $Name, $Team, $Pos);
            echo "Insert";
            echo $Name;
            echo "<br>";
        }
    }
}
//    Ottawa     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "Ottawa!D2:E120";
$Team = "Ottawa";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        $Name = $row[0];
        $Length = strlen($Name);
        if ($Length > 0)
        {
            $Name = str_replace("'", '', $Name);
            $Name = str_replace(" ", '', $Name);
            $Pos = $row[1];
            if(strtoupper($Pos) == "REC"){$Pos="WR";}
            else if($Pos == "K/P"){$Pos="K";}
            else if($Pos == "TE"){$Pos="REC";}
            else if(strtoupper($Pos) == "H"){$Pos="RB";}
            else if(strtoupper($Pos) == "FB"){$Pos="RB";}
            $insertQuery = "INSERT INTO roster(Name, Team, Pos) VALUES(?,?,?)";
            ExecuteSqlQuery($insertQuery, $Name, $Team, $Pos);
            echo "Insert";
            echo $Name;
            echo "<br>";
        }
    }
}
//    Carleton     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "Carleton!D2:E120";
$Team = "Carleton";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)) {
    print "No data found.\n";
    echo "Skip";
} else {
    foreach ($values as $row) {
        $Name = $row[0];
        $Length = strlen($Name);
        if ($Length > 0)
        {
            $Name = str_replace("'", '', $Name);
            $Name = str_replace(" ", '', $Name);
            $Name = str_replace(",", '', $Name);
            $Pos = $row[1];
            if(strtoupper($Pos) == "REC"){$Pos="WR";}
            else if($Pos == "K/P"){$Pos="K";}
            else if($Pos == "TE"){$Pos="REC";}
            else if(strtoupper($Pos) == "H"){$Pos="RB";}
            else if(strtoupper($Pos) == "FB"){$Pos="RB";}
            $insertQuery = "INSERT INTO roster(Name, Team, Pos) VALUES(?,?,?)";
            ExecuteSqlQuery($insertQuery, $Name, $Team, $Pos);
            echo "Insert";
            echo $Name;
            echo "<br>";
        }
    }
}

//    York     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "York!D2:E120";
$Team = "York";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        $Name = $row[0];
        $Length = strlen($Name);
        if ($Length > 0)
        {
            $Name = str_replace("'", '', $Name);
            $Name = str_replace(" ", '', $Name);
            $Pos = $row[1];
            if(strtoupper($Pos) == "REC"){$Pos="WR";}
            else if($Pos == "K/P"){$Pos="K";}
            else if($Pos == "TE"){$Pos="REC";}
            else if(strtoupper($Pos) == "H"){$Pos="RB";}
            else if(strtoupper($Pos) == "FB"){$Pos="RB";}
            $insertQuery = "INSERT INTO roster(Name, Team, Pos) VALUES(?,?,?)";
            ExecuteSqlQuery($insertQuery, $Name, $Team, $Pos);
            echo "Insert";
            echo $Name;
            echo "<br>";
        }
    }
}


?>
