<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    $H = $_SESSION['HScore'];
    $A = $_SESSION['AScore'];

    echo "<br><br>Washington: $H      Carolina: $A<br>";


/*
    <script type="text/javascript">

    $(document).ready(function () {
        yourFunction();
    });
    function yourFunction(){
        alert("Page is loaded");
    }
</script>

*/