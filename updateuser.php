<?php
include "database.php";
include "adminchecker.php";

if (isset ($_POST['user_ID'], $_POST['username'], $_POST['password'], $_POST['email'])) {
    #ako su parametri proslednjeni 
    if (isset ($_POST['is_admin'])) {
        /**
         * ako je cekiran checkbox namesti vrednostu koju baza razume 
         * true || false || 1 || 0 
         * vrednost koju checkbox prosledju moze biti
         *  yes || on || 1 
         */
        $_POST['is_admin'] = '1';
    } else {
        $_POST['is_admin'] = '0';
    }

    $sql = 'UPDATE users
    SET username = :username, password = :password, is_admin = :is_admin, email = :email
    WHERE user_ID = :user_ID';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':is_admin', $_POST['is_admin']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':user_ID', $_POST['user_ID']);
    if ($stmt->execute()) {
        // echo 'success';
        header('location:administrator.php');
    } else {
        // echo 'fail';
        header('location:administrator.php?error=1');
    }


}
