<?php
include 'database.php';
include 'sessionchecker.php';

$user_ID = $_SESSION['user_ID'];
/**
 * Izvlacenje podataka o racunaru koji se nalazi u korpi usera.
 * vraca sve racunare koji se nalaze u korpi za datog usera.
 */
$sql = "SELECT r.naziv, r.cena, r.slika, r.racunar_ID, k.korpa_ID
from korpa k
left join
racunari r on k.racunar_ID = r.racunar_ID
where k.user_ID = :user_ID";


/**
 * vrati sumu cene svih racunara koji se nalaze u korpi usera
 */
$sql2 = "SELECT SUM(r.cena) AS total
FROM korpa k
LEFT JOIN racunari r ON k.racunar_ID = r.racunar_ID
WHERE k.user_ID = :user_ID";

$stmt = $pdo->prepare($sql);
$stmt2 = $pdo->prepare($sql2);
$stmt->bindParam(":user_ID", $user_ID);
$stmt2->bindParam(":user_ID", $user_ID);

$stmt->execute();
$stmt2->execute();
$rezultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rezultat2 = $stmt2->fetchAll(PDO::FETCH_ASSOC)[0];
$total = $rezultat2['total'];


?>


<!DOCTYPE php>
<html>

<?php include_once 'head.php'; ?>

<link rel="stylesheet" href="style/korpa.css">



<body>

  <?php include_once 'header.php'; ?>


  <h2>Korpa</h2>
  <?php if($total > 0): ?>
  <p class="total">total:
    <?= $total; ?>
  </p>
 
  <main class="korpa">
    <?php foreach ($rezultat as $proizvod_korpa):
      $naziv = $proizvod_korpa["naziv"];
      $cena = $proizvod_korpa["cena"];
      $slika = $proizvod_korpa["slika"];
      $racunar_ID = $proizvod_korpa["racunar_ID"];
      $korpa_ID = $proizvod_korpa["korpa_ID"];

      ?>
      <!-- Render Kolicine?? -->
      <form class="korpa-stavka" method="POST" action="obrisi_stavku.php">
        <!-- Render Slike-->
        <img src="image/racunari/<?= $slika; ?>" alt="">
        <!-- Render naziva -->
        <div class="korpa-stavka-detalji">
          <!-- Render Cene -->
          <div class="korpa-stavka-naziv">Naziv:
            <?= $naziv; ?>
          </div>
          <div class="korpa-stavka-cena">Cena: RSD
            <?= $cena; ?>
          </div>
        </div>
        <input type="hidden" name="korpa_ID" value="<?= $korpa_ID; ?>">
        <button class="korpa-stavka-ukloni" type="submit">Obrisi stavku</button>
        <!-- Render dugmeta za brisanje -->
      </form>
    <?php endforeach; ?>

  </main>
  <?php endif; ?>
  <!-- Render Total -->


  <?php include 'footer.php' ?>
</body>

</html>