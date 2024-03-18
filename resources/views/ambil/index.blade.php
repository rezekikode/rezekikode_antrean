<?php foreach ($layanans as $layanan) : ?>
    <a href="<?= route('ambil', ['id' => $layanan->id]) ?>"><?= $layanan->layanan ?></a>
<?php endforeach ?>