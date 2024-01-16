<?php

    date_default_timezone_set('America/Edmonton');
    require_once("Sql.php");
    require_once("functions.php");

    $width = "150";
    $height = "107";

    $val = $_POST['val'];

    $VsId = 2;
    $User1 = $_SESSION['UserId'];
    $User2 = $VsId;

    if(isset($_SESSION["$User1+$User2"]))
    {
        $arr = $_SESSION["$User1+$User2+array"];
        unset($arr[$val]); 
        $arr = array_values($arr);
        $_SESSION["$User1+$User2+array"] = $arr;
    }
    else if(isset($_SESSION["$User2+$User1"]))
    {
        $arr = $_SESSION["$User2+$User1+array"];
        unset($arr[$val]); 
        $arr = array_values($arr);
        $_SESSION["$User2+$User1+array"] = $arr;
    }
    else{
        echo "you shouldn't be here";
        die;
    }

echo "<br>";
echo "<br>";
$no = 0;

foreach($arr as $player)
{
    $img = $player['img'];
    $Id = $player['Id'];
    echo '<img id="'.$Id.'" src="'.$img.'" width="'.$width.'" height="'.$height.'" style="margin: 0px 8px; opacity: 1;" alt="'.$no.'" onclick="clicked(this)">';
    $no++;
    if($no%5 == 0){echo "<br><br>";}
}


echo "<br>";



?>
<script>

function clicked(e) {
    var CardId = e.id;
    var val = e.alt;
    alert(val);
    $.post("roll2.php", {CardId: CardId, val: val}, function(data){
        $("#Cards").html(data);
    });
}



</script>

