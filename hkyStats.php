<?php
	require_once("Header.php");

?>	<div id="Class" style="text-align:center;">
<br><br>
<input type="button" name="G" class="btn btn-success G" value="Goalies">
<input type="button" name="D" class="btn btn-success D" value="Blocked Shots">
<input type="button" name="Goals" class="btn btn-success Goals" value="Goals">
</div>
<?php


	echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>'
		?>
		<th>Name</th>
		<th>Goals</th>
		<?php
	echo '
		';
	echo '</tr><tbody>';

        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT *, COUNT(*) FROM HockeyStats GROUP BY Name ORDER BY COUNT(*) DESC")) as $row)
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".G").on('click', function(){					
			$.post("hkyStatsGoalies.php", {}, function(data){
				$("#Stats").html(data);
			});
		});
	});

</script>
