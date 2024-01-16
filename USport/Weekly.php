<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];

echo "<br>";
echo '<input type="button" name="Week1" id="'.$LeagueId.'" class="btn btn-success Week1" value="Week 1 Stats"> &nbsp';
echo '<input type="button" name="Week2" id="'.$LeagueId.'" class="btn btn-success Week2" value="Week 2 Stats"> &nbsp';
echo '<input type="button" name="Week3" id="'.$LeagueId.'" class="btn btn-success Week3" value="Week 3 Stats"> &nbsp';
echo '<input type="button" name="Week4" id="'.$LeagueId.'" class="btn btn-success Week4" value="Week 4 Stats"> &nbsp';
echo '<input type="button" name="Week5" id="'.$LeagueId.'" class="btn btn-success Week5" value="Week 5 Stats"> &nbsp';
echo '<input type="button" name="Week6" id="'.$LeagueId.'" class="btn btn-success Week6" value="Week 6 Stats"> &nbsp';


?>
<script type="text/javascript">
    $(".Week1").on('click', function(){			
        {
            
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:1}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Week2").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:2}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Week3").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:3}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Week4").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:4}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Week5").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:5}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
    $(".Week6").on('click', function(){			
        {
            $("#TeamInner").show();
            $.post("LeadersWeek.php", {LeagueId:LeagueId, Week:6}, function(data){
                $("#TeamInner").html(data);
            });
        }
	});
</script>
