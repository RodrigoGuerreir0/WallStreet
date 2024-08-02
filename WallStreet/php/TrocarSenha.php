<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    try {
        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if (isset($_POST["cpf"])) {
            $cpf = $_POST["cpf"];

            $AcharUsuario = $conexao->prepare("SELECT Usuario FROM Perfil WHERE CPF = :CpfCadastrado");
            $AcharUsuario->bindParam(':CpfCadastrado', $cpf);
            $AcharUsuario->execute();

            $resultado = $AcharUsuario->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado) {
                foreach ($resultado as $Usuario) {
                    echo $Usuario["Usuario"];
                    ?>
                    <form action="#" method="post">
                        <input type="hidden" name="CpfCadastrado" value="<?php echo htmlspecialchars($cpf); ?>">
                        <input type="password" name="NovaSenha" placeholder="Nova Senha" required>
                        <input type="password" name="ConfirmarNovaSenha" placeholder="Confirmar Nova Senha" required>
                        <input type="submit" value="Alterar Senha">
                    </form>
                    <?php
                }
            } else {
                echo "Usuário não cadastrado";
            }
        }

        if (isset($_POST["NovaSenha"], $_POST["ConfirmarNovaSenha"], $_POST["CpfCadastrado"])) {
            $novaSenha = $_POST["NovaSenha"];
            $confirmarNovaSenha = $_POST["ConfirmarNovaSenha"];
            $cpf = $_POST["CpfCadastrado"];

            if ($novaSenha === $confirmarNovaSenha) {

                

                $MudarSenha = $conexao->prepare("UPDATE Perfil SET Senha = :Senha WHERE CPF = :CpfCadastrado");
                $MudarSenha->bindParam(':Senha', $novaSenha);
                $MudarSenha->bindParam(':CpfCadastrado', $cpf);
                $MudarSenha->execute();
                echo 'Senha Atualizada';
            } else {
                echo "As senhas não são idênticas";
            }
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
</body>
</html>