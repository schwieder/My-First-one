<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$PlayerId = $_POST['playerId'];
$Info = ReadScalar(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE playerID ='$PlayerId'"));
$Year = $Info['year'];
$Name = $Info['playerName'];

echo '<br><input type="button" id="'.$PlayerId.'" align="center" class="btn btn-success Change" value="Change '.$Name.'\'s Name">';

echo "<br><br>";

$Pic = $Info['picture'];
echo '<img style="vertical-align:middle" width="150" height="150" src="Images/'.$Pic.'">';
echo '<p style="font-size:40px; font-family:Freestyle Script" >'.$Name.'</p>';

echo '<table class="EditPlayertable" id="EditPlayertable" style="align:center;"><tr></tr>
<tr>';


echo '
<tr>
<th>Year 1</th>
<th>Year 2</th>
<th>Year 3</th>
<th>Year 4</th>
';
echo '</tr>';
echo '';
if($Info['position'] == "G")
{
    if($Year > 3)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            $sv = $row['SavePercent'] / 1000;
            echo '<td>Save %: '.$sv.'</td>';
        }
        $sv = $Info['savePercent'] / 1000;
        echo '<td>Save %: '.$sv.'</td>';
    }
    else if($Year > 2)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            $sv = $row['SavePercent'] / 1000;
            echo '<td>Save %: '.$sv.'</td>';
        }
        $sv = $Info['savePercent'] / 1000;
        echo '<td>Save %: '.$sv.'</td>';
        echo '<td>Save %: N/A </td>';
    }
    else if($Year > 1)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            $sv = $row['SavePercent'] / 1000;
            echo '<td>Save %: '.$sv.'</td>';
        }
        $sv = $Info['savePercent'] / 1000;
        echo '<td>Save %: '.$sv.'</td>';
        echo '<td>Save %: N/A </td>';
        echo '<td>Save %: N/A </td>';
    }
    else
    {
        echo '<td>Goals: '.$Info['goals'].'</td>';
        echo '<td>Save %: N/A </td>';
        echo '<td>Save %: N/A </td>';
        echo '<td>Save %: N/A </td>';
    }
}
else if($Info['position'] == "D")
{
    if($Year > 3)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'<br>Shots Blocked: '.$row['ShotsBlocked'].'<br></td>';
        }
        echo '<td>Goals: '.$Info['goals'].'<br>Shots Blocked: '.$Info['shotsBlocked'].'<br></td>';
    }
    else if($Year > 2)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'<br>Shots Blocked: '.$row['ShotsBlocked'].'<br></td>';
        }
        echo '<td>Goals: '.$Info['goals'].'<br>Shots Blocked: '.$Info['shotsBlocked'].'<br></td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
    }
    else if($Year > 1)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'<br>Shots Blocked: '.$row['ShotsBlocked'].'<br></td>';
        }
        echo '<td>Goals: '.$Info['goals'].'<br>Shots Blocked: '.$Info['shotsBlocked'].'<br></td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
    }
    else
    {
        echo '<td>Goals: '.$Info['goals'].'<br>Shots Blocked: '.$Info['shotsBlocked'].'<br></td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
        echo '<td>Goals: N/A<br>Shots Blocked: N/A</td>';
    }
}
else 
{
    if($Year > 3)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'</td>';
        }
        echo '<td>Goals: '.$Info['goals'].'</td>';
    }
    else if($Year > 2)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'</td>';
        }
        echo '<td>Goals: '.$Info['goals'].'</td>';
        echo '<td>Goals: N/A </td>';
    }
    else if($Year > 1)
    {
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyalltimestats WHERE playerId = ".$PlayerId."")) as $row)
        {
            echo '<td>Goals: '.$row['Goals'].'</td>';
        }
        echo '<td>Goals: '.$Info['goals'].'</td>';
        echo '<td>Goals: N/A </td>';
        echo '<td>Goals: N/A </td>';
    }
    else
    {
        echo '<td>Goals: '.$Info['goals'].'</td>';
        echo '<td>Goals: N/A </td>';
        echo '<td>Goals: N/A </td>';
        echo '<td>Goals: N/A </td>';
    }
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Change").on('click', function(){			
			{   
                var Name = "<?php echo $Name; ?>";
                var PlayerId = "<?php echo $PlayerId; ?>";
				$.post("TeamManageChangeName.php", {Name:Name, PlayerId: PlayerId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});
</script>
