<?php
session_start();

// Redirect to login.php if user is not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>
