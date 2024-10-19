<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="" method="post">
            <h2>Login</h2>
            <div class="inputBox">
                <input type="text" name="Email" required="required">
                <span>Email</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="password" name="Senha" required="required">
                <span>Senha</span>
                <i></i>
            </div>

            <div class="links">
                <a href="./Esqueci_Minha_Senha.php">Esquecei minha senha</a>
                <a href="./cadastro.php">Cadastrar-se</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
    <?php
    if (isset($_POST["Email"], $_POST["Senha"])) {
        $Email = $_POST["Email"];
        $Senha = $_POST["Senha"];

        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $verificarLogin = $conexao->prepare("SELECT Usuario FROM Perfil WHERE Email = :Email AND Senha = :Senha");
        $verificarLogin->bindParam(":Email", $Email);
        $verificarLogin->bindParam(":Senha", $Senha);
        $verificarLogin->execute();

        if ($verificarLogin->rowCount() > 0) {
            $usuario = $verificarLogin->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['Usuario'] = $usuario['Usuario'];
            header("Location: ../php/inicio.php");
        } else {
            echo  "<script>alert('E-mail ou senha incorretos!');</script>";
        }
    }
    ?>
</body>

</html>