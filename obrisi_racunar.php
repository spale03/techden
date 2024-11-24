<?php
include "adminchecker.php";
include "database.php";


if (isset ($_POST["racunar_ID"])):

    $sql = "DELETE FROM racunari WHERE racunar_ID = :racunar_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":racunar_ID", $_POST["racunar_ID"]);
    if ($stmt->execute()):
        header("location: administrator.php");
    else:
        print_r('Greska u brisanju');

    endif;


endif;