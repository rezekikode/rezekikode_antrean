<?php

$id_lokasi = 0;
$id_loket = 0;
$id_jenis_loket = 0;
$metode = $_SERVER['REQUEST_METHOD'];

if ($metode !== 'post') {
    die('Metode tidak sesuai.');
}

$query =
    "
    SELECT 
    MAX(nomor) AS nomor
    FROM 
    WHERE 
    id_lokasi = :id_lokasi 
    AND id_loket = :id_loket 
    AND id_jenis_lokasi = :id_jenis_loket
    ";

$nomor_sekarang = $nomor + 1;