<?php
include "database.php";
include "adminchecker.php";
include "header.php";



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

        <canvas id="pieChart" style="max-width:50vh;max-height:50vh;"></canvas>
        <canvas id="pieChart2" style="max-width:50vh;max-height:50vh;"></canvas>
        <canvas id="barChart" style="max-width:50vh;max-height:50vh;"></canvas>
    </div>

    <script>
        const canvas = document.getElementById('pieChart').getContext('2d');
        const canvas2 = document.getElementById('pieChart2').getContext('2d');
        const canvas3 = document.getElementById('barChart').getContext('2d');
        const options1 = {
            plugins: {
                legend:{display:false},
                title: {
                    text: "Najpopularniji racunar",
                    display: true,
                    font: {
                        size: 30
                    }
                },
          
            }
        };
        const options2 = {
            plugins: {
                legend:{display:false},
                title: {
                    text: "Najprodavaniji racunar",
                    display: true,
                    font: {
                        size: 30
                    }
                },
        
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
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(201, 203, 207, 0.7)',
                    'rgba(255, 99, 71, 0.7)',
                    'rgba(72, 61, 139, 0.7)',
                    'rgba(144, 238, 144, 0.7)',
                    'rgba(255, 140, 0, 0.7)',
                    'rgba(123, 104, 238, 0.7)',
                    'rgba(0, 206, 209, 0.7)',
                    'rgba(240, 230, 140, 0.7)'
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
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(201, 203, 207, 0.7)',
                    'rgba(255, 99, 71, 0.7)',
                    'rgba(72, 61, 139, 0.7)',
                    'rgba(144, 238, 144, 0.7)',
                    'rgba(255, 140, 0, 0.7)',
                    'rgba(123, 104, 238, 0.7)',
                    'rgba(0, 206, 209, 0.7)',
                    'rgba(240, 230, 140, 0.7)'
                ],
            },
            ],
            labels: <?= json_encode($nazivi); ?>,
        };





        const chart = new Chart(canvas, {
            type: 'pie',
            data: dataPregleda,
            options:options1
        });

        const chart2 = new Chart(canvas2, {
            type: 'pie',
            data: dataKupovine,
            options: options2
        });
        
        const chart3 = new Chart(canvas3, {
            type: 'line',
            data: {
                labels: <?= json_encode($datumi); ?>,
                datasets: [{
                    fill: false, // Bez popunjavanja ispod linije
                    borderColor: 'rgba(255, 0, 0, 1)', // Crvena linija
                    borderWidth: 2, // Debljina linije
                    tension: 0.1, // Glatkoća linije
                    label: "Broj korisnika",
                    data: <?= json_encode($korisnici); ?>
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font:{
                                size:30,
                            },
                            color: '#000' // Crni tekst u legendi
                            
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)' // Svetlo siva mreža
                        },
                        ticks: {
                            color: '#000' // Crni tekst na x-osi
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)' // Svetlo siva mreža
                        },
                        ticks: {
                            color: '#000' // Crni tekst na y-osi
                        }
                    }
                },
                layout: {
                    backgroundColor: 'rgba(255, 255, 255, 1)' // Bela pozadina (Chart.js nema direktan property za pozadinu, ali ovo ide preko CSS-a za <canvas>)
                }
            }
        });



    </script>
</body>


</html>