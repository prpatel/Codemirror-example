<?php

define('USERNAME', 'root');
define('PASSWORD', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9');

session_name('YOUR_SESSION_NAME_HERE');
session_start();

$login_error = false;

//no cache aviable
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //only POST based login attempts
  if ($_POST['user'] == USERNAME && hash('sha512', $_POST['password']) == PASSWORD) {
     $_SESSION['authenticated'] = true;
     $logged = true;
  }
  else {
    $login_error = true;
    $logged = false;
  }
}
else {
  // should check if its GET call, otherwise would be better to throw error, method not allowed...
  if (isset($_SESSION['authenticated'])) {
    $logged = $_SESSION['authenticated'];
    header('Location: edit.php');
  }
  else {
    header('Location: index.html');
  }
}

header('Content-type: application/json');  // we're going to return JSON encoded data (so, we don't need to worry about parsing it)

if ($logged) {
  echo '{"status":0, "msg":"Entrant...", "url":"edit.php"}'; //jquery needs to dobule quote keys and string values
}
else {
  echo '{"status": -1, "msg":"Usuari / pwd incorrectes!", "url":"" }'; 
}
?>

