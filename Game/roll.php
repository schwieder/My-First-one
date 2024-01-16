<?php

	require_once("Header.php");
    echo "<div id='Cards' style='text-align:center;'>";

    $width = "150";
    $height = "107";

    $VsId = 2;
    $User1 = $UserId;
    $User2 = $VsId;

    if(isset($_SESSION["$User1+$User2"]))
    {
        $arr = $_SESSION["$User1+$User2+array"];
        echo "1 vs 2 was set";
        $arr = array_values($arr);
    }
    else if(isset($_SESSION["$User2+$User1"]))
    {
        $arr = $_SESSION["$User2+$User1+array"];
        echo "2 vs 1 was set";
        $arr = array_values($arr);
    }
    else{

        $_SESSION["$User1+$User2"] = "set";
        $InFieldArray = array(
            1 => array('Id' => 'Tor1', 'Team' => 'Toronto', 'name' => 'Bichette', 'pos' => 'SS', 'Def' => '2', 'Bat' => '4', 'Spd' => '4', 'img' => 'pics/Tor/Bichette.png'),
            2 => array('Id' => 'Tor2', 'Team' => 'Toronto', 'name' => 'Espinal', 'pos' => '2B', 'Def' => '5', 'Bat' => '3', 'Spd' => '4', 'img' => 'pics/Tor/Espinal.png'),
            3 => array('Id' => 'Tor3', 'Team' => 'Toronto', 'name' => 'Chapman', 'pos' => '3B', 'Def' => '4', 'Bat' => '4', 'Spd' => '4', 'img' => 'pics/Tor/Chapman.png'),
            4 => array('Id' => 'Tor4', 'Team' => 'Toronto', 'name' => 'Kirk', 'pos' => 'C', 'Def' => '3', 'Bat' => '4', 'Spd' => '2', 'img' => 'pics/Tor/Kirk.png'),
            5 => array('Id' => 'Tor5', 'Team' => 'Toronto', 'name' => 'Guerrero', 'pos' => '1b', 'Def' => '6', 'Bat' => '5', 'Spd' => '2', 'img' => 'pics/Tor/Guerrero.png'),
            6 => array('Id' => 'Wsn1', 'Team' => 'Washington', 'name' => 'Garcia', 'pos' => 'SS', 'Def' => '2', 'Bat' => '3', 'Spd' => '3', 'img' => 'pics/Wsn/Garcia.png'),
            7 => array('Id' => 'Wsn2', 'Team' => 'Washington', 'name' => 'Hernandez', 'pos' => '2B', 'Def' => '3', 'Bat' => '3', 'Spd' => '3', 'img' => 'pics/Wsn/Hernandez.png'),
            8 => array('Id' => 'Wsn3', 'Team' => 'Washington', 'name' => 'Franco', 'pos' => '3B', 'Def' => '3', 'Bat' => '2', 'Spd' => '3', 'img' => 'pics/Wsn/Franco.png'),
            9 => array('Id' => 'Wsn4', 'Team' => 'Washington', 'name' => 'Ruiz', 'pos' => 'C', 'Def' => '3', 'Bat' => '3', 'Spd' => '3', 'img' => 'pics/Wsn/Ruiz.png'),
            10 => array('Id' => 'Wsn5', 'Team' => 'Washington', 'name' => 'Meneses', 'pos' => '1b', 'Def' => '4', 'Bat' => '5', 'Spd' => '3', 'img' => 'pics/Wsn/Meneses.png'),
        );
        $OutFieldArray = array(
            1 => array('Id' => 'Tor6', 'Team' => 'Toronto', 'name' => 'Gurriel Jr', 'pos' => 'LF', 'Def' => '2', 'Bat' => '4', 'Spd' => '2', 'img' => 'pics/Tor/Gurriel Jr.png'),
            2 => array('Id' => 'Tor7', 'Team' => 'Toronto', 'name' => 'Hernandez', 'pos' => 'RF', 'Def' => '2', 'Bat' => '4', 'Spd' => '3', 'img' => 'pics/Tor/Hernandez.png'),
            3 => array('Id' => 'Tor8', 'Team' => 'Toronto', 'name' => 'Springer', 'pos' => 'CF', 'Def' => '3', 'Bat' => '4', 'Spd' => '2', 'img' => 'pics/Tor/Springer.png'),
        );

        $arr = array();
        shuffle($InFieldArray);
        $Infield6 = array_slice($InFieldArray ,0,6);
        $i = 0;
        while($i <6)
        {
            array_push($arr,$Infield6[$i]);
            $i++;
        }
        shuffle($OutFieldArray);
        $Outfield6 = array_slice($OutFieldArray ,0,3);
        $o = 0;
        while($o <3)
        {
            array_push($arr,$Outfield6[$o]);
            $o++;
        }
        $_SESSION["$User1+$User2+array"] = $arr;
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

