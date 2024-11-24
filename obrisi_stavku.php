<?php
include 'database.php';
$korpa_ID = $_POST['korpa_ID'];

$sql = 'DELETE from korpa where korpa_ID = :korpa_ID';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':korpa_ID', $korpa_ID);

$stmt->execute();

header('location: korpa.php');