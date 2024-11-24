<?php
include 'sessionizer.php';

if(!isset($_SESSION['user_ID'])) {
    session_destroy();
    header("Location:index.php");
    exit();
}