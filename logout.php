<?php

session_name('YOUR_SESSION_NAME_HERE');
session_start('');

$_SESSION = array();

header('Location: index.php');
