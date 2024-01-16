
<div id="Class" style="text-align:center;">
<br><br>
<?php


$width = "50";
$height = "50";

/*'$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$d',$e,$e,$e,$f,$aa,
    '$g',$h,$h,$h,$i,$aa
*/

$a = '<img id="A1" val="A1" src="GBTopLeft.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$b = '<img id="A2" val="A2" src="GBTopMid.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$c = '<img id="A5" val="A5" src="GBTopRight.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';;
$d = '<img id="B1" val="B1" src="GBMidLeft.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$e = '<img id="B2" val="B2" src="GBMid.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$f = '<img id="B5" val="B5" src="GBMidRight.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$g = '<img id="F1" val="F1" src="GBBotLeft.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$h = '<img id="F4" val="F4" src="GBBotMid.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$i = '<img id="F5" val="F5" src="GBBotRight.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$S1 = '<img id="S1" val="S1" src="Seeker1.png"  width="'.$width.'" height="'.$height.'" alt="boardgameA1" onmouseover="mouseOver(this)" onmouseout="mouseOut()" onclick="your_function_name()">';
$S1 = imagecopymerge($array[51], $S1, 0, 0, 0, 0, imagesx($S1), imagesy($S1), 100);
//trying to merge where the seeker was, then we can store the position ie array [51], in the session and we can replace it in the array and then just print the array.

$aa = "<br>";

$array = array(
    "$a","$b","$b","$b","$c","$aa",
    "$d","$e","$e","$e","$f","$aa",
    "$d","$e","$e","$e","$f","$aa",
    "$d","$e","$e","$e","$f","$aa",
    "$d","$e","$e","$e","$f","$aa",    //half
    "$d","$e","$e","$e","$f","$aa",    //half
    "$d","$e","$e","$e","$f","$aa",
    "$d","$e","$e","$e","$f","$aa",
    "$d","$e","$S1","$e","$f","$aa",
    "$g","$h","$h","$h","$i","$aa",
);

foreach($array as $value){
    echo $value;
}

$S1 = imagecopy($array[51],$S1);

?>

<script>
function generate(){
    var x=document.getElementById("randomNum");
    x.innerHTML=Math.floor((Math.random()*6)+1);
}

function your_function_name() {
    var id = e.id;
    alert(id);
}


function mouseOver(e) {
    var id = e.id;
    console.log(id);
}

function mouseOut() {
//    document.getElementById("img").style.opacity = "1";
}

</script>
