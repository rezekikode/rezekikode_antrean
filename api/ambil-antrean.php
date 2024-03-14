<?php

$id_lokasi = 0;
$id_loket = 0;
$metode = $_SERVER['REQUEST_METHOD'];

if ($metode !== 'post') {
    die('Metode tidak sesuai');
}