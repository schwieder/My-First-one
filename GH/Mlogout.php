<?php

session_start();
session_destroy();
setcookie("Email","", time()-3600);

header("location:Mindex.php");


?>