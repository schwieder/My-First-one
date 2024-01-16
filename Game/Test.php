<?php

	require_once("Header.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');

?>


    <script id="s1">
    Ch = "<?php echo $$Chose; ?>";
    if(Ch == 14)
    {
        ChIs14();
    }
    
    lastUpdated = "<?php echo $$LastUpdated; ?>";
        $(document).ready(function(){
            clearInterval(CheckForChange);
            setInterval(CheckForChange, 1000);
            
            function CheckForChange()
            {
                onload="loaded=true;" >
                console.log('checking');
                $.ajax({
                    url: "<?php echo 'Get_TimeChange_Changes.php?LowId='.$LowId.'&HighId='.$HighId.'&Timestamp='; ?>"+lastUpdated,
                    type:"GET",
                    dataType: 'json',
                    success: function(result){
    
                        if(result.error_msg) {
                            alert(result.error_msg);
                        }
                        else
                        {
                            emptyclicked();
                            thisFunctionDoesNotExistAndWasCreatedWithTheOnlyPurposeOfStopJavascriptExecutionOfAllTypesIncludingCatchAndAnyArbitraryWeirdScenario();
    
                        }
                    },
    //			error: function (xhr, ajaxOptions, thrownError) {
    //				alert(xhr.status);
    //				alert(thrownError);
    //			  }
        
                });
            }
        });
    
    function clicking(e) {
        var User2 = <?php echo $User2; ?>;
        var val = e.alt;
        $.post("Playing2.php", {User2: User2, val: val}, function(data){
                $("#Profile").html(data);
            });
    }
    function emptyclicked() {
        var User2 = <?php echo $User2; ?>;
        $.post("Playing2.php", {User2: User2}, function(data){
                $("#Profile").html(data);
            });
    }
    function ChIs14() {
        var User2 = <?php echo $User2; ?>;
        $.post("BatterUp.php", {User2: User2}, function(data){
                $("#Profile").html(data);
            });
    }
    
    </script>
    
    