<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$Name = $_POST['Name'];
$PlayerId = $_POST['PlayerId'];

    echo '<br/><p style = "text-align: center; font-size: 25px; color: Blue; " >Change '.$Name.'\'s Name</p><br/>';
    echo "<label>New Name :</label><br/>";
    echo '<input type="text" name="NewName" id="NewName"/><br/><br/>';
    echo '<input type="button" class="btn btn-success New" value="Change Name">';

?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".New").on('click', function(){			
			{   
                var NewName = document.getElementById('NewName').value;
                var PlayerId = "<?php echo $PlayerId; ?>";
				$.post("TeamManageChangeNameExecute.php", {NewName:NewName, PlayerId: PlayerId}, function(data){
					$("#Team2").html(data);
				});
			}
		});
	});
</script>
