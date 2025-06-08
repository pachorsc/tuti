<button id="btnUbicacion" onclick="pedirUbicacion()" style="min-width:300px ; min-height: 300px;">Usar mi ubicación</button>
<form id="ubicacionForm" method="POST" action="{{ route('inicio') }}">
    @csrf
    <input type="hidden" name="coordenada" id="coordenada">
</form>
<script>
function pedirUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;
                document.getElementById('coordenada').value = lon + ';' + lat;
                document.getElementById('ubicacionForm').submit();
            },
            function(error) {
                document.getElementById('ubicacionForm').submit();
            }
        );
    } else {
        document.getElementById('ubicacionForm').submit();
    }
}

// Intentar pedir ubicación automáticamente si ya hay permiso
if (navigator.permissions) {
    navigator.permissions.query({name:'geolocation'}).then(function(result) {
        if (result.state === 'granted') {
            pedirUbicacion();
            document.getElementById('btnUbicacion').style.display = 'none';
        }
    });
}
</script>