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
        <h1 class="text-center">Tampil Antrean</h1>
        <div class="text-center">
            <span id="clock"></span> | <span id="countdown"></span>
        </div>
        <hr>
        <div class="row">
            <?php foreach ($layanans as $layanan) : ?>
                <div class="col-md-3 mt-1">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-text text-center"><?= $layanan->layanan ?></h3>
                            <?php
                            $dt = Illuminate\Support\Carbon::now();
                            $antrean_menunggu = App\Models\Antrean::where(function ($query) {
                                $query->where('status', '=', 'memanggil');
                                $query->orWhere('status', '=', 'selesai');
                            })
                                ->where('layanan_id', '=', $layanan->id)
                                ->whereDate('tanggal_ambil', '=', $dt->toDateString())
                                ->orderBy('updated_at', 'DESC')
                                ->first();
                            ?>
                            <?php if ($antrean_menunggu) : ?>
                                <h1 class="card-text text-center"><?= $antrean_menunggu->nomor ?></h1>
                                <h6 class="card-text text-center"><?= $antrean_menunggu->tanggal_ambil ?></h6>
                            <?php else : ?>
                                <h1 class="card-text text-center">0</h1>
                                <h6 class="card-text text-center">-</h6>
                            <?php endif ?>
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
            var date = now.toDateString();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Add leading zeros if needed
            hours = (hours < 10) ? '0' + hours : hours;
            minutes = (minutes < 10) ? '0' + minutes : minutes;
            seconds = (seconds < 10) ? '0' + seconds : seconds;

            var timeString = date + ' ' + hours + ':' + minutes + ':' + seconds;

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
</body>

</html>