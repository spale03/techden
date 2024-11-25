<?php
include "database.php";

$sql = "SELECT naziv, broj_pregleda, broj_kupovina from racunari";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rezultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT DATE_FORMAT(created_at, '%M-%Y') AS datum, COUNT(*) AS broj_korisnika
        FROM users
        GROUP BY datum
        ORDER BY datum";


$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$rezultat2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


$nazivi = [];
$pregledi = [];
$kupovine = [];
$datumi = [];
$korisnici = [];



foreach ($rezultat as $racunar) {

    $nazivi[] = $racunar['naziv'];
    $pregledi[] = $racunar['broj_pregleda'];
    $kupovine[] = $racunar['broj_kupovina'];
}


foreach ($rezultat2 as $users) {

    $datumi[] = $users['datum'];
    $korisnici[] = $users['broj_korisnika'];
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="canvas-container">
        <div>
            <canvas id="pieChart" style="max-width:50vh;max-height:50vh;"></canvas>
        </div>
        <div>

            <canvas id="pieChart2" style="max-width:50vh;max-height:50vh;"></canvas>
        </div>
        <div>

            <canvas id="barChart" style="max-width:50vh;max-height:50vh;"></canvas>
        </div>

    </div>
    <script>
        const canvas = document.getElementById('pieChart').getContext('2d');
        const canvas2 = document.getElementById('pieChart2').getContext('2d');
        const canvas3 = document.getElementById('barChart').getContext('2d');
        const options = {
            plugins: {
                title: {
                    display: true,
                    font: {
                        size: 5
                    }
                },
                subtitle: {
                    display: true,
                    font: {
                        size: 3
                    }
                }
            }
        };
        const dataPregleda = {
            datasets: [{
                data: <?= json_encode($pregledi); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
            }],
            labels: <?= json_encode($nazivi); ?>,
        };
        const dataKupovine = {
            datasets: [{
                data: <?= json_encode($kupovine); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
            },
            ],
            labels: <?= json_encode($nazivi); ?>,
        };





        const chart = new Chart(canvas, {
            type: 'pie',
            data: dataPregleda,
            // options
        });

        const chart2 = new Chart(canvas2, {
            type: 'pie',
            data: dataKupovine,
            options
        });

        const chart3 = new Chart(canvas3, {
            type: 'line',
            data: {
                labels: <?= json_encode($datumi); ?>,
                datasets: [{
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,

                    label: "Broj korisnika",
                    data: <?= json_encode($korisnici); ?>

                }]
            }

        })



    </script>
</body>

</html>