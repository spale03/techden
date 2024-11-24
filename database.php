<?php
$server = "localhost";
$dbname = "techden";
$username = "root";
$password = "";

$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// povezujemo se na bazu podataka 