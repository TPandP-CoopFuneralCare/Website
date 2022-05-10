<?php
require('./functions.php');
initSession();
session_destroy();
$_SESSION = array();

checkSession('./login.php', false);
