<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');


    echo "<br><br>";

    $UserId = $_POST['UserId'];
    $val = $_POST['val'];

    if($val == "Search")
    {
        // change this to a list of names with however many wins you have as well?
        echo '<label for="ChallengeId">Challenge What UserId?:</label><br>
        <input type="text" id="ChallengeId" name="ChallengeId"><br><br>
        <button type="button" value="Challenge" id='.$UserId.' onclick="clicked(this)">Challenge!!!!</button>';
    }
    else if($val == "Challenge")
    {
        $who = $_POST['who'];
        if($who == $UserId){echo "Please reload, you've chosen your own userId"; die;}
		$insertQuery = "UPDATE users SET Playing=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $who, $UserId);
		$insertQuery = "UPDATE users SET Playing=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $UserId, $who);
        header ('location: Playing.php');
    }
    else if($val == "Continue")
    {
        header ('location: Playing.php');
    }
    else if($val == "End"){
        
        $PlayingWho = ReadScalar(ExecuteSqlQuery("SELECT Playing FROM users WHERE Id='$UserId'"));

		$insertQuery = "UPDATE users SET Playing=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, NULL, $UserId);
		$insertQuery = "UPDATE users SET Playing=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, NULL, $PlayingWho);
        echo "Game has ended, please reload";
    }
    else{
        echo "how'd you get here?"; die; 
    }



    ?>
    </p>
    
    </body>
    </html>
    
    
    <script>
    
    function clicked(e) {
        var UserId = e.id;
        var val = e.value;
        var who = $('input[id="ChallengeId"]').val();
        $.post("profileClicked.php", {UserId: UserId, val: val, who: who}, function(data){
                    $("#Profile").html(data);
                });
        
    }
    
    
    
    </script>
    
    
    