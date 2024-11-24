<?php
include "database.php";
include "sessionchecker.php";

$user_ID = $_SESSION['user_ID'];

$sql = "SELECT naziv, cena, slika, racunar_ID from racunari";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$skupRezultata = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE php>
<html>

<?php include_once 'head.php'; ?>
<link rel="stylesheet" href="style/shop.css">

<body>
<?php include_once 'header.php';?>
    <div class="container">
        <h1>Celokupna ponuda</h1>

        <div class="komp-grid">
            <?php foreach ($skupRezultata as $sviracunari):
                $naziv = $sviracunari["naziv"];
                $cena = $sviracunari["cena"];
                $slika = $sviracunari["slika"];
                $racunar_ID = $sviracunari["racunar_ID"];
                ?>

                <form  class="komp">

                    <img src="image/racunari/<?= $slika; ?>" alt="<?= $naziv; ?>">
                    <input type="hidden" name="racunar_ID" value="<?= $racunar_ID; ?>">
                    <input type="hidden" name="user_ID" value="<?= $user_ID; ?>">
                    <input type="hidden" name="naziv" value="<?= $naziv; ?>">
                    <input type="hidden" name="shop" value="shop">
                    
                    <p>Cena:
                        <?= $cena; ?>
                    </p>
                    <button formaction="insert_korpa.php" formmethod="POST" type="submit" class="kupi-button">Kupi</button>
                    <button formaction="racunar.php" formmethod="POST" type="submit" class="kupi-button">Prikazi</button>
                    
                </form>


            <?php endforeach; ?>

        </div>
    </div>

    <footer>
        <p>&copy; TechDen</p>
    </footer>

</body>

</html>