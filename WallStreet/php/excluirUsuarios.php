<?php
session_start();

if (!isset($_SESSION['Usuario'])) {
}

$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nomeUsuario = $_SESSION['Usuario'];

$sql = "SELECT id FROM Perfil WHERE Usuario = :Usuario";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':Usuario', $nomeUsuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $idUsuarioLogado = $usuario['id'];

    if (isset($_POST["id"])) {
        $idParaExcluir = $_POST["id"];

        if ($idParaExcluir != $idUsuarioLogado) {
            try {
                $deletarUsuario = "DELETE FROM Perfil WHERE id = :idUsuario";
                $comando = $conexao->prepare($deletarUsuario);
                $comando->bindParam(':idUsuario', $idParaExcluir, PDO::PARAM_INT);
                $comando->execute();

                header("Location: inicio.php");
                exit();
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {
            header("Location: inicio.php");
        }
    }
}
?>


