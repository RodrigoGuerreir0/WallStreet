<?php
header('Content-Type: application/json');

$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

function getDistanceInDegrees($distanceInMeters) {
    return $distanceInMeters / 111000;
}

try {
    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

    $raio_metros = 1000;
    $distancia_latitude = getDistanceInDegrees($raio_metros);
    $distancia_longitude = getDistanceInDegrees($raio_metros / cos(deg2rad($latitude)));

    $latitude_min = $latitude - $distancia_latitude;
    $latitude_max = $latitude + $distancia_latitude;
    $longitude_min = $longitude - $distancia_longitude;
    $longitude_max = $longitude + $distancia_longitude;

    $sql = "SELECT COUNT(*) AS total, 
                   SUM(CASE WHEN StatusDaVaga = 'Livre' THEN 1 ELSE 0 END) AS vagas_livres, 
                   SUM(CASE WHEN StatusDaVaga = 'Ocupado' THEN 1 ELSE 0 END) AS vagas_ocupadas 
            FROM Vagas
            WHERE Latitude BETWEEN :latitude_min AND :latitude_max
            AND Longitude BETWEEN :longitude_min AND :longitude_max";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':latitude_min', $latitude_min);
    $stmt->bindParam(':latitude_max', $latitude_max);
    $stmt->bindParam(':longitude_min', $longitude_min);
    $stmt->bindParam(':longitude_max', $longitude_max);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] == 0) {
        echo json_encode(['message' => 'Nosso sistema não está implementado na região que deseja ir!']);
    } else {
        echo json_encode($result);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
