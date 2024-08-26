<?php
if (isset($_POST["id"])) {
    $id_endereco = $_POST["id"];

    echo $id_endereco;

$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

$sql = "DELETE FROM Endereco WHERE id = '$id_endereco' ";
$stmt = $conexao->prepare($sql);
$stmt->execute();
header("location:perfil.php");
}

?>
