<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];

$Team = ReadScalar(ExecuteSqlQuery("SELECT * FROM hkyteams WHERE TeamId ='$TeamId'"));
$SetLW = [];
$SetRW = [];
$SetC = [];
$SetLD = [];
$SetRD = [];
$SetG = [];
array_push($SetLW,$Team['LW1'],$Team['LW2'],$Team['LW3'],$Team['LW4']);
array_push($SetRW,$Team['RW1'],$Team['RW2'],$Team['RW3'],$Team['RW4']);
array_push($SetC,$Team['C1'],$Team['C2'],$Team['C3'],$Team['C4']);
array_push($SetLD,$Team['LD1'],$Team['LD2'],$Team['LD3']);
array_push($SetRD,$Team['RD1'],$Team['RD2'],$Team['RD3']);
array_push($SetG,$Team['G']);


echo "<br>Please select a player for each position, make sure that no players are double booked<br><br>";
?><label>LW 1:</label><nbsp><nbsp>
<select name="LW1">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='LW'")) as $row)
{
    if($SetLW['0'] == "" && $a==0 || $SetLW['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLW['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>

<nbsp><nbsp><label>C 1:</label><nbsp><nbsp>
<select name="C1">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='C'")) as $row)
{
    if($SetC['0'] == "" && $a==0 || $SetC['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetC['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RW 1:</label><nbsp><nbsp>
<select name="RW1">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='RW'")) as $row)
{
    if($SetRW['0'] == "" && $a==0 || $SetRW['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRW['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>

<label>LW 2:</label><nbsp><nbsp>
<select name="LW2">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='LW'")) as $row)
{
    if($SetLW['1'] == "" && $a==0 || $SetLW['1'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLW['1']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<nbsp><nbsp><label>C 2:</label><nbsp><nbsp>
<select name="C2">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='C'")) as $row)
{
    if($SetC['1'] == "" && $a==0 || $SetC['1'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetC['1']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RW 2:</label><nbsp><nbsp>
<select name="RW2">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='RW'")) as $row)
{
    if($SetRW['1'] == "" && $a==0 || $SetRW['1'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRW['1']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>

<br><br>
<label>LW 3:</label><nbsp><nbsp>
<select name="LW3">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='LW'")) as $row)
{
    if($SetLW['2'] == "" && $a==0 || $SetLW['2'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLW['2']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<nbsp><nbsp><label>C 3:</label><nbsp><nbsp>
<select name="C3">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='C'")) as $row)
{
    if($SetC['2'] == "" && $a==0 || $SetC['2'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetC['2']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RW 3:</label><nbsp><nbsp>
<select name="RW3">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='RW'")) as $row)
{
    if($SetRW['2'] == "" && $a==0 || $SetRW['2'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRW['2']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>

<label>LW 4:</label><nbsp><nbsp>
<select name="LW4">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='LW'")) as $row)
{
    if($SetLW['3'] == "" && $a==0 || $SetLW['3'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLW['3']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<nbsp><nbsp><label>C 4:</label><nbsp><nbsp>
<select name="C4">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='C'")) as $row)
{
    if($SetC['3'] == "" && $a==0 || $SetC['3'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetC['3']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RW 4:</label><nbsp><nbsp>
<select name="RW4">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='RW'")) as $row)
{
    if($SetRW['3'] == "" && $a==0 || $SetRW['3'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRW['3']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>

<nbsp><nbsp><label>LD 1:</label><nbsp><nbsp>
<select name="LD1">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetLD['0'] == "" && $a==0 || $SetLD['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLD['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RD 1:</label><nbsp><nbsp>
<select name="RD1">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetRD['0'] == "" && $a==0 || $SetRD['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRD['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>

<nbsp><nbsp><label>LD 2:</label><nbsp><nbsp>
<select name="LD2">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetLD['1'] == "" && $a==0 || $SetLD['1'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLD['1']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RD 2:</label><nbsp><nbsp>
<select name="RD2">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetRD['1'] == "" && $a==0 || $SetRD['1'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRD['1']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>

<nbsp><nbsp><label>LD 3:</label><nbsp><nbsp>
<select name="LD3">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetLD['2'] == "" && $a==0 || $SetLD['2'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetLD['2']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}

?>
</select>
<nbsp><nbsp><label>RD 3:</label><nbsp><nbsp>
<select name="RD3">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='D'")) as $row)
{
    if($SetRD['2'] == "" && $a==0 || $SetRD['2'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetRD['2']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>
<nbsp><nbsp><label>Goalie:</label><nbsp><nbsp>
<select name="G">
<?php
$a=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM hkyplayers WHERE teamId = '$TeamId' && position='G'")) as $row)
{
    if($SetG['0'] == "" && $a==0 || $SetG['0'] == "0" && $a==0){
        echo '<option value="0" selected>Not selected</option>';
        $a++;
    }
    if($row['playerId'] == $SetG['0']){
        echo '<option value="'.$row['playerId'].'" selected>'.$row['playerName'].'</option>';
    }
    else{
        echo '<option value="'.$row['playerId'].'">'.$row['playerName'].'</option>';
    }
}
?>
</select>
<br><br>
<?php
echo '<input type="button" name="Submit" id="'.$TeamId.'" class="btn btn-success Submit" value="Submit">';
?>
<script type="text/javascript">
	$(document).ready(function(){
        $("#LW1").val($("#LW1 option:third").val());
		$(".Submit").on('click', function(){			
			{
                var TeamId = $(this).attr("id");
                var LW1 = $('Select[name="LW1"]').val();
                var C1 = $('Select[name="C1"]').val();
                var RW1 = $('Select[name="RW1"]').val();
                var LW2 = $('Select[name="LW2"]').val();
                var C2 = $('Select[name="C2"]').val();
                var RW2 = $('Select[name="RW2"]').val();
                var LW3 = $('Select[name="LW3"]').val();
                var C3 = $('Select[name="C3"]').val();
                var RW3 = $('Select[name="RW3"]').val();
                var LW4 = $('Select[name="LW4"]').val();
                var C4 = $('Select[name="C4"]').val();
                var RW4 = $('Select[name="RW4"]').val();
                var LD1 = $('Select[name="LD1"]').val();
                var RD1 = $('Select[name="RD1"]').val();
                var LD2 = $('Select[name="LD2"]').val();
                var RD2 = $('Select[name="RD2"]').val();
                var LD3 = $('Select[name="LD3"]').val();
                var RD3 = $('Select[name="RD3"]').val();
                var G = $('Select[name="G"]').val();
				$.post("TeamManageSubmitLineUp.php", {TeamId : TeamId
                    , LW1:LW1, C1:C1, RW1:RW1
                    , LW2:LW2, C2:C2, RW2:RW2
                    , LW3:LW3, C3:C3, RW3:RW3
                    , LW4:LW4, C4:C4, RW4:RW4
                    , LD1:LD1, RD1:RD1
                    , LD2:LD2, RD2:RD2
                    , LD3:LD3, RD3:RD3
                    , G:G
                    }, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});

</script>
