<?php
include 'database.php';
include 'adminchecker.php';




$folder_slike = './image/racunari/';
$nazivSlike = basename($_FILES['slika']['name']);
$uploadfile = "{$folder_slike}{$nazivSlike}";

$sql = "INSERT into slika (naziv) VALUES (:naziv)";

// $_FILES['slika']['tmp_name'] == "C:\xampp\tmp\$nazivSlike"
// $uploadfile == "./image/racunari/$nazivSlike"
if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadfile)) {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":naziv", $nazivSlike);
    $stmt->execute();
    header('location: administrator.php?success=1');
} else {
    header('location: administrator.php?error=1');
}

