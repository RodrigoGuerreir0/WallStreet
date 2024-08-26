<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Vagas</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSr8SFxD03BRdriVAXeemLLaB1iop7Tmk&callback=initMap" async defer></script>
    <script>
        function initMap() {
            const sensors = [
                { lat: -22.7570025, lng: -47.3839586 },
                { lat: -22.7580828, lng: -47.3831891 },
                { lat: -22.7578661, lng: -47.3844843 }
            ];

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: sensors[0],
                mapTypeId: 'roadmap',
            });

            const markers = sensors.map((sensor, index) => {
                const marker = new google.maps.Marker({
                    position: sensor,
                    map: map,
                    title: 'Vaga',
                    icon: {
                        url: 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E',
                        scaledSize: new google.maps.Size(20, 20),
                    },
                });
                return marker;
            });

            setInterval(() => {
                fetch('vagas.php')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach((vaga, index) => {
                            const iconUrl = vaga.StatusDaVaga === 'Livre'
                                ? 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E'
                                : 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';
                            markers[index].setIcon({
                                url: iconUrl,
                                scaledSize: new google.maps.Size(20, 20),
                            });
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }, 1000);
        }
    </script>
</head>
<body>
    <div id="map" style="height: 100vh; width: 100%;"></div>
</body>
</html>
