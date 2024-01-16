<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$TeamId = $_POST['TeamId'];
$LW1 = $_POST['LW1'];
$C1 = $_POST['C1'];
$RW1 = $_POST['RW1'];
$LW2 = $_POST['LW2'];
$C2 = $_POST['C2'];
$RW2 = $_POST['RW2'];
$LW3 = $_POST['LW3'];
$C3 = $_POST['C3'];
$RW3 = $_POST['RW3'];
$LW4 = $_POST['LW4'];
$C4 = $_POST['C4'];
$RW4 = $_POST['RW4'];
$LD1 = $_POST['LD1'];
$RD1 = $_POST['RD1'];
$LD2 = $_POST['LD2'];
$RD2 = $_POST['RD2'];
$LD3 = $_POST['LD3'];
$RD3 = $_POST['RD3'];
$G = $_POST['G'];


$input_array = Array($LW1, $C1, $RW1, $LW2, $C2, $RW2, $LW3, $C3, $RW3, $LW4, $C4, $RW4, $RD1, $LD1, $RD2, $LD2, $RD3, $LD3, $G);

$uniqueValues = array_unique($input_array);
if (sizeof($uniqueValues) != sizeof($input_array)) {
  echo 'There are players in duplicate roles:';
  $duplicates = array_unique( array_diff_assoc( $input_array, array_unique( $input_array ) ) );
  foreach($duplicates as $k=>$var){
      $Name = ReadScalar(ExecuteSqlQuery("SELECT playerName FROM hkyplayers WHERE playerId ='$var'"));
      echo "<br />";
      echo $Name;
  }
}
else{
    $insertQuery = "UPDATE hkyteams SET LW1=?, C1=?, RW1=?, LW2=?, C2=?, RW2=?, LW3=?, C3=?, RW3=?, LW4=?, C4=?, RW4=?, LD1=?, RD1=?, LD2=?, RD2=?, LD3=?, RD3=?, G=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $LW1, $C1, $RW1, $LW2, $C2, $RW2, $LW3, $C3, $RW3, $LW4, $C4, $RW4, $LD1, $RD1, $LD2, $RD2, $LD3, $RD3, $G, $TeamId);
    echo "Line up set!!";
}

