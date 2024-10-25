<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb+srv://nexeu:a46hhgsRzD1Y5MrR@deportivo.dqljn.mongodb.net/?retryWrites=true&w=majority&appName=Deportivo");
$database = $mongoClient->selectDatabase('club_deportivo');
$jugadoresCollection = $database->jugadores;
?>