<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/TrocarSenha.css">
    <title>Alterar Senha</title>
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

    ?>
                    <div class="box">
                        <span class="borderLine"></span>
                        <form action="" method="post">
                            <h2>Digite sua nova senha</h2>
                            <div class="inputBox">
                                <input type="hidden" name="CpfCadastrado" value="<?php echo htmlspecialchars($cpf); ?>">
                                <input type="password" id="novaSenha" name="NovaSenha" required="required">
                                <span>Nova Senha</span>
                                <i></i>
                            </div>

                            <div class="inputBox">
                                <input type="password" id="confirmarNovaSenha" name="ConfirmarNovaSenha" required="required">
                                <span>Confirmar Senha</span>
                                <i></i>
                            </div>

                            <div class="links">
                                <a href="./Esqueci_Minha_Senha.php"></a>
                                <a href="./cadastro.php"></a>
                            </div>
                            <div class="centralizarButton">
                                <input type="submit" value="Alterar Senha">
                            </div>
                        </form>
                    </div>
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
                header("Location: ./login.php");
            } else {
                echo "As senhas não são idênticas";
            }
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
</body>
<script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = passwordField.nextElementSibling;

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = "password";
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

</html>