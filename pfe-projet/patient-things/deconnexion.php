<?php
include('dbconnexion.php');
session_start();
session_unset(); 
session_destroy();
header('Location: p_login.php');

?>
