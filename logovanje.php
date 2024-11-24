<?php
include 'sessionizer.php';

// ako smo metodom posta ili geta(prosledjeni sa registracije) dobili vrednosti za username i password
if (isset ($_POST['username'], $_POST['password']) || isset ($_GET['username'], $_GET['password'])) {
    include 'database.php';
    $username = '';

    // ako je setovan post metodom pasword i username  sacuvaj ga u promenjivu
    if (isset ($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    // ako je proslednjen get metodom sacuvaj ga u promenjivu
    if (isset ($_GET['username'])) {
        $username = $_GET['username'];
        $password = $_GET['password'];
    }
    // uzimamo korisnika gde su username i password isti
    $upit = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

    $upit->bindParam(':username', $username);
    $upit->bindParam(':password', $password);
    $upit->execute();

    // fetch hvata jedan red a fetchall hvata vise redova
    $rezultat = $upit->fetch(PDO::FETCH_ASSOC);
    // ako nema rezultata vrati ga na login sa greskom (get metoda)
    if (!$rezultat) {
        header("Location:login.php?error=2");
        exit();
    } else {
        // ako ima rezultate startuj sesiju i prosledi parametre usera u sesiju
        $_SESSION['username'] = $rezultat['username'];
        $_SESSION['is_admin'] = $rezultat['is_admin'];
        $_SESSION['email'] = $rezultat['email'];
        $_SESSION['user_ID'] = $rezultat['user_ID'];
        
        //ako je trenutna sesija pokrenuta kao admin preusmeri nas na admin.php ako nije vrati nas na index.php 
        if ($_SESSION["is_admin"]) {
            header("Location:administrator.php");

        } else {
            header("Location:index.php");
        }

    }
}