Loket
<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="<?= route('panggil') ?>">-PILIH LOKET-</option>
    <?php foreach ($lokets as $loket) : ?>
        <option value="<?= route('panggil', ['loket_id' => $loket->id]) ?>" <?= $loket->id === $loket_id ? 'selected' : '' ?>><?= $loket->loket . ' - ' .  $loket->layanan->layanan ?></option>
    <?php endforeach ?>
</select>
<hr>
Menunggu
<table>
    <tr>
        <th>Layanan</th>
        <th>Tanggal</th>
        <th>Nomor</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($antrean_menunggu as $antrean) : ?>
        <tr>
            <td><?= $antrean->layanan->layanan ?></td>
            <td><?= $antrean->tanggal_ambil ?></td>
            <td><?= $antrean->nomor ?></td>
            <td>
                <a href="<?= route('panggil', ['loket_id' => $loket_id, 'antrean_id' => $antrean->id]) ?>">
                    Panggil
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<hr>
Memanggil
<table>
    <tr>
        <th>Layanan</th>
        <th>Tanggal</th>
        <th>Nomor</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($antrean_memanggil as $antrean) : ?>
        <tr>
            <td><?= $antrean->layanan->layanan ?></td>
            <td><?= $antrean->tanggal_ambil ?></td>
            <td><?= $antrean->nomor ?></td>
            <td>
                <a href="<?= route('panggil', ['loket_id' => $loket_id, 'antrean_id' => $antrean->id]) ?>">
                    Panggil Ulang
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</table>