<?php
session_start();
unset($_SESSION["uid"]);
unset($_SESSION["pwd"]);
session_destroy();
echo "BOOYAH";
header("location:index.php");

?>
