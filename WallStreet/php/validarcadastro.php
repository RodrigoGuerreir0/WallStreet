<?php
if (isset($_POST["Nome"], $_POST["DataNascimento"], $_POST["Genero"], $_POST["Cpf"], $_POST["Telefone"], $_POST["Email"], $_POST["Usuario"], $_POST["Senha"], $_POST["ConfirmarSenha"])) {
    $Nome = $_POST["Nome"];
    $DataNascimento = $_POST["DataNascimento"];
    $Genero = $_POST["Genero"];
    $Cpf = $_POST["Cpf"];
    $Telefone = $_POST["Telefone"];
    $Email = $_POST["Email"];
    $Usuario = $_POST["Usuario"];
    $Senha = $_POST["Senha"];
    $ConfirmarSenha = $_POST["ConfirmarSenha"];
    $Funcao = "Usuario";

    try {
        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

        if ($Senha == $ConfirmarSenha) {
            $verificarUsuario = $conexao->prepare("SELECT * FROM Perfil WHERE Usuario = :Usuario OR Cpf = :Cpf OR Email = :Email");
            $verificarUsuario->bindParam(":Usuario", $Usuario);
            $verificarUsuario->bindParam(":Email", $Email);
            $verificarUsuario->bindParam(":Cpf", $Cpf);
            $verificarUsuario->execute();

            if ($verificarUsuario->rowCount() > 0) {
                echo '<script>alert("Usuário, CPF ou E-mail já existem."); window.location.href = "./cadastro.php";</script>';
            } else {
                $comandoSQL = $conexao->prepare("INSERT INTO Perfil (Nome, DataNascimento, Genero, Cpf, Telefone, Email, Usuario, Senha, Funcao) 
                                                VALUES (:Nome, :DataNascimento, :Genero, :Cpf, :Telefone, :Email, :Usuario, :Senha, :Funcao)");
                $comandoSQL->bindParam(":Nome", $Nome);
                $comandoSQL->bindParam(":DataNascimento", $DataNascimento);
                $comandoSQL->bindParam(":Genero", $Genero);
                $comandoSQL->bindParam(":Cpf", $Cpf);
                $comandoSQL->bindParam(":Telefone", $Telefone);
                $comandoSQL->bindParam(":Email", $Email);
                $comandoSQL->bindParam(":Usuario", $Usuario);
                $comandoSQL->bindParam(":Senha", $Senha);
                $comandoSQL->bindParam(":Funcao", $Funcao);
                $comandoSQL->execute();

                $idUsuario = $conexao->lastInsertId();

                $comandoSQL = $conexao->prepare("INSERT INTO Endereco (IdUsuario, Apelido, Cep, Rua, Bairro, Cidade, Estado, Numero) 
                                                  VALUES (:IdUsuario, 'SENAI', '13456-166', 'Rua Vereador Sérgio Leopoldino Alves', 'Distrito Industrial', 'Santa Bárbara d Oeste', 'SP', 500)");
                $comandoSQL->bindParam(":IdUsuario", $idUsuario);
                $comandoSQL->execute();

                header("Location: ./login.php");
            }
        } else {
            echo '<script>alert("As senhas não são idênticas.");';
            header("Location: ./cadastro.php");
        }
    } catch (PDOException $e) {
        echo '<script>alert("Erro: ' . $e->getMessage() . '"); window.location.href = "./cadastro.php";</script>';
    }
}
?>
