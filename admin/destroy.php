<?php

$session_name = session_name();
if (isset($_COOKIE[$session_name]) and empty($_COOKIE[$session_name])) {
    unset($_COOKIE[$session_name]);
}

// Start the session
session_start();
// destroy the session 
session_destroy(); 


?>