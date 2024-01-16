<?php

// need to put something in that checks if this has run already, if so don't run it again. 

    date_default_timezone_set('America/Edmonton');
    require_once("Sql.php");
    require_once("functions.php");


    //taken from https://www.youtube.com/watch?v=XLfsRASZi0s
    include("simple_html_dom.php");
    $html = file_get_html("https://universitysport.prestosports.com/sports/fball/2021-22/boxscores/20211002_efmq.xml");
    $Team1 = "Calgary"; //team on the left
    $Team2 = "Regina";  //team on the right
    $Week = 6;
    $csv = [];
    $head = [];
    foreach($html->find("table") as $h)
    {
        array_push($head, $h->text());
    }
    $csv[]=$head;
    $t=0;
    foreach($html->find("table") as $item)
    {
        if($t>4 && $t<26)
        {
            if($t % 2 == 0){
                $Team = $Team2;
            }
            else {
                $Team = $Team1;
            }
            $td = $item->find("td");
            $temp =[];
            for($i=0;$i<sizeof($td); $i++)
            {
                $text = $td[$i]->text();
                $text = str_replace(" ","",$text);
                if($i==1 || $i==2)
                {
                    $text = str_replace(",","",$text);
                }
                $a = explode("/",$text);
                if(count($a)>1) {
                    $text = $a[0];
//                    echo "text was $text, but was Exploded to";
                }
                $a = explode("'",$text);
                if(count($a)>1) {
                    $text = $a[0].$a[1];
                }
                array_push($temp,$text);
            }
            if(sizeof($td)>0)
            {
                $csv[]=$temp;
            }
        }
        $t++;
    }

    $file = fopen("data.csv","w");
    foreach($csv as $line)
    {
        fputcsv($file,$line);
    }
    fclose($file);

    $c = 1; //the table #
    $d = 0; //the array # (Name is first[0], etc)
    while($c<20){
        $e = sizeof($csv[$c]);
        while($d<$e)
        {
            $d0 = $d;
            $d1 = $d+1;
            $d2 = $d+2;
            $d3 = $d+3;
            $d4 = $d+4;
            $d5 = $d+5;
            echo $c;
            if($c == 1 || $c == 2){
                if($c == 1){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
//////////////////     $Type = "Passing";    //////////////////////////
                $Name = ($csv[$c][$d0]);
                $Yds = ($csv[$c][$d2]);
                $Tds = ($csv[$c][$d4]);
                $Ints = ($csv[$c][$d5]);
                
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
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
            else if($c == 3 || $c == 4){
/////////////////////////    $Type = "Rushing";
                if($c == 3){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Yds = ($csv[$c][$d2]);
                $Tds = ($csv[$c][$d5]);

                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                echo "Sql is $sql";
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, RunYds, RunTds) VALUES(?,?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Yds, $Tds);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET RunYds='$Yds', RunTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                echo $Name;
                echo "<br>";
            }
            else if($c == 5 || $c == 6){
///////////////////////    $Type = "Recieving";
                if($c == 5){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Yds = ($csv[$c][$d2]);
                $Tds = ($csv[$c][$d5]);
                
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, RecYds, RecTds) VALUES(?,?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Yds, $Tds);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET RecYds='$Yds', RecTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                    echo $Name;
                echo "<br>";
            }
// Need to fix it when it's blank then change it back to 7 below then we can add the Rugue as well
            else if($c == 7 || $c == 8){
/////////////////////        $Type = "Kicking";
                if($c == 7){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Pts = ($csv[$c][$d5]);
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, KickPts) VALUES(?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Pts);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET KickPts='$Pts' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                echo $Name;
                echo "<br>";
            }
            else if($c == 13 || $c == 14){
/////////////////////////      $Type = "KOR";
                if($c == 13){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Yds = ($csv[$c][$d2]);
                $Tds = ($csv[$c][$d5]);
                
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, KORYds, KORTds) VALUES(?,?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Yds, $Tds);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET KORYds='$Yds', KORTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                echo $Name;
                echo "<br>";
            }
            else if($c == 15 || $c == 16){
////////////////        $Type = "PR";
                if($c == 15){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Yds = ($csv[$c][$d2]);
                $Tds = ($csv[$c][$d5]);
                
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, PRYds, PRTds) VALUES(?,?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Yds, $Tds);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET PRYds='$Yds', PRTds='$Tds' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                echo $Name;
                echo "<br>";
            }
            else if($c == 19 || $c == 20){
///////////////      $Type = "Fumbles";
                if($c == 19){
                    $Team = $Team1;
                }
                else {
                    $Team = $Team2;
                }
                $Name = ($csv[$c][$d0]);
                $Fum = ($csv[$c][$d1]);
                $FumLost = ($csv[$c][$d2]);
                
                $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                if($sql == 0){
                    $insertQuery = "INSERT INTO stats(Week, Name, Team, Fumbles, FumblesLost) VALUES(?,?,?,?,?)";
                    ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Fum, $FumLost);
                    echo "Insert";
                }
                else{
                    $insertQuery = "UPDATE stats SET Fumbles='$Fum', FumblesLost='$FumLost' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                    ExecuteSqlQuery($insertQuery);
                    echo "Update";
                }
                echo $Name;
                echo "<br>";

                $Name = ($csv[$c][$d3]);
                $Length = strlen($Name);
                if ($Length > 0)
                {
                    $Fum = ($csv[$c][$d4]);
                    $FumLost = ($csv[$c][$d5]);
                    $sql = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE Name='$Name' && Team='$Team'"));
                    if($sql == 0){
                        $insertQuery = "INSERT INTO stats(Week, Name, Team, Fumbles, FumblesLost) VALUES(?,?,?,?,?)";
                        ExecuteSqlQuery($insertQuery, $Week, $Name, $Team, $Fum, $FumLost);
                        echo "Insert";
                    }
                    else{
                        $insertQuery = "UPDATE stats SET Fumbles='$Fum', FumblesLost='$FumLost' WHERE Name='$Name' && Team='$Team' && Week='$Week'";
                        ExecuteSqlQuery($insertQuery);
                        echo "Update";
                    }
                    echo $Name;
                    echo "<br>";
                }
            

            }
            $d=$d+6;
            //end of player insert into stats
        }
        $c++;
        $d=0;
        //end of team stats
        // $t 5&6 are passing, 7&8 Rushing, 9&10 Rec, 11&12 Kicking, 13&14 Punting, 15&16 Kickoffs, 17&18 KOR, 19&20 PR,
        // 21&22 Int Returns, 23&24 Fumbles, 25&26 D Stats
        //holy shit.... does this work??
    }
//    var_dump($csv);

?>

