<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>Number';
	echo '</tr><tbody>';

        $one = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 1"));
        $two = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 2"));
        $three = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 3"));
        $four = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 4"));
        $five = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 5"));
        $six = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 6"));
        $seven = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 7"));
        $eight = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 8"));
        $nine = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 9"));
        $ten = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Number) FROM  Random WHERE Number = 10"));
        echo '<tr>';
        echo '<td>'.$one.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$two.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$three.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$four.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$five.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$six.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$seven.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$eight.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$nine.'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$ten.'</td>';
        echo '</tr>';
    echo '</tbody>';

?>
