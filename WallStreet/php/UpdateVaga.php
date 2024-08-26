<?php
try {
    // Conexão com o banco de dados usando PDO
    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém os parâmetros
    $vaga = $_GET['vaga'];
    $status = $_GET['status'];

    // Atualiza o status da vaga
    $sql = "UPDATE Vagas SET StatusDaVaga=:status WHERE Vaga=:vaga";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':vaga', $vaga);
    $stmt->execute();

    echo "Status da vaga atualizado com sucesso";
} catch (PDOException $e) {
    echo "Erro ao atualizar status da vaga: " . $e->getMessage();
}
?>
