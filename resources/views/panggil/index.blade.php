Loket
<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="<?= route('panggil') ?>">-PILIH LOKET-</option>
    <?php foreach ($lokets as $loket) : ?>
        <?php foreach ($loket->layanans as $layanan) : ?>
            <option value="<?= route('panggil', ['layanan_id' => $layanan->id, 'loket_id' => $loket->id]) ?>" <?= $layanan->id === $layanan_id && $loket->id === $loket_id ? 'selected' : '' ?>><?= $loket->loket . ' - ' .  $layanan->layanan ?></option>
        <?php endforeach ?>
    <?php endforeach ?>
</select>
<span id="clock"></span> | <span id="countdown"></span>
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
                <a href="<?= route('panggil', ['layanan_id' => $layanan_id, 'loket_id' => $loket_id, 'antrean_id' => $antrean->id]) ?>">
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
    </tr>
    <?php foreach ($antrean_memanggil as $antrean) : ?>
        <tr>
            <td><?= $antrean->layanan->layanan ?></td>
            <td><?= $antrean->tanggal_ambil ?></td>
            <td><?= $antrean->nomor ?></td>
            <td></td>
        </tr>
    <?php endforeach ?>
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

    // Start countdown with 10 seconds
    countdownReload(10);
</script>