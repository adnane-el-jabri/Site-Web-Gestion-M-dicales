<?php
include('dbconnexion.php');
session_start();
session_unset(); 
session_destroy();
header('Location: d_login.php');

?>