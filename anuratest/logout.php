<?php
session_start();

unset($_SESSION['logged_in']);
echo '<script>window.location.replace("login.php");</script>';
?>