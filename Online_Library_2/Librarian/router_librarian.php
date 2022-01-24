<?php
session_start();
$_SESSION['isbn'] = "";
$_SESSION['regno'] = "";
$_SESSION['message'] = "";

//echo $_SESSION['isbn'];

// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page

header("Location: " . $page . ".php");
?>