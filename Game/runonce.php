<?php

	require_once("Header.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');


    if($text == '1')
    {
        echo "die";
        die;
    }
    else{
        $text = '1';
        $var_str = var_export($text, true);
        $var = "<?php\n\n\$text = $var_str;\n\n?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);

        $searchingArray = array();
        $var_str = var_export($searchingArray, true);
        $var = "<?php\n\n\$searchingArray = $var_str;\n\n?>";
        file_put_contents("init.php",$var . "\n\n",FILE_APPEND);

        echo $text;
    }

