<?php
include "database.php";
include "sessionchecker.php";

$racunar_ID = $_POST["racunar_ID"];
$user_ID = $_POST["user_ID"];

$sql = "SELECT * from racunari where racunar_ID = :racunar_ID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":racunar_ID", $racunar_ID);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$naziv = $result["naziv"];
$cena = $result["cena"];
$slika = $result["slika"];


//naziv -> prikazi racunar
// GET



?>

<html>

<?php include_once "head.php"; ?>
<link rel="stylesheet" href="style/shop.css">

<body>
    <?php include_once "header.php"; ?>
    <div class="container">
        <h1>Info</h1>
        <form class="komp">
            <img src="image/racunari/<?= $slika; ?>" alt="<?= $naziv; ?>">
            <input type="hidden" name="racunar_ID" value="<?= $racunar_ID; ?>">
            <input type="hidden" name="user_ID" value="<?= $user_ID; ?>">
            <input type="hidden" name="naziv" value="<?= $naziv; ?>">

            <p>Cena:
                <?= $cena; ?>
            </p>
            <button formaction="insert_korpa.php" formmethod="POST" type="submit" class="kupi-button">Kupi</button>

        </form>

        <!-- Main element here -->

        <!-- PC Render container -->
        
        <!--  Image render container -->
    </div>



</body>
<?php include "footer.php" ?>

</html>