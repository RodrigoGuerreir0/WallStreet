<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
?>

    <!-- Caso a pessoa nao tiver loogado em nenhum usuario, so ira aparecer o qie estiver dentro desse if acima -->


    <h2>Você ainda não esta logado faça seu login</h2>
    <a href="./login.php">Login</a>
<?php
    //    header("Location: ./login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Bem-vindo</title>
</head>

<body>
    <h1>Bem-vindo,
        <?php echo $_SESSION['Usuario']; ?>!</h1>
    <a href="./deslogar.php">Logout</a>
</body>

</html>