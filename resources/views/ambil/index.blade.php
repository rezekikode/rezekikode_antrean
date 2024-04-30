<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Antrean</title>
    <!-- Tambahkan referensi ke file CSS bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Gunakan komponen bootstrap untuk membuat tampilan yang responsif -->
    <div class="container">
        <h1 class="text-center">Ambil Antrean</h1>
        <div class="row">
            <?php foreach ($layanans as $layanan) : ?>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= route('ambil', ['id' => $layanan->id]) ?>">
                                <h3 id="queue-number" class="card-text text-center"><?= $layanan->layanan ?></h3>
                            </a>                            
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- Tambahkan referensi ke file JS bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>