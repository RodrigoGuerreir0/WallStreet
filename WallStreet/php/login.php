<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
   
    

    
    <div class="page">
        <br>
        <form action="" method="post" class="formLogin">

            <h1>Login</h1>

            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>

            <input type="email" id="" name="Email" placeholder="Digite seu e-mail" autofocus="true" required />

            <label for="password">Senha</label>

            <input type="password" class="" id="" name="Senha" placeholder="Digite sua senha" minlength="8" maxlength="200" required>

            <a href="./Esqueci_Minha_Senha.php">Esqueci minha senha</a>

            <input type="submit" value="Acessar" class="btn" />
            <center>

            <p class="FINAL">Não possui uma conta? <a href="./cadastro.php" >Cadastre-se</a></p>
        </center>
        
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
            header("Location: ./inicio.php");
        } else {
            echo  "<script>alert('E-mail ou senha incorretos!');</script>";
        }
    }
    ?>
</body>

</html>
