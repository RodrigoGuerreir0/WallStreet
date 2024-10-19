<?php
session_start();

if (!isset($_SESSION['Usuario'])) {

 echo "<title>Faça seu Login</title>";
 echo "<link rel='stylesheet' href='../css/home.css'>";
 echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>"; // Inclua o Font Awesome

 echo "<div class='semLogin'>";
 echo "<div class='page'>";
 echo "<form action='login.php' method='post' id='loginForm' class='formLogin'>";
?>

    <!-- Adiciona o ícone de fechamento no topo do formulário -->
   
    <img src="../img/SemLogin.png" alt="" width="40%" class="imgSl">
    <h1>Você ainda não está logado. Faça seu login</h1>
    <button type="submit" class="btn3">Login</button>
    <a href="./login.php">Login</a>
<?php
    exit();
    
 echo "</form>";
 echo "</div>";
 echo "</div>";
}

$usuario = $_SESSION['Usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["Codigo"], $_POST["Nome"], $_POST["Email"], $_POST["Telefone"])) {

        $Id = $_POST["Codigo"];
        $novoNome = $_POST['Nome'];
        $novoEmail = $_POST['Email'];
        $novoTelefone = $_POST['Telefone'];

        $conexao = new PDO("mysql:host=localhost;dbname=WallStreet", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conexao->prepare("SELECT * FROM Perfil WHERE id = :id");
        $stmt->bindParam(':id', $Id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $conexao->prepare("UPDATE Perfil SET Nome = :Nome, Email = :Email, Telefone = :Telefone WHERE id = :id");
            $stmt->bindParam(':Nome', $novoNome);
            $stmt->bindParam(':Email', $novoEmail);
            $stmt->bindParam(':Telefone', $novoTelefone);
            $stmt->bindParam(':id', $Id);
            $stmt->execute();

            echo "Dados atualizados com sucesso!";
            header("Location: perfil.php");
            exit();
        } else {
            echo "Usuário não encontrado.";
        }
    }
}

try {
    $conexao = new PDO("mysql:host=localhost;dbname=WallStreet", "root", "");

    $stmt = $conexao->prepare("SELECT * FROM Perfil WHERE Usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $InformacaoDoUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Inclua jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua o jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="../javascript/mobilehome.js"></script>
    <title>Perfil</title>
</head>


    
<header>
    <nav>
        <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
        <a class="logo" href="inicio.php"><font class="a2">Edite seu perfil, </font><font class="color"><?php echo $_SESSION['Usuario']; ?></font>!</a>

        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul class="nav-list">
            <li><a class="li_A" href="inicio.php"><i class="fas fa-home fa-2x"></i></a></li>
            
            <li><a class="li_A" href="perfil.php" title="Perfil"><i class="fa fa-user fa-2x"></i></a></li>
        </ul>
    </nav>
</header>

<main>
        <div class="page">
        <?php if (isset($InformacaoDoUsuario)) { ?>

            <form method="POST" action="" class="formLogin">
                <input type="hidden" name="Codigo" value="<?php echo ($InformacaoDoUsuario['id']); ?>">
                <label for="Nome" class="Bperfil">Nome</label>
                <input type="text" id="Nome" name="Nome" value="<?php echo ($InformacaoDoUsuario['Nome']); ?>" required>
                <br>
                <label for="Email" class="Bperfil">Email</label>
                <input type="email" id="Email" name="Email" value="<?php echo ($InformacaoDoUsuario['Email']); ?>" required>
                <br>
                <label for="Telefone" class="Bperfil">Telefone</label>
                <input type="text" id="Telefone" name="Telefone" value="<?php echo ($InformacaoDoUsuario['Telefone']); ?>" required>
                <br>
                <label for="Usuario" class="Bperfil">Usuário</label>
                <input type="text" id="Usuario" name="Usuario" value="<?php echo ($InformacaoDoUsuario['Usuario']); ?>" readonly>
                <input type="submit" value="Atualizar" class="btn">
            </form>
        <?php } else { ?>
            <p>Não foi possível recuperar as informações do usuário.</p>
        <?php } ?>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            $('#Telefone').mask('(00) 00000-0000');
        });
    </script>


        
<footer>
    <div class="container-footer">
        <div class="row-footer">
            <div class="footer-col">
                <h4>WallStreet</h4>
                <ul>
                    <li><a href="sobreNos.php">Quem somos</a></li>
                    <li><a href="#">Nossos serviços</a></li>
                    <li><a href="PoliticaDePrivacidade.php" target="_blank">Política de privacidade</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contato</h4>
                <ul>
                    <li><a href="https://api.whatsapp.com/send?phone=5519992561004&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19) 99256-1004</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=5519971388368&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19) 97138-8368</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=5519992729339&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19) 99272-9339</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>estacionamento</h4>
                <ul>
                    <li><a href="Comofunciona.php">Como funciona</a></li>
                    <li><a href="#">Benefícios</a></li>
                    <li><a href="#">Localização</a></li>
                </ul>
            </div>
        </div>
    </div>
    <p class="footer-text">&copy;2024 WallStreet | All Rights Reserved</p>
</footer>



</html>
