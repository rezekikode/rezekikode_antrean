@extends('layouts.admin')

@section('content')
<span id="clock"></span> | <span id="countdown"></span>
<hr>
<div class="row">
    <div class="col">
        <div class="card">
            <h5 class="card-header">Antrean</h5>
            <div class="card-body">
                {{ $totalAntrean }}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Menunggu</h5>
            <div class="card-body">
                {{ $totalAntreanMenunggu }}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Selesai</h5>
            <div class="card-body">
                {{ $totalAntreanSelesai }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Countdown function
    function countdownReload(seconds) {
        function updateCountdown() {
            $('#countdown').text('Dimuat ulang dalam ' + seconds + ' detik');
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
        $('#clock').text(timeString);
    }

    // Call updateClock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();

    // Start countdown with 5 seconds
    countdownReload(5);
</script>
@endsection