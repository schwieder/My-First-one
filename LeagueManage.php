<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LeagueId = $_POST['LeagueId'];

echo"<br><br>";

echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
<tr>'
    ?>
    <th>Owner</th>
    <th>Team</th>
    <th>Owner</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Points</th>
    <?php
echo '
    ';
echo '</tr><tbody class="gridtable">';

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyteams WHERE leagueId = ".$LeagueId."")) as $row)
    {
        $TeamId = $row['teamId'];
        echo '<tr>';
        echo '<td><input type="button" name="Edit" id="'.$TeamId.'" class="btn btn-success Edit" value="Edit Name & Owner"></td>';
        echo '<td>'.$row['teamName'].'</td>';
        if($row['ownerId'] != "0")
        {
            $owner = $row["ownerId"];
            $OwnerName = ReadScalar(ExecuteSqlQuery("SELECT First FROM users WHERE Id =$owner"));
        }
        else {
            $OwnerName = "Computer";
        }
        echo '<td>'.$OwnerName.'</td>';
        echo '<td>'.$row['Wins'].'</td>';
        echo '<td>'.$row['Losses'].'</td>';
        echo '<td>'.$row['Ties'].'</td>';
        $Points = ($row['Wins']*2) + ($row['Ties']);
        echo '<td>'.$Points.'</td>';


        echo '</tr>';
    }

echo '</tbody>';

?>
<script type="text/javascript">
    $(".Edit").on('click', function(){			
        {
            var TeamId = $(this).attr('id');
            $.post("LeagueManageEditTeam.php", {TeamId:TeamId}, function(data){
                $("#League").html(data);
            });
        }
	});
</script>
