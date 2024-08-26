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





?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../javascript/mobilehome.js"></script>
    <title>Bem-vindo</title>
</head>

<header>
    <nav>
        <img src="../img/logoWall.png" class="imglogo" alt="" onclick="redirectToHome()">
        <a class="logo" href="inicio.php">
            <font class="a2">Bem-vindo à WallStreet </font>
            <font class="color"><?php echo $_SESSION['Usuario']; ?></font>!
        </a>

        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul class="nav-list">
            <li><a class="li_A" href="inicio.php"><i class="fas fa-home fa-2x"></i></a></li>

            <li><a class="li_A" href="" id="contato-link"><i class="fas fa-map-marker-alt fa-2x"></i></a></li>

            <li><a class="li_A" href="perfil.php" title="Perfil"><i class="fa fa-user fa-2x"></i></a></li>
        </ul>
    </nav>
</header>

<main>



    <div class="boxmap">

        <div class="pesquisa">
            <input id="cepInput" type="text" placeholder="    Digite o CEP">
            <button id="LocalizarCEP" class="btn">Localizar no Mapa</button>
        </div>

        <div id="map1" class="map1Tela">

        </div>

        <?php
     

        if ($resultado) {
            foreach ($resultado as $index => $endereco) {
                $radioId = 'endereco' . $index;
        ?>
                <input type="radio" name="endereco" id="<?php echo $radioId; ?>" value="<?php echo htmlspecialchars($endereco['Cep']); ?>">
                <label for="<?php echo $radioId; ?>">
                    <?php
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
            document.querySelectorAll('input[name="endereco"]').forEach(function(input) {
                input.addEventListener('change', function() {
                    const cepSelecionado = this.value;
                    geocodeCEP(cepSelecionado);
                });
            })
        </script>

    </div>



    <form action="validarEndereco.php" method="post" id="addressForm" class="endereco">
        <h1>Adicione uma Localização</h1>

        <input type="text" id="Apelido" placeholder="  Apelido para o endereço" name="Apelido">
        <input type="text" id="cep" placeholder="  Digite seu Cep" name="cep" maxlength="8" onblur="getAddress()" required>
        <input type="text" id="Rua" placeholder="  Digite sua Rua" name="Rua">
        <input type="text" id="Bairro" placeholder="  Digite seu bairro" name="Bairro">
        <input type="text" id="Cidade" placeholder="  Digite sua cidade" name="Cidade">
        <input type="text" id="Estado" placeholder="  Digite seu estado" name="Estado">
        <input type="Number" id="Numero" placeholder="  Digite seu Nº" name="Numero">
        <input type="text" id="Referencia" placeholder="  Referencia" name="Referencia">

        <input type="hidden" id="IdUsuario" name="IdUsuario" value="<?php echo $idUsuario; ?>">

        <button type="submit" class="btn2">Cadastrar Endereço</button>
    </form>

    <script>
        function getAddress() {
            var cep = document.getElementById('cep').value.replace(/\D/g, '');
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



    <script>
        let map1;
        let map2;
        let geocoder;
        let markersMap1 = [];
        let markersMap2 = [];
        let marker2;

        const sensors = [{
                lat: -22.7570025,
                lng: -47.3839586
            },
            {
                lat: -22.7580828,
                lng: -47.3831891
            },
            {
                lat: -22.7578661,
                lng: -47.3844843
            }
        ];

        function initMaps() {
            geocoder = new google.maps.Geocoder();
            initMap1();
            initMap2();

            document.getElementById('LocalizarCEP').addEventListener('click', function() {
                const cep = document.getElementById('cepInput').value;
                if (cep) {
                    geocodeCEP(cep);
                } else {
                    alert('Por favor, insira um CEP.');
                }
            });
        }

        function initMap1() {
            map1 = new google.maps.Map(document.getElementById('map1'), {
                zoom: 15,
                center: sensors[0],
                mapTypeId: 'roadmap',
            });

            sensors.forEach(sensor => {
                const marker = new google.maps.Marker({
                    position: sensor,
                    map: map1,
                    title: 'Vaga',
                    icon: {
                        url: 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E',
                        scaledSize: new google.maps.Size(20, 20),
                    },
                });
                markersMap1.push(marker);
            });

            setInterval(() => {
                fetch('vagas.php')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach((vaga, index) => {
                            const iconUrl = vaga.StatusDaVaga === 'Livre' ?
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E' :
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';
                            if (markersMap1[index]) {
                                markersMap1[index].setIcon({
                                    url: iconUrl,
                                    scaledSize: new google.maps.Size(20, 20),
                                });
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }, 1000);
        }

        function initMap2() {
            map2 = new google.maps.Map(document.getElementById('map2'), {
                zoom: 15,
                center: sensors[0],
                mapTypeId: 'roadmap',
            });

            sensors.forEach(sensor => {
                const marker = new google.maps.Marker({
                    position: sensor,
                    map: map2,
                    title: 'Vaga',
                    icon: {
                        url: 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E',
                        scaledSize: new google.maps.Size(20, 20),
                    },
                });
                markersMap2.push(marker);
            });

            setInterval(() => {
                fetch('vagas.php')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach((vaga, index) => {
                            const iconUrl = vaga.StatusDaVaga === 'Livre' ?
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E' :
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';
                            if (markersMap2[index]) {
                                markersMap2[index].setIcon({
                                    url: iconUrl,
                                    scaledSize: new google.maps.Size(20, 20),
                                });
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }, 1000);
        }

        function geocodeCEP(cep) {
            const formattedCEP = cep.replace(/\D/g, '');
            if (formattedCEP.length === 8) {
                const address = `${formattedCEP}, Brasil`;
                geocoder.geocode({
                    address: address
                }, function(results, status) {
                    if (status === 'OK') {
                        const location = results[0].geometry.location;
                        map1.setCenter(location);

                        if (marker2) marker2.setMap(null);

                        marker2 = new google.maps.Marker({
                            map: map1,
                            position: location,
                        });
                    } else {
                        alert('Geocode foi malsucedido pelo seguinte motivo: ' + status);
                    }
                });
            } else {
                alert('CEP inválido. Por favor, insira um CEP válido com 8 dígitos.');
            }
        }
    </script>

</main>




<div id="map2" class="map2Tela"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSr8SFxD03BRdriVAXeemLLaB1iop7Tmk&callback=initMaps"
    async defer></script>

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