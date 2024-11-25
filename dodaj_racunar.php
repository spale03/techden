<?php
include 'database.php';
include 'adminchecker.php';
#ako su setovani parametri naziv, cena, slika i nije setovan parametar izmeni insertuj u bazu podataka u tabelu racunar podake o racunaru
if (isset ($_POST['naziv'], $_POST['cena'], $_POST['slika']) && !isset ($_POST['izmeni'])) {

    $sql = "INSERT into racunari (naziv,cena,slika,broj_pregleda,broj_kupovina) VALUES (:naziv, :cena, :slika, :broj_pregleda, :broj_kupovina)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":naziv", $_POST["naziv"]);
    $stmt->bindParam(":cena", $_POST["cena"]);
    $stmt->bindParam(":slika", $_POST["slika"]);
    $stmt->bindParam(":broj_pregleda", $_POST["broj_pregleda"]);
    $stmt->bindParam(":broj_kupovina", $_POST["broj_kupovina"]);
    if ($stmt->execute()) {
        header("location: administrator.php?racunar=1");
    } else {
        header("location: administrator.php?racunar=0");
    }


} elseif (isset ($_POST['izmeni'], $_POST['naziv'], $_POST['cena'], $_POST['slika'])) {
    // ako su setovani parametri izmeni naziv cena i slika updatujemo tabelu racunar
    $sql = 'UPDATE racunari
    SET cena = :cena, naziv = :naziv, slika = :slika, broj_pregleda = :broj_pregleda, broj_kupovina = :broj_kupovina
    WHERE racunar_ID = :racunar_ID;';
// sliku nemoj da updatas u slucaju da je polje za sliku prazno
    if ($_POST['slika'] == ''):
        $sql = 'UPDATE racunari
    SET cena = :cena, naziv = :naziv, broj_pregleda = :broj_pregleda, broj_kupovina = :broj_kupovina
    WHERE racunar_ID = :racunar_ID;';
    endif;

    $stmt = $pdo->prepare($sql);
    #ako slika nije prazna binduj parametar
    if ($_POST['slika'] !== '')
        $stmt->bindParam(':slika', $_POST['slika']);
    $stmt->bindParam(':cena', $_POST['cena']);
    $stmt->bindParam(':naziv', $_POST['naziv']);
    $stmt->bindParam(':racunar_ID', $_POST['racunar_ID']);
    $stmt->bindParam(':broj_pregleda', $_POST['broj_pregleda']);
    $stmt->bindParam(':broj_kupovina', $_POST['broj_kupovina']);
    
    if ($stmt->execute()) {
        header('location: administrator.php?racunar=1');
    } else {
        header('location: administrator.php?racunar=0');
    }


}


