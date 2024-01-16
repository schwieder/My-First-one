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
// Remember to delete the stuff that isn't filled in (no empty games) from all stats

$Week = 5;
$spreadsheetId = "1QQ4ORAbXgY9WDHqkaLbUCdBIRZpKM4Kf028qYEPJa-U";

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
                echo "Not found! Player Id = $PId";
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, PassYds, PassTds, Ints) VALUES(?,?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Yds, $Tds, $Ints);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos',PassYds='$Yds',PassTds='$Tds',Ints='$Ints' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, RushYds, RushTds) VALUES(?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Yds, $Tds);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', RushYds='$Yds', RushTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, RecYds, RecTds) VALUES(?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Yds, $Tds);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', RecYds='$Yds', RecTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, KickPts) VALUES(?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Pts);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', KickPts='$Pts' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, KORYds, KORTds) VALUES(?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Yds, $Tds);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', KORYds='$Yds', KORTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, PRYds, PRTds) VALUES(?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Yds, $Tds);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', PRYds='$Yds', PRTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
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
            }
            else{
                $Pos='UnKnown';
                $PId=0;
                echo "Wtf??";
                die;
            }
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, PlayerId, Name, Pos, Team, Fumbles, FumblesLost) VALUES(?,?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week,$PId, $Name, $Pos, $Team, $Fum, $FumLost);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET Pos='$Pos', Fumbles='$Fum', FumblesLost='$FumLost' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
            }
            echo "<br>";
        }
    }
}


echo "This works";


?>
