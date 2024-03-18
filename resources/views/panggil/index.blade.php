<?php foreach ($antreans as $antrean) : ?>
    <a href="<?= route('panggil', ['id' => $antrean->id]) ?>"><?= $antrean->layanan_id . ' - ' .  $antrean->nomor ?></a>
    <hr>
<?php endforeach ?>