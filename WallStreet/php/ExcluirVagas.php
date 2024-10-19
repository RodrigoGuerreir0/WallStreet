<?php
if (isset($_POST["id"])) {
    $IdVaga = $_POST["id"];

    echo $IdVaga;
$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

$sql = "DELETE FROM Vagas WHERE id = '$IdVaga' ";
$stmt = $conexao->prepare($sql);
$stmt->execute();
header("location:inicio.php");
}

?>
