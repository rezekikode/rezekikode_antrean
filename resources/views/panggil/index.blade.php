Layanan
<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="<?= route('panggil') ?>">-PILIH LAYANAN-</option>
    <?php foreach ($layanans as $layanan) : ?>
        <option value="<?= route('panggil', ['lokasi_id' => $lokasi_id, 'layanan_id' => $layanan->id, 'loket_id' => $loket_id]) ?>" <?= $layanan->id === $layanan_id ? 'selected' : '' ?>><?= $layanan->layanan ?></option>
    <?php endforeach ?>
</select>
<span id="clock"></span> | <span id="countdown"></span>
<hr>
<table>
    <tr valign="top">
        <td width="50%">
            Menunggu
            <table border="1">
                <tr>
                    <th>Layanan</th>
                    <th>Tanggal Ambil</th>
                    <th>Jam Ambil</th>
                    <th>Nomor</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($antrean_menunggu as $antrean) : ?>
                    <tr>
                        <td><?= $antrean->layanan->layanan ?></td>
                        <td><?= $antrean->tanggal_ambil ?></td>
                        <td><?= $antrean->jam_ambil ?></td>
                        <td><?= $antrean->nomor ?></td>
                        <td>
                            <a href="<?= route('panggil', ['layanan_id' => $layanan_id, 'loket_id' => $loket_id, 'antrean_id' => $antrean->id]) ?>">
                                Panggil
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            Selesai
            <table border="1">
                <tr>
                    <th>Layanan</th>
                    <th>Tanggal Ambil</th>
                    <th>Jam Ambil</th>
                    <th>Nomor</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($antrean_selesai as $selesai) : ?>
                    <tr>
                        <td><?= $selesai->layanan->layanan ?></td>
                        <td><?= $selesai->tanggal_ambil ?></td>
                        <td><?= $selesai->jam_ambil ?></td>
                        <td><?= $selesai->nomor ?></td>
                        <td>
                            <a href="<?= route('panggil', ['layanan_id' => $layanan_id, 'loket_id' => $loket_id, 'antrean_id' => $selesai->id]) ?>">
                                Panggil Lagi
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </td>
        <td width="50%">
            Memanggil
            <table border="1">
                <tr>
                    <th>Layanan</th>
                    <th>Loket</th>
                    <th>Tanggal Panggil</th>
                    <th>Jam Panggil</th>
                    <th>Nomor</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($antrean_memanggil as $memanggil) : ?>
                    <tr>
                        <td><?= $memanggil->antrean->layanan->layanan ?></td>
                        <td><?= $memanggil->loket->loket ?></td>
                        <td><?= $memanggil->tanggal_panggil ?></td>
                        <td><?= $memanggil->jam_panggil ?></td>
                        <td><?= $memanggil->antrean->nomor ?></td>
                        <td>
                            <a href="<?= route('selesai', ['layanan_id' => $layanan_id, 'loket_id' => $loket_id, 'antrean_panggil_id' => $memanggil->id]) ?>">
                                Selesai
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </td>
    </tr>
</table>

<script>
    // Countdown function
    function countdownReload(seconds) {
        var countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            countdownElement.innerHTML = 'Dimuat ulang dalam ' + seconds + ' detik';
            seconds--;

            if (seconds < 0) {
                clearInterval(interval);
                // Reload the page
                location.reload();
            }
        }

        // Initial call to display the first second
        updateCountdown();

        // Update the countdown every second
        var interval = setInterval(updateCountdown, 1000);
    }

    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Add leading zeros if needed
        hours = (hours < 10) ? '0' + hours : hours;
        minutes = (minutes < 10) ? '0' + minutes : minutes;
        seconds = (seconds < 10) ? '0' + seconds : seconds;

        var timeString = hours + ':' + minutes + ':' + seconds;

        // Update the clock element
        document.getElementById('clock').textContent = timeString;
    }

    // Call updateClock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();

    // Start countdown with 5 seconds
    countdownReload(5);
</script>