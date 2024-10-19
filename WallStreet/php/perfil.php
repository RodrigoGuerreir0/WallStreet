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

$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nomeUsuario = $_SESSION['Usuario'];

$sql = "SELECT id FROM Perfil WHERE Usuario = :Usuario";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':Usuario', $nomeUsuario);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if ($usuario) {
    $idUsuario = $usuario['id'];
}

$sql = "SELECT * FROM Endereco WHERE idUsuario = :idUsuario";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':idUsuario', $idUsuario);
$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

$usuario = $_SESSION['Usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Perfil</title>
    <script src="../javascript/mobilehome.js"></script>
</head>

<body>
    <header>
        <nav>
            <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
            <a class="logo" href="">
                <font class="a2">Bem-vindo ao seu perfil </font>
                <font class="color"><?php echo $_SESSION['Usuario']; ?></font>!
            </a>

            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-list">
                <li><a class="li_A" href="inicio.php"><i class="fas fa-home fa-2x"></i></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="page">



            <form action="" method="post" class="formLogin">

                <div class="profile-container">




                    <?php
                    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

                    $stmt = $conexao->prepare("SELECT * FROM Perfil WHERE Usuario = :usuario");
                    $stmt->bindParam(':usuario', $usuario);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($LinhasDoBanco = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div class="profile-card">
                                <div class="profile-header">

                                    <div class="profile-img-container">
                                        <img src="../img/imgProfile.png" alt="Imagem do Perfil" class="imgPerfil">
                                        <div class="change-img-icon">
                                            <i class="fas fa-camera"></i> <!-- Ícone para trocar a imagem -->
                                        </div>
                                    </div>

                                    <h1><?php echo "<div class='maiusculas'><b>" . $LinhasDoBanco["Nome"] . "</b></div>" ?></h1>
                                    <p class="username"><?php echo "<font class='username'><b>" . $LinhasDoBanco["Usuario"] . "</b></font>"; ?></p>

                                    <div class="profile-body">
                                        <p><b class="Bperfil">CPF</b><br> <?php echo "<font class='dadosPerfil'><b>" . $LinhasDoBanco["CPF"] . "</b></font>"; ?></p>
                                        <br>
                                        <p><b class="Bperfil">Email</b><br> <?php echo "<font class='dadosPerfil'><b>" . $LinhasDoBanco["Email"] . "</b></font>"; ?></p>
                                        <br>
                                        <p><b class="Bperfil">Telefone</b><br> <?php echo "<font class='dadosPerfil'><b>" . $LinhasDoBanco["Telefone"] . "</b></font>"; ?></p>
                                    </div>
                                </div>
                            </div>


                            <div class="profile-actions">

                                <form action="EditarPerfil.php" method="post"></form>

                                <form action="EditarPerfil.php" method="post">
                                    <input type="hidden" name="Codigo" value="<?php echo $LinhasDoBanco["id"]; ?>">

                                    <button type="submit" class="fas fa-edit fa-3x"></button>
                                </form>

                                <form action="deslogar.php" method="post">
                                    <button type="submit" class="fas fa-sign-out-alt fa-3x"></button>
                                </form>

                            </div>
                </div>
            <?php
                        }
                    } else {
            ?>
            <p class="no-profile">Nenhum perfil encontrado para o usuário.</p>
        <?php
                    }
        ?>
        </div>
        </form>

        <div class="Selecionarendereco">
            <div class="centerImgA">
                <img src="../img/imgAdress.png" alt="" class="imgAdress">
                <h1>Edite seus Endereços</h1>
            </div>
            <div class="scroll">
                <?php

                if ($resultado) {
                    foreach ($resultado as $endereco) {
                ?>


                        <div class="marcador">
                            <div class="marcAdress">
                                <?php
                                echo "<font color='purple'><b>" . $endereco["Apelido"] . "</b></font><br>";
                                echo "<b class='infoS'>" . $endereco["Cep"] . "</b><br>";
                                echo "<b class='infoS'>" . $endereco["Cidade"] . ", " . $endereco["Estado"] . "</b><br>";
                                echo "<b class='infoS'>" . $endereco["Rua"] . ", Nº " . $endereco["Numero"] . "</b><br>";
                                echo "<b class='infoS'>" . $endereco["Bairro"] . "</b><br>";
                                ?>
                            </div>
                            <div class="colunaBtn">
                                <form action="editarEndereco.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $endereco["id"]; ?>">
                                    <button type="submit" class="fas fa-edit fa-3x"></button>
                                </form>

                                <form action="excluirEndereco.php" method="post" class="delete-address-form">
                                    <input type="hidden" name="id" value="<?php echo $endereco["id"]; ?>">
                                    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($endereco["Apelido"]); ?>"> 
                                    <button type="submit" class="fas fa-trash fa-3x"></button>
                                </form>

                            </div>

                        </div>



                        <br>




                <?php
                    }
                }
                ?>



            </div>
        </div>
        </div>


    </main>


    <footer>
        <div class="container-footer">
            <div class="row-footer">
                <div class="footer-col">
                    <h4>WallStreet</h4>
                    <ul>
                        <li><a href="sobreNos.php">Quem somos</a></li>
                        <li><a href="sobreNos.php">Nossos serviços</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    // Adiciona um evento de submit para o formulário específico
    document.querySelectorAll('.delete-address-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            // Impede o envio automático do formulário
            event.preventDefault();

            // Obtém o nome do endereço a partir do campo oculto
            const nomeEndereco = this.querySelector('input[name="nome"]').value;

            Swal.fire({
                title: 'Confirmar Exclusão',
                text: `Deseja mesmo excluir o endereço "${nomeEndereco}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submete o formulário se o usuário confirmar
                    this.submit();
                }
            });
        });
    });
</script>