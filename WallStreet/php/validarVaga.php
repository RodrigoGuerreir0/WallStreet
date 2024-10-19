<?php
if (isset($_POST["Vaga"], $_POST["StatusDaVaga"], $_POST["Latitude"], $_POST["Longitude"])) {
    $Vaga = $_POST["Vaga"];  
    $StatusDaVaga = $_POST["StatusDaVaga"];
    $Latitude = $_POST["Latitude"];
    $Longitude = $_POST["Longitude"];


    try {
        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
        $comandoSQL = $conexao->prepare("INSERT INTO Vagas (Vaga, StatusDaVaga, Latitude, Longitude) 
                                            VALUES (:Vaga, :StatusDaVaga, :Latitude, :Longitude)");
        $comandoSQL->bindParam(":Vaga", $Vaga);
        $comandoSQL->bindParam(":StatusDaVaga", $StatusDaVaga);
        $comandoSQL->bindParam(":Latitude", $Latitude);
        $comandoSQL->bindParam(":Longitude", $Longitude);
        $comandoSQL->execute();

        header("Location: ./inicio.php");
        exit;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage(); 
    }
}
?>
