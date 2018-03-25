<?php
session_start();

session_destroy();
//include "header.php";
header("location:accueil.php");
//echo '<a href="accueil.php" target="header">etes vous sure de vous</a>';
//echo '<meta http-equiv="Refresh" content="0;url=accueil.php" >';

?>