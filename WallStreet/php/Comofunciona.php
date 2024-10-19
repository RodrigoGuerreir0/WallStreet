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
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/comoFunciona.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/comoFunciona.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../javascript/mobilehome.js"></script>
    <title>Bem-vindo</title>
</head>

<header>
    <nav>
        <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
        <a class="logo" href="inicio.php">
            <font class="a2">Entenda como funciona a WallStreet </font>
        
            <font class="color"><?php // echo $_SESSION['Usuario']; 
                                ?></font>
        </a>

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
        <div class="FUndoComoFunciona__Main">
            <div class="Title_ComoFunciona">
                <h1>Como Funciona o Sistema de Estacionamento Inteligente</h1>
            </div>
            <div class="TXT_Comofunciona">
                <p>O sistema de estacionamento inteligente com sensor de presença e integração com um site proporciona uma maneira moderna e eficiente de gerenciar vagas de estacionamento. Aqui está um resumo de como o sistema funciona:</p>

                <h2>1. Detecção de Vagas Disponíveis</h2>
                <p>O sistema utiliza sensores de presença instalados em cada vaga de estacionamento. Esses sensores detectam se a vaga está ocupada ou disponível e transmitem essas informações em tempo real.</p>

                <h2>2. Sinalização Visual</h2>
                <p>Para facilitar a localização das vagas, o sistema utiliza sinalização com luzes verde e vermelha. As luzes verdes indicam vagas disponíveis, enquanto as vermelhas sinalizam que a vaga está ocupada. Isso ajuda os motoristas a encontrar rapidamente uma vaga sem a necessidade de procurar por longos períodos.</p>

                <h2>3. Integração com o Site</h2>
                <p>Os motoristas podem acessar um site integrado ao sistema para verificar a disponibilidade de vagas em tempo real. Além disso, o site permite que os motoristas realizem pagamentos online para o estacionamento. Essa integração economiza tempo, reduz o tráfego e melhora a experiência geral do usuário.</p>

                <h2>4. Benefícios e Desafios</h2>
                <div class="highlight">
                    <p><strong>Benefícios:</strong></p>
                    <ul>
                        <li>Facilidade de uso com sinalização clara.</li>
                        <li>Acesso em tempo real à disponibilidade de vagas e pagamento online.</li>
                        <li>Redução do tempo de busca por vagas e do tráfego no estacionamento.</li>
                    </ul>
                </div>
                <p>Para garantir a eficácia do sistema, é essencial levar em conta as necessidades dos usuários e dos administradores de estacionamento. A implementação deve ser planejada cuidadosamente para proporcionar uma experiência segura e eficiente para todos os envolvidos.</p>
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