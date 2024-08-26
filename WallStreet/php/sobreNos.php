<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
?>

    <!-- Caso a pessoa não esteja logada, só irá aparecer o que estiver dentro desse if acima -->

    <h2>Você ainda não está logado. Faça seu login</h2>
    <a href="./login.php">Login</a>
<?php
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/sobreNos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../javascript/mobilehome.js"></script>
    <title>Bem-vindo</title>
</head>

<header>
    <nav>
        <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
        <a class="logo" href="inicio.php"><font class="a2">descubra quem somos </font><font class="color"><?php // echo $_SESSION['Usuario']; ?></font></a>

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
        <br>

        <!--<div class="formLogin2">

        
         <h1>Quem somos</h1>

          

        </div> -->

        <div class="formLogin">
            <div class="box">


            
        <h1>Sobre Nós</h1>
        
        <h2>Bem-vindo à WallStreet</h2>
        <p>Na WallStreet, estamos redefinindo a forma como você estaciona. Nossa missão é transformar o estacionamento urbano em uma experiência mais eficiente, conveniente e sustentável, aproveitando o que há de mais avançado em tecnologia inteligente.</p>
        
        <h2>Quem Somos</h2>
        <p>Fundada em [Ano de Fundação], a WallStreet surgiu da ideia de resolver um dos maiores desafios urbanos modernos: o estacionamento. Com uma equipe de visionários apaixonados por tecnologia e inovação, combinamos inteligência artificial, sensores avançados e análise de dados para criar uma solução de estacionamento inteligente que vai além das expectativas.</p>
        
        <h2>Nosso Objetivo</h2>
        <p><strong>Facilitar o Estacionamento, Transformar Cidades</strong></p>
        <p>Nossa missão é simples: tornar o estacionamento mais fácil e eficiente. Utilizamos a tecnologia para otimizar a utilização de espaços, reduzir o tempo perdido procurando vagas e minimizar o impacto ambiental causado por veículos em busca de estacionamento. Com a WallStreet, você pode dizer adeus ao estresse de encontrar uma vaga e olá a uma experiência de estacionamento sem preocupações.</p>
        
        <h2>O Que Fazemos</h2>
        <ul>
            <li><strong>Sistema de Vagas Inteligentes:</strong> Utilizamos sensores e algoritmos avançados para identificar e informar a disponibilidade de vagas em tempo real, garantindo que você encontre uma vaga rapidamente e sem esforço.</li>
            <li><strong>Aplicativo WallStreet:</strong> Nosso aplicativo intuitivo permite que você encontre, reserve e pague por uma vaga de estacionamento com apenas alguns cliques. Receba notificações sobre a disponibilidade de vagas e aproveite um pagamento rápido e seguro.</li>
            <li><strong>Análise de Dados:</strong> Coletamos e analisamos dados para otimizar a gestão de estacionamentos, melhorar a eficiência do espaço e fornecer insights valiosos para gestores e desenvolvedores urbanos.</li>
            <li><strong>Sustentabilidade:</strong> Comprometidos com a sustentabilidade, buscamos reduzir a pegada de carbono associada ao estacionamento e promover práticas que beneficiem o meio ambiente.</li>
        </ul>
        
        <h2>Nossa Visão</h2>
        <p><strong>Estacionar com Inteligência, Viver com Facilidade</strong></p>
        <p>Visualizamos um futuro onde cada cidade é equipada com soluções de estacionamento inteligente que promovem uma mobilidade mais fluida e sustentável. A WallStreet está na vanguarda dessa revolução, ajudando a construir cidades mais inteligentes e conectadas.</p>
        
        <h2>Nossos Valores</h2>
        <ul>
            <li><strong>Inovação:</strong> Estamos sempre em busca das tecnologias mais recentes para oferecer soluções de estacionamento que superem as expectativas.</li>
            <li><strong>Eficácia:</strong> Comprometidos com a eficiência, garantimos que nossos sistemas funcionem de forma impecável para você.</li>
            <li><strong>Sustentabilidade:</strong> Valorizamos o meio ambiente e trabalhamos para minimizar o impacto ambiental do estacionamento urbano.</li>
            <li><strong>Conveniência:</strong> Buscamos facilitar sua vida com soluções práticas e fáceis de usar.</li>
        </ul>
        
        <h2>Junte-se a Nós</h2>
        <p>Estamos empolgados com o futuro e queremos que você faça parte dele. Se você compartilha nossa paixão por tecnologia, inovação e cidades mais inteligentes, entre em contato conosco e descubra como você pode se envolver.</p>
        
        <p><strong>Entre em contato:</strong> <a href="mailto:rodrigoguerreiro217@gmail.com">rodrigoguerreiro217@gmail.com</a> | (19) 97138-8368 | Senai Alvares Romi</p>
        
        <!--<p><strong>Siga-nos nas redes sociais:</strong> [Links para Redes Sociais]</p>-->
        
        <p>Na WallStreet, estamos sempre à procura de novas maneiras de aprimorar sua experiência de estacionamento. Junte-se a nós na jornada para um futuro mais inteligente e conveniente.</p>
    

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
                    <li><a href="#">Quem somos</a></li>
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
