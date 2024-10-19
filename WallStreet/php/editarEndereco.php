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

if (isset($_POST["id"])){
    $id = $_POST["id"];  

echo $id;


$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["Id"], $_POST["Apelido"], $_POST["Cep"], $_POST["Cidade"], $_POST["Rua"], $_POST["Bairro"], $_POST["Estado"], $_POST["Numero"])) {
        $Id = $_POST["Id"];
        $novoApelido = $_POST['Apelido'];
        $novoCep = $_POST['Cep'];
        $novaCidade = $_POST['Cidade'];
        $novaRua = $_POST["Rua"];
        $novoBairro = $_POST['Bairro'];
        $novoEstado = $_POST['Estado'];
        $novoNumero = $_POST['Numero'];

        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conexao->prepare("SELECT * FROM Endereco WHERE id = :id");
        $stmt->bindParam(':id', $Id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $conexao->prepare("UPDATE Endereco SET Apelido = :Apelido, Cep = :Cep, Rua = :Rua, Bairro = :Bairro, Cidade = :Cidade, Estado = :Estado, Numero = :Numero WHERE id = :id");
            $stmt->bindParam(':Apelido', $novoApelido);
            $stmt->bindParam(':Cep', $novoCep);
            $stmt->bindParam(':Rua', $novaRua);
            $stmt->bindParam(':Bairro', $novoBairro);
            $stmt->bindParam(':Cidade', $novaCidade);
            $stmt->bindParam(':Estado', $novoEstado);
            $stmt->bindParam(':Numero', $novoNumero);
            $stmt->bindParam(':id', $Id);
            $stmt->execute();

            echo "Dados atualizados com sucesso!";
            header("Location: perfil.php");
            exit();
        } else {
            echo "Endereço não encontrado.";
        }
    }
}

$conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conexao->prepare("SELECT * FROM Endereco WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$InformacaoDeEndereco = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Endereço</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../css/editEndereco.css">
<script src="../javascript/mobilehome.js"></script>
</head>



<header>
<nav>
    <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
    <a class="logo" href="inicio.php">
        <font class="a2">Edite seu endereço, </font>
        <font class="color"><?php echo $_SESSION['Usuario']; ?></font>!
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



<body>
<main>
    <div class="page">
        <?php if ($InformacaoDeEndereco) { ?>
            <form method="POST" action="" class="formLogin" id="addressForm">

                <div class="centerImgA">
                    <img src="../img/imgAdress" alt="" class="imgAdress">
                    <h1><b><?php echo $InformacaoDeEndereco['Apelido']; ?></b></h1>
                </div>
                    <input type="hidden" name="Id" value="<?php echo $InformacaoDeEndereco['id']; ?>">

                    <input type="text" id="Apelido" name="Apelido" value="<?php echo $InformacaoDeEndereco['Apelido']; ?>" placeholder="Apelido: ">
                    <input type="text" id="Cep"    name="Cep" value="<?php echo $InformacaoDeEndereco['Cep']; ?>" required placeholder="Cep: " onblur="getAddress()">
                    <input type="text" id="Rua"    name="Rua" value="<?php echo $InformacaoDeEndereco['Rua']; ?>" placeholder="Rua: ">
                    <input type="text" id="Numero" name="Numero" value="<?php echo $InformacaoDeEndereco['Numero']; ?>" placeholder="Numero: ">
                    <input type="text" id="Bairro" name="Bairro" value="<?php echo $InformacaoDeEndereco['Bairro']; ?>" placeholder="Bairro: ">
                    <input type="text" id="Cidade" name="Cidade" value="<?php echo $InformacaoDeEndereco['Cidade']; ?>" placeholder="Cidade: ">
                    <input type="text" id="Estado" name="Estado" value="<?php echo $InformacaoDeEndereco['Estado']; ?>" placeholder="Estado: ">

                    <input type="submit" value="Atualizar" class="btn">
            </form>
            <?php } else { ?>
                <p>Não foi possível recuperar as informações do usuário.</p>
        <?php } ?>

        <script>
            function getAddress() {
                var cep = document.getElementById('Cep').value.replace(/\D/g, '');
                if (cep.length === 8) {
                    var apiKey = 'AIzaSyCSr8SFxD03BRdriVAXeemLLaB1iop7Tmk';
                    var url = `https://maps.googleapis.com/maps/api/geocode/json?address=${cep},BR&key=${apiKey}`;

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Resposta da API:', data);
                            if (data.status === 'OK' && data.results.length > 0) {
                                var addressComponents = data.results[0].address_components;
                                var Rua = '';
                                var Bairro = '';
                                var Cidade = '';
                                var Estado = '';

                                addressComponents.forEach(component => {
                                    if (component.types.includes('route')) {
                                        Rua = component.long_name;
                                    }
                                    if (component.types.includes('sublocality_level_1') || component.types.includes('locality')) {
                                        Bairro = component.long_name;
                                    }
                                    if (component.types.includes('administrative_area_level_2')) {
                                        Cidade = component.long_name;
                                    }
                                    if (component.types.includes('administrative_area_level_1')) {
                                        Estado = component.short_name;
                                    }
                                });

                                document.getElementById('Rua').value = Rua;
                                document.getElementById('Bairro').value = Bairro;
                                document.getElementById('Cidade').value = Cidade;
                                document.getElementById('Estado').value = Estado;
                            } else {
                                alert('CEP não encontrado.');
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao buscar o CEP:', error);
                        });
                } else {
                    alert('CEP inválido. Deve conter 8 dígitos.');
                }
            }
        </script>

    </div>
</main>
</body>
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
                <li><a
                        href="https://api.whatsapp.com/send?phone=5519992561004&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19)
                        99256-1004</a></li>
                <li><a
                        href="https://api.whatsapp.com/send?phone=5519971388368&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19)
                        97138-8368</a></li>
                <li><a
                        href="https://api.whatsapp.com/send?phone=5519992729339&text=Oi,%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es.">(19)
                        99272-9339</a></li>
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
