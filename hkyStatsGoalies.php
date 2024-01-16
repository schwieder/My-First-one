<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>'
		?>
		<th>Name</th>
		<th>Goals Against</th>
		<th>Shots Saved</th>
		<th>Save %</th>
		<?php
	echo '
		';
	echo '</tr><tbody>';

        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM HockeyStats where GROUP BY Name ORDER BY COUNT(*) DESC")) as $row)
        {
            $v = $row['Id'];
            $total = ReadScalar(ExecuteSqlQuery("SELECT COUNT(Id) FROM  HockeyStats WHERE Id = $v"));

            echo '<tr>';
            echo '<td>'.$row['Name'].'</td>';
            echo '<td>'.$total.'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
?>
