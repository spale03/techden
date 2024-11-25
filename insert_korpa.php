<?php
include 'database.php';
include 'sessionchecker.php';

$user_ID = $_POST['user_ID'];
$racunar_ID = $_POST['racunar_ID'];

$sql = "INSERT INTO korpa(user_ID,racunar_ID)
VALUES (:user_ID, :racunar_ID)";

print_r($_POST);
$stmt = $pdo->prepare($sql);


$stmt->bindParam(":user_ID", $user_ID);
$stmt->bindParam(":racunar_ID", $racunar_ID);

$stmt->execute();
print_r($_POST);
if (isset($_POST["shop"])) {

    header("location: shop.php");
} else {

    header("location: korpa.php");
}
