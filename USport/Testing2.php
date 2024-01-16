<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = 8;//$_POST['LeagueId'];
$result =  1;//ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantleagues WHERE (CommishId = '$UserId') AND (LeagueId = '$LeagueId');"));
if($result == "1")
{
    echo "You are the commish. Put Commish tools here";

    $start_date = "2022-08-22T00:00";
    $end_date = "2022-08-26T00:00";
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    $rand1 = date('Y-m-d', $val);
    $rand2 = date('H:i:s', $val);
    $rand = $rand1.'T'.$rand2;
    echo $rand;
?>
    <label for="meeting-time">Choose a time for your Draft:</label>

    
    
    
    <input type="datetime-local" id="draft-time"
       name="meeting-time" value="<?php echo $rand;?>"
       min="2022-08-22T00:00" max="2022-10-15T00:00">
<?php
    echo '<input type="button" name="Draft" id="'.$LeagueId.'" class="btn btn-success Draft" value="Submit">';

}











?>
<script type="text/javascript">
    $(".Draft").on('click', function(){			
        {
            $("#Team").hide();
            var NewTime = document.getElementById("draft-time").value;
            var LeagueId = $(this).attr('id');
            $.post("NewDraftTime2.php", {LeagueId:LeagueId, NewTime:NewTime}, function(data){
                $("#League").html(data);
            });
        }
	});
</script>
