<?php

require_once __DIR__ . '/../database.php';

$id_lokasi = 0;
$id_layanan = 0;
$metode = $_SERVER['REQUEST_METHOD'];

if ($metode !== 'post') {
    die('Metode tidak sesuai.');
}

$query =
    "
    SELECT 
    MAX(nomor) AS nomor
    FROM 
    antrean
    WHERE 
    lokasi_id = :lokasi_id 
    AND layanan_id = :layanan_id
    ";

$nomor_sekarang = $nomor + 1;