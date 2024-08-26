<?php
session_start();  // Inicia a sessão para que variáveis de sessão possam ser acessadas.
if (!isset($_SESSION['Usuario'])) {  // Verifica se a variável de sessão 'Usuario' está definida (usuário logado).
?>

    <!-- Caso a pessoa não esteja logada, só irá aparecer o que estiver dentro desse if acima -->

    <h2>Você ainda não está logado. Faça seu login</h2>  // Exibe uma mensagem indicando que o usuário precisa fazer login.
    <a href="./login.php">Login</a>  // Link para a página de login.
<?php
    exit();  // Se o usuário não estiver logado, encerra a execução do script aqui.
}
$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");  // Conecta ao banco de dados MySQL usando PDO.
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Configura o PDO para lançar exceções em caso de erro.

$nomeUsuario = $_SESSION['Usuario'];  // Atribui o nome do usuário da sessão à variável $nomeUsuario.

$sql = "SELECT id FROM Perfil WHERE Usuario = :Usuario";  // Prepara uma query SQL para selecionar o ID do usuário baseado no nome de usuário.
$stmt = $conexao->prepare($sql);  // Prepara a query SQL usando PDO.
$stmt->bindParam(':Usuario', $nomeUsuario);  // Vincula o parâmetro ':Usuario' ao valor de $nomeUsuario.
$stmt->execute();  // Executa a query.

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);  // Obtém o resultado da query como um array associativo.
if ($usuario) {  // Se um usuário for encontrado:
    $idUsuario = $usuario['id'];  // Atribui o ID do usuário à variável $idUsuario.
}

$sql = "SELECT * FROM Endereco WHERE idUsuario = :idUsuario";  // Prepara uma query SQL para selecionar todos os endereços do usuário.
$stmt = $conexao->prepare($sql);  // Prepara a query SQL usando PDO.
$stmt->bindParam(':idUsuario', $idUsuario);  // Vincula o parâmetro ':idUsuario' ao valor de $idUsuario.
$stmt->execute();  // Executa a query.

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtém todos os resultados da query como um array associativo.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">  // Define a codificação de caracteres da página como UTF-8.
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  // Configura a página para ser responsiva em dispositivos móveis.
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  // Importa o arquivo de estilo da versão 4.7.0 do FontAwesome.
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  // Importa o arquivo de estilo da versão 6.0.0-beta3 do FontAwesome.
    <link rel="stylesheet" href="../css/home.css">  // Importa o arquivo de estilo 'home.css' localizado na pasta 'css'.
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  // Importa a biblioteca jQuery versão 3.6.0.
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>  // Importa a biblioteca SweetAlert2 versão 10 para alertas personalizados.
    <script src="../javascript/mobilehome.js"></script>  // Importa o arquivo JavaScript 'mobilehome.js' localizado na pasta 'javascript'.
    <title>Bem-vindo</title>  // Define o título da página como "Bem-vindo".
</head>

<header>
    <nav>
        <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">  // Exibe o logotipo da empresa e define um evento 'onclick' para redirecionar o usuário para a home.
        <a class="logo" href="inicio.php">
            <font class="a2">Bem-vindo à WallStreet </font>  // Exibe a mensagem de boas-vindas ao usuário.
            <font class="color"><?php echo $_SESSION['Usuario']; ?></font>!  // Exibe o nome de usuário da sessão.
        </a>

        <div class="mobile-menu">  // Cria o menu mobile com 3 linhas representando o ícone de "hambúrguer".
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul class="nav-list">
            <li><a class="li_A" href="inicio.php"><i class="fas fa-home fa-2x"></i></a></li>  // Link para a página inicial com ícone de casa.

            <li><a class="li_A" href="" id="contato-link"><i class="fas fa-map-marker-alt fa-2x"></i></a></li>  // Link para a página de contato com ícone de marcador de mapa.

            <li><a class="li_A" href="perfil.php" title="Perfil"><i class="fa fa-user fa-2x"></i></a></li>  // Link para a página de perfil com ícone de usuário.
        </ul>
    </nav>
</header>

<main>

</main>

<div class="Selecionarendereco">

    <?php
    if ($resultado) {  // Verifica se há resultados de endereços do usuário.
        foreach ($resultado as $index => $endereco) {  // Loop através de cada endereço retornado.
            $radioId = 'endereco' . $index;  // Define um ID único para cada input de rádio.
    ?>
            <input type="radio" name="endereco" id="<?php echo $radioId; ?>" value="<?php echo $endereco['Cep']; ?>">  // Cria um input de rádio para selecionar o endereço.
            <label for="<?php echo $radioId; ?>">  // Cria o rótulo associado ao input de rádio.
                <?php
                // Exibe os detalhes do endereço, como Apelido, CEP, Cidade, Estado, Rua, Número e Referência.
                echo $endereco["Apelido"] . "<br>";
                echo $endereco["Cep"] . "<br>";
                echo $endereco["Cidade"] . ", " . $endereco["Estado"] . "<br>";
                echo $endereco["Rua"] . ", Nº " . $endereco["Numero"] . "<br>";
                echo $endereco["Bairro"] . "<br>";
                echo "Referência: " . $endereco["Referencia"] . "<br>";
                ?>
            </label>
            <br>
    <?php
        }
    }
    ?>

    <script>
        document.querySelectorAll('input[name="endereco"]').forEach(function(input) {  // Seleciona todos os inputs de rádio e adiciona um event listener de mudança.
            input.addEventListener('change', function() {  // Quando o valor do input mudar:
                const cepSelecionado = this.value;  // Obtém o valor do CEP do endereço selecionado.
                geocodeCEP(cepSelecionado);  // Chama a função geocodeCEP passando o CEP selecionado.
            });
        })
    </script>

</div>

<div>
    <input id="cepInput" type="text" placeholder="Digite o CEP">  // Campo de entrada de texto para digitar o CEP.
    <button id="LocalizarCEP">Localizar no Mapa</button>  // Botão para localizar o CEP no mapa.
</div>

<div id="map1" class="map1Tela"></div>  // Div onde será exibido o primeiro mapa.

<div class="cadastroEndereço">

    <form action="validarEndereco.php" method="post" id="addressForm">  // Formulário para cadastro de um novo endereço, enviado para 'validarEndereco.php'.

        <input type="text" id="Apelido" placeholder="Apelido para o endereço" name="Apelido">  // Campo de entrada para o apelido do endereço.
        <input type="text" id="cep" placeholder="Digite seu Cep" name="cep" maxlength="8" onblur="getAddress()" required>  // Campo de entrada para o CEP, com validação de 8 caracteres e evento 'onblur' para buscar o endereço.
        <input type="text" id="Rua" placeholder="Digite sua Rua" name="Rua">  // Campo de entrada para o nome da rua.
        <input type="text" id="Bairro" placeholder="Digite seu bairro" name="Bairro">  // Campo de entrada para o nome do bairro.
        <input type="text" id="Cidade" placeholder="Digite sua cidade" name="Cidade">  // Campo de entrada para o nome da cidade.
        <input type="text" id="Estado" placeholder="Digite seu estado" name="Estado">  // Campo de entrada para o nome do estado.
        <input type="text" id="Numero" placeholder="Digite o número da residência" name="Numero">  // Campo de entrada para o número da residência.
        <input type="text" id="Referencia" placeholder="Digite um ponto de referência" name="Referencia">  // Campo de entrada para a referência do endereço.

        <button type="submit" id="submitButton">Cadastrar</button>  // Botão para enviar o formulário e cadastrar o novo endereço.
    </form>
</div>

<script src="../javascript/selecionarEndereco.js"></script>  // Importa o arquivo JavaScript 'selecionarEndereco.js' localizado na pasta 'javascript'.

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>  // Importa o script do Google Maps API, passando a chave da API e chamando a função 'initMap' ao carregar.

</html>
