<?php

/** 
 * proverava da li je korisnik uneo sve tacne parametre
 * ili
 * je administrator dodao usera
 * 
 * */ 

if (
    (isset ($_POST['username'], $_POST['password'], $_POST['email'], $_POST['confirm_password']) && ($_POST['password'] == $_POST['confirm_password'])) ||
    isset ($_POST['username'], $_POST['password'], $_POST['email'], $_POST['administrator'])
) {

    include "database.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // pretpostavljamo da je svaki user obican user osim ako admin preko admin panela nije checkovao da je taj user admin
    $is_admin = false;
    if (isset ($_POST['is_admin'])):
        $is_admin = true;
    endif;

    $sql = "INSERT INTO users ( username, password, is_admin, email) 
    VALUES ( :username, :password, :is_admin, :email)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':is_admin', $is_admin);
    $stmt->execute();

    if (isset ($_POST['administrator'])) {
        header('location: administrator.php');
    } else {
        header("Location: logovanje.php?username={$username}&password={$password}");
    }


} else {
    # echo 'Niste dobro uneli password';

    header("Location: register.php?error=1");

}
