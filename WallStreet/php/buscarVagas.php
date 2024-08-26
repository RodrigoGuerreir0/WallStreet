<?php
header('Content-Type: application/json');

// Conecte-se ao banco de dados
$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cep = isset($_GET['cep']) ? $_GET['cep'] : '';

if ($cep) {
    // Geocodificar o CEP para obter as coordenadas
    $apiKey = 'AIzaSyCSr8SFxD03BRdriVAXeemLLaB1iop7Tmk';
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($cep) . ",BR&key=" . $apiKey;
    
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    
    if ($data['status'] === 'OK' && !empty($data['results'])) {
        $location = $data['results'][0]['geometry']['location'];
        $latitude = $location['lat'];
        $longitude = $location['lng'];
        
        // Buscar vagas perto das coordenadas
        $sql = "SELECT id, Latitude, Longitude, StatusDaVaga FROM Vagas WHERE ST_Distance_Sphere(POINT(Longitude, Latitude), POINT(:longitude, :latitude)) < 1000";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->execute();
        
        $vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($vagas);
    } else {
        echo json_encode(['error' => 'CEP não encontrado.']);
    }
} else {
    echo json_encode(['error' => 'CEP inválido.']);
}
