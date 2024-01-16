<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$UserId = $_SESSION['UserId']; 

If($UserId != 3){die;}
$Week = ReadScalar(ExecuteSqlQuery("SELECT CurrentWeek FROM fantweek"));

echo "Week is $Week";

/////////////////////////////first/////////////////////////////////////

// For each in the 'stats' part of it... find and add it to the Roster part of it. 
// will need to change 'null' to something else. - just put it so it can't be NULL - so it'll be '0'

//$sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team' && Week='$Week'"));

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM stats WHERE Week='$Week'")) as $row)
{
    $PassYds = 0;
    $Z = 0;
    $PlayerId = $row['PlayerId'];
    $Name = $row['Name'];
    $PassYds = $row['PassYds'];
    echo "$Name ($PlayerId is PId) has $PassYds Pass yds.";


    $ros = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId='$PlayerId'"));
    if($ros != NULL){
        $e = $ros['PassYds'];
        echo "e is $e";
        $Z = $e + $PassYds;
    echo "PassYds is $Z";
   $insertQuery = "UPDATE roster SET PassYds='$Z' WHERE PlayerId='$PlayerId'";
    ExecuteSqlQuery($insertQuery);
}
    echo "$Name has $Z Pass yds.";
    echo "<br>";

}


echo "This works";
