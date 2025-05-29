
<script>
    function enviarUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;

            fetch("guardar_sesion.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "lat=" + lat + "&lon=" + lon
            })
            .then(response => response.text())
            .then(data => console.log(data));
        });
    } else {
        console.log("Geolocalización no soportada.");
    }
}
</script>

<?php
# to geocode an address. You can find the full documentation at https://opencagedata.com/tutorials/geocode-in-php


