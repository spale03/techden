<?php
include 'database.php';
include 'sessionizer.php';


$stavkeUKorpi = $pdo->prepare("SELECT count(*) broj_stavki FROM korpa WHERE user_ID = :user_ID");
$stavkeUKorpi->bindParam(':user_ID', $_SESSION['user_ID']);
$stavkeUKorpi->execute();

$rezultatstavkiUKorpi = $stavkeUKorpi->fetch(PDO::FETCH_ASSOC);
$_SESSION['korpa'] = $rezultatstavkiUKorpi['broj_stavki'];
// broji stavke u korpi i cuva ih u sesiji