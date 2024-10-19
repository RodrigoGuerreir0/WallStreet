<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Esqueci_Minha_Senha.css">
    <script src="../javascript/cadastro.js"></script>
    <title>Esqueci minha senha</title>
</head>

<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="./TrocarSenha.php" method="post">
            <h2>Esqueci minha senha</h2>
            <div class="inputBox">
                <input type="text" oninput="mascara(this)" id="cpf" name="cpf" maxlength="11" minlength="10" required="required">
                <span>CPF</span>
                <i></i>
            </div>

            <div class="links">
                <a href="">Digite seu cpf</a>
                <a href=""></a>
            </div>
            <div class="centralizarButton">
                <input type="submit" value="Verfifcar">
            </div>
        </form>
    </div>
</body>

</html>