<?php
if (isset($_POST["Nome"], $_POST["DataNascimento"], $_POST["Sexo"], $_POST["Cpf"], $_POST["Telefone"], $_POST["Email"], $_POST["Usuario"], $_POST["Senha"], $_POST["ConfirmarSenha"])) {
    $Nome = $_POST["Nome"];
    $DataNascimento = $_POST["DataNascimento"];
    $Sexo = $_POST["Sexo"];
    $Cpf = $_POST["Cpf"];
    $Telefone = $_POST["Telefone"];
    $Email = $_POST["Email"];
    $Usuario = $_POST["Usuario"];
    $Senha = $_POST["Senha"];
    $ConfirmarSenha = $_POST["ConfirmarSenha"];

    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

    if ($Senha == $ConfirmarSenha) {
        $verificarUsuario = $conexao->prepare("SELECT * FROM Perfil WHERE Usuario = :Usuario OR Cpf = :Cpf OR Email = :Email");
        $verificarUsuario->bindParam(":Usuario", $Usuario);
        $verificarUsuario->bindParam(":Email", $Email);
        $verificarUsuario->bindParam(":Cpf", $Cpf);
        $verificarUsuario->execute();

        if ($verificarUsuario->rowCount() > 0) {
            echo '<script>alert("Usuário, CPF ou E-mail já existem.");</script>';
        } else {
            $comandoSQL = $conexao->prepare("INSERT INTO Perfil (Nome, DataNascimento, Sexo, Cpf, Telefone, Email, Usuario, Senha) 
                                            VALUES (:Nome, :DataNascimento, :Sexo, :Cpf, :Telefone, :Email, :Usuario, :Senha)");
            $comandoSQL->bindParam(":Nome", $Nome);
            $comandoSQL->bindParam(":DataNascimento", $DataNascimento);
            $comandoSQL->bindParam(":Sexo", $Sexo);
            $comandoSQL->bindParam(":Cpf", $Cpf);
            $comandoSQL->bindParam(":Telefone", $Telefone);
            $comandoSQL->bindParam(":Email", $Email);
            $comandoSQL->bindParam(":Usuario", $Usuario);
            $comandoSQL->bindParam(":Senha", $Senha);
            $comandoSQL->execute();
            
            header("Location: ./login.php");
            exit;
        }
    } else {
        echo '<script>alert("As senhas não são idênticas.");</script>';
        header("Location: ./cadastro.php");

    }
}
?>