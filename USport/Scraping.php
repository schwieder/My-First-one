<?php
// made by following https://www.youtube.com/watch?v=iTZyuszEkxI

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);

////////////     Things to change from week to week      //////////////////////////
// email to send to - sheetsphp@myfirstphpandsheets.iam.gserviceaccount.com 
$spreadsheetId = "1EM-mYboSEpmGP7OSI3UqntptB65XlsDYwEQEriylXIk";

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
            $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));
            if($sql == 0){
                $insertQuery = "INSERT INTO stats(Week, Name, Team, PassYds, PassTds, Ints) VALUES(?,?,?,?,?,?)";
                ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Yds, $Tds, $Ints);
                echo "Insert";
            }
            else{
                $insertQuery = "UPDATE stats SET PassYds='$Yds',PassTds='$Tds',Ints='$Ints' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                ExecuteSqlQuery($insertQuery);
                echo "Update";
            }
            echo $Name;
            echo "<br>";
        }
    }
}



?>
