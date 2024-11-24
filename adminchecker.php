<?php
include 'sessionchecker.php';


if (!$_SESSION['is_admin'] == 1):
    session_destroy();

    header('HTTP/1.1 401 Unauthorized');
    exit();


endif;