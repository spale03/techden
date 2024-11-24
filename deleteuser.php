<?php
include "database.php";
include "sessionchecker.php";


if (!$_SESSION['is_admin'] == 1):
    session_destroy();

    header('HTTP/1.1 401 Unauthorized');
    exit();


endif;


if (isset ($_POST['user_ID'])):
    $sql = 'DELETE from users where user_ID = :marker';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':marker', $_POST['user_ID']);
    $stmt->execute();

    header('location:administrator.php');

endif;
