<?php
require_once("tools.php");
session_check();
unset($_SESSION['name']);
header("location:/index.php");



?>
