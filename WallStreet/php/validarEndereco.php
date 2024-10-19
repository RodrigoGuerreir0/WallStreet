<?php
if (isset($_POST["cep"], $_POST["Rua"], $_POST["Bairro"], $_POST["Cidade"], $_POST["Estado"], $_POST["Numero"],  $_POST["IdUsuario"], $_POST["Apelido"])) {
    $cep = $_POST["cep"];  
    $Rua = $_POST["Rua"];
    $Bairro = $_POST["Bairro"];
    $Cidade = $_POST["Cidade"];
    $Estado = $_POST["Estado"];
    $Numero = $_POST["Numero"];
    $IdUsuario = $_POST["IdUsuario"]; 
    $Apelido = $_POST["Apelido"]; 


    try {
        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
        $comandoSQL = $conexao->prepare("INSERT INTO Endereco (IdUsuario, Apelido, Cep, Rua, Bairro, Cidade, Estado, Numero) 
                                            VALUES (:IdUsuario, :Apelido, :Cep, :Rua, :Bairro, :Cidade, :Estado, :Numero)");
        $comandoSQL->bindParam(":IdUsuario", $IdUsuario);
        $comandoSQL->bindParam(":Apelido", $Apelido);
        $comandoSQL->bindParam(":Cep", $cep);
        $comandoSQL->bindParam(":Rua", $Rua);
        $comandoSQL->bindParam(":Bairro", $Bairro);
        $comandoSQL->bindParam(":Cidade", $Cidade);
        $comandoSQL->bindParam(":Estado", $Estado);
        $comandoSQL->bindParam(":Numero", $Numero); 
        $comandoSQL->execute();

        header("Location: ./inicio.php");
        exit;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage(); 
    }
}
?>
