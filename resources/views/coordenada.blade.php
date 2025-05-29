<form id="ubicacionForm" method="POST" action="{{ route('tiendas_cercanas') }}">
    @csrf
    <input type="hidden" name="coordenada" id="coordenada">
</form>

<script>
window.onload = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;
            document.getElementById('coordenada').value = lon + ';' + lat;
            document.getElementById('ubicacionForm').submit();
        });
    } else {
        // Si no hay geolocalización, puedes enviar una coordenada por defecto o mostrar un mensaje
        document.getElementById('ubicacionForm').submit();
    }
};
</script>