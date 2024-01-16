<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];

    echo "Standings";
    echo '<table id="admintable" style="text-align:center; margin-left:auto; margin-right:auto; width: 500px;"><tr></tr>
    <tr>';
        ?>
        <th>Team</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Ties</th>
        <th>Pts For</th>
        <th>Pts Against</th>
        <?php
	echo '</tr><tbody>';

	foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId' ORDER BY Wins DESC, Ties DESC, PointsFor DESC")) as $row)
	{
            echo '<tr>';
            echo '<td>'.$row['TeamName'].'</td>';
            echo '<td>'.$row['Wins'].'</td>';
            echo '<td>'.$row['Losses'].'</td>';
            echo '<td>'.$row['Ties'].'</td>';
            echo '<td>'.$row['PointsFor'].'</td>';
            echo '<td>'.$row['PointsAgainst'].'</td>';
            echo '</tr>';
    }
	echo '</tbody>';

