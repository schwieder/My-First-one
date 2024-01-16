<?php
	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $i = 0;
    while ($i < 200)
    {

        $randNo = rand(1,10);
        echo $randNo;

        $insertQuery = "INSERT INTO Random(Number) VALUES (?)";
        if(ExecuteSqlQuery($insertQuery, $randNo))
        {
            echo "rand...";
        }
        $i++;

    }

    echo "done";
    die;
