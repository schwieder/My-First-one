<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$UserId = $_SESSION['UserId']; 

If($UserId != 3){die;}
$Week = ReadScalar(ExecuteSqlQuery("SELECT CurrentWeek FROM fantweek"));

/////////////////////////////first/////////////////////////////////////

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);

////////////     Things to change from week to week      //////////////////////////
// email to send to - sheetsphp@myfirstphpandsheets.iam.gserviceaccount.com 
// Remember to delete the stuff that isn't filled in (no empty games) from all stats
$spreadsheetId = "1NXtibYL9vKZFDqttQ9XuN13tYuphY_t4cDUAI7CWhfk";

//    Passing     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!B2:F300";
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
            $Yds = $row[1];
            $Tds = $row[2];
            $Ints = $row[3];
            $Team = $row[4];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo "sql = $sql";
            echo $Name;
            echo $Team;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $PY = $ros['PassYds'] + $Yds;
                $PT = $ros['PassTds'] + $Tds;
                $PI = $ros['Ints'] + $Ints;
                $insertQuery = "UPDATE roster SET PassYds='$PY',PassTds='$PT',Ints='$PI' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}

//    Rushing     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!I2:L250";
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
            $Yds = $row[1];
            $Tds = $row[2];
            $Team = $row[3];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $Y = $ros['RushYds'] + $Yds;
                $T = $ros['RushTds'] + $Tds;
                $insertQuery = "UPDATE roster SET RushYds='$Y',RushTds='$T' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}


//    Receiving     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!U2:X500";
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
            $Yds = $row[1];
            $Tds = $row[2];
            $Team = $row[3];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $Y = $ros['RecYds'] + $Yds;
                $T = $ros['RecTds'] + $Tds;
                $insertQuery = "UPDATE roster SET RecYds='$Y',RecTds='$T' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}


//    Kicking     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!Z2:AB100";
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
            $Pts = $row[1];
            $Team = $row[2];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $P = $ros['KickPts'] + $Pts;
                $insertQuery = "UPDATE roster SET KickPts='$P' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}


//    KOR     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!AE2:AH220";
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
            $Yds = $row[1];
            $Tds = $row[2];
            $Team = $row[3];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $Y = $ros['KORYds'] + $Yds;
                $T = $ros['KORTds'] + $Tds;
                $insertQuery = "UPDATE roster SET KORYds='$Y', KORTds='$T' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}

//    PR     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!AK2:AN220";
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
            $Yds = $row[1];
            $Tds = $row[2];
            $Team = $row[3];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $Y = $ros['PRYds'] + $Yds;
                $T = $ros['PRTds'] + $Tds;
                $insertQuery = "UPDATE roster SET PRYds='$Y', PRTds='$T' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}

//    Fumbles     ///////////////////////////////////////////////////////////////////////////////////////////////////////
$range = "AllStats!O2:R300";
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
            $Fum = $row[1];
            $FumLost = $row[2];
            $Team = $row[3];
            $Name = str_replace(" ", '', $Name);
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            echo $Name;
            $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE Name='$Name' && Team='$Team'"));
            if($ros != NULL){
                $Pos=$ros['Pos'];
                $PId=$ros['PlayerId'];
                $F = $ros['Fumbles'] + $Fum;
                $FL = $ros['FumblesLost'] + $FumLost;
                $insertQuery = "UPDATE roster SET Fumbles='$F', FumblesLost='$FL' WHERE Name='$Name' && Team='$Team'";
                ExecuteSqlQuery($insertQuery);
            }
            echo "<br>";
        }
    }
}


echo "This works";





