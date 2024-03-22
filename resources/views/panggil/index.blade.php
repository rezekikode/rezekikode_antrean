Loket
<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="<?= route('panggil') ?>">-PILIH LOKET-</option>
    <?php foreach ($lokets as $loket) : ?>
        <option value="<?= route('panggil', ['loket_id' => $loket->id]) ?>" <?= $loket->id === $loket_id ? 'selected' : '' ?>><?= $loket->loket . ' - ' .  $loket->layanan_id ?></option>
    <?php endforeach ?>
</select>
<hr>
<?php foreach ($antreans as $antrean) : ?>
    <a href="<?= route('panggil', ['loket_id' => $loket_id, 'antrean_id' => $antrean->id]) ?>"><?= $antrean->layanan_id . ' - ' .  $antrean->nomor ?></a><br>    
<?php endforeach ?>