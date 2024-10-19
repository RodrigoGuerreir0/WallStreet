<?php
session_start();

if (!isset($_SESSION['Usuario'])) {
} else {

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

    $stmt2 = $conexao->prepare("SELECT Funcao FROM Perfil WHERE id = :idUsuario");
    $stmt2->bindParam(':idUsuario', $idUsuario);
    $stmt2->execute();

    $resultadoBanco = $stmt2->fetch(PDO::FETCH_ASSOC);

    $Funcao = $resultadoBanco['Funcao'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
            <?php
            if (!isset($_SESSION['Usuario'])) {
            ?>
                <font class="a2">Bem-vindo à WallStreet </font>
            <?php
            } else {
            ?>

                <font class="a2">Bem-vindo à WallStreet </font>
                <font class="color"><?php echo $_SESSION['Usuario']; ?><font color="white">!</font>
                </font>

            <?php

            }
            ?>
        </a>

        <?php
        if (!isset($_SESSION['Usuario'])) {
        ?>

            <div class="mobile-menu" onclick="toggleMenu()">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <div id="side-menu" class="side-menu">
                <i class="fas fa-times fa-2x" onclick="toggleMenu()" id="xxx"></i>
                <a href="inicio.php" class="menu-item"><i class="fas fa-home fa-2x" id="ico"></i></a>
                <a href="<?php echo !isset($_SESSION['Usuario']) ? 'login.php' : 'perfil.php'; ?>" class="menu-item"><i class="fa fa-user fa-2x" id="ico"></i></a>
            </div>


        <?php
        } else {

        ?>

            <div class="mobile-menu" onclick="toggleMenu()">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <div id="side-menu" class="side-menu">

                <i class="fas fa-times fa-2x" onclick="toggleMenu()" id="xxx"></i>

                <a href="inicio.php" class="menu-item"><i class="fas fa-home fa-2x" id="ico"></i></a>

                <a class="li_A" href="" id="contato-link"><i class="fas fa-map-marker-alt fa-2x" id="ico"></i></a>

                <a href="<?php echo !isset($_SESSION['Usuario']) ? 'login.php' : 'perfil.php'; ?>" class="menu-item" id="ico"><i class="fa fa-user fa-2x"></i></a>
            </div>

        <?php

        }
        ?>
    </nav>
</header>

<main>
    <?php
    if (!isset($_SESSION['Usuario'])) {

        $Funcao = "Não Logado";
    }
    if ($Funcao == 'AdministradorGERAL') {
    ?>
        <div class="container">
            <div class="boxmap-container">
                <div class="boxmapAdmG">
                    <div class="pesquisa">
                        <input id="cepInput" type="text" placeholder="Digite o CEP" maxlength="9">
                        <button id="LocalizarCEP" class="btn">Localizar no Mapa</button>
                    </div>

                    <script>
                        function aplicarMascaraCEP(valor) {
                            return valor
                                .replace(/\D/g, '')
                                .replace(/^(\d{5})(\d{0,3})/, '$1-$2')
                                .slice(0, 9);
                        }
                        document.getElementById('cepInput').addEventListener('input', function(event) {
                            event.target.value = aplicarMascaraCEP(event.target.value);
                        });
                    </script>

                    <div id="map1" class="map1Tela"></div>

                    <h1>Vagas Cadastradas</h1>
                    <div class="boxscroll">
                        <?php
                        $Selecaovagas = "SELECT * FROM Vagas";
                        $todasvagas = $conexao->prepare($Selecaovagas);
                        $todasvagas->execute();

                        $ArmazenadorDeVagas = $todasvagas->fetchAll(PDO::FETCH_ASSOC);

                        if ($ArmazenadorDeVagas) {
                            foreach ($ArmazenadorDeVagas as $Vagas) {
                        ?>

                                <input type="radio" name="endereco">
                                <div class="boxfirst">
                                    <div class="boxsecond">
                                        <label for="radioId">


                                            <div class="vaga-item">
                                                <p><b>Vaga:</b> <?php echo $Vagas["Vaga"]; ?></p>
                                                <p><b>Status:</b> <?php echo $Vagas["StatusDaVaga"]; ?></p>
                                                <p><b>Latitude:</b> <?php echo $Vagas["Latitude"]; ?></p>
                                                <p><b>Longitude:</b> <?php echo $Vagas["Longitude"]; ?></p>
                                                <div class="inline0">
                                                    <form action="./ExcluirVagas.php" method="post" class="delete-form">
                                                        <input type="hidden" name="id" value="<?php echo $Vagas["id"]; ?>">
                                                        <button type="submit" class="fas fa-trash fa-3x"></button>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="spaceB">
                        <button class="scrollbtn1" onclick="scrollUp3()">▲</button>
                        <button class="scrollbtn2" onclick="scrollDown3()">▼</button>
                    </div>
                </div>

                <div class="form-container">
                    <h1>Cadastrar vaga</h1>
                    <form action="./validarVaga.php" method="post" class="vagas">
                        <div class="spaceBoxVagas">
                            <input type="number" placeholder="Digite o número da vaga:" id="NumeroVaga" name="Vaga" required>
                            <input type="text" placeholder="Digite a latitude da vaga:" id="LatitudeVaga" name="Latitude" required>
                            <input type="text" placeholder="Digite a longitude da vaga:" id="LongitudeVaga" name="Longitude" required>
                            <input type="submit" value="Cadastrar vaga">
                            <input type="hidden" value="Livre" name="StatusDaVaga">
                        </div>
                    </form>
                </div>
            </div>

            <div class="usuarios-section">

                <div class="scrolluser">
                    <h1>Usuários Cadastrados</h1>
                    <div class="scroll">
                        <?php
                        $SelecaoUsuarios = "SELECT * FROM Perfil";
                        $TodosUsuarios = $conexao->prepare($SelecaoUsuarios);
                        $TodosUsuarios->execute();

                        $ArmazenadorDeUsuarios = $TodosUsuarios->fetchAll(PDO::FETCH_ASSOC);

                        if ($ArmazenadorDeUsuarios) {
                            foreach ($ArmazenadorDeUsuarios as $UsuariosArmazenados) {
                        ?>

                                <div class="boxsecond">

                                    <div class="usuario-item">

                                        <p><b>Nome:</b> <?php echo "<font size='5'>" . $UsuariosArmazenados["Nome"] . "</font>"; ?></p>
                                        <p><b>Usuário:</b> <?php echo "<font size='5'>" . $UsuariosArmazenados["Usuario"] . "</font>"; ?></p>
                                        <p><b>Função:</b> <?php echo "<font size='5'>" . $UsuariosArmazenados["Funcao"] . "</font>"; ?></p>

                                        <div class="inline">

                                            <form action="./editarUsuarios.php" method="post">
                                                <input type="hidden" name="id" value="<?= $UsuariosArmazenados["id"]; ?>">
                                                <button type="submit" class="fas fa-edit fa-3x"></button>

                                            </form>

                                            <form action="./excluirUsuarios.php" method="post" class="delete-form2">
                                                <input type="hidden" name="id" value="<?= $UsuariosArmazenados["id"]; ?>">
                                                <input type="hidden" name="nome" value="<?php echo $UsuariosArmazenados["Nome"]; ?>">
                                                <button type="submit" class="fas fa-trash fa-3x"></button>
                                            </form>

                                        </div>


                                    </div>

                                </div>

                        <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="spaceB">
                        <button class="scrollbtn3" onclick="scrollUp2()">▲</button>
                        <button class="scrollbtn4" onclick="scrollDown2()">▼</button>
                    </div>
                </div>
            </div>

            <style>
                .map2Tela {
                    height: 0px;
                    opacity: 0;
                }
            </style>
        <?php
    } else if ($Funcao == 'Administrador') {

        ?>
            <div class="boxmap">

                <div class="pesquisa">

                    <input id="cepInput" type="text" placeholder="Digite o CEP" maxlength="9">
                    <button id="LocalizarCEP" class="btn">Localizar no Mapa</button>

                </div>

                <script>
                    function aplicarMascaraCEP(valor) {
                        return valor
                            .replace(/\D/g, '')
                            .replace(/^(\d{5})(\d{0,3})/, '$1-$2')
                            .slice(0, 9);
                    }
                    document.getElementById('cepInput').addEventListener('input', function(event) {
                        event.target.value = aplicarMascaraCEP(event.target.value);
                    });
                </script>

                <div id="map1" class="map1Tela"></div>

                <h1>Endereços Salvos</h1>
                <div class="boxscroll">
                    <?php
                    if ($resultado) {
                        foreach ($resultado as $index => $endereco) {
                            $radioId = 'endereco' . $index; ?>
                            <input type="radio" name="endereco" id="<?php echo $radioId; ?>" value="<?php echo htmlspecialchars($endereco['Cep']); ?>">
                            <div class="">
                                <div class="boxsecond">
                                    <label for="radioId">
                                        <?php
                                        echo "<font color='purple'><b>" . $endereco["Apelido"] . "</b></font><br>";
                                        echo "<b class='infoS'>" . $endereco["Cep"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Cidade"] . ", " . $endereco["Estado"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Rua"] . ", Nº " . $endereco["Numero"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Bairro"] . "</b><br>";
                                        ?>
                                    </label>
                                </div>
                            </div>
                    <?php }
                    } ?>
                    <script>
                        document.querySelectorAll('input[name="endereco"]').forEach(function(input) {
                            input.addEventListener('change', function() {
                                const cepSelecionado = this.value;
                                geocodeCEP(cepSelecionado);
                            });
                        })
                    </script>
                </div>
                <div class="spaceB">
                    <button class="scrollbtn1" onclick="scrollUp()">▲</button>
                    <button class="scrollbtn2" onclick="scrollDown()">▼</button>
                </div>
                <br><br>
                <div>
                    <h1>Cadastrar vagas</h1>
                    <form action="./validarVaga.php" method="post">
                        <input type="Number" placeholder="Digite o numero da vaga:" id="NumeroVaga" name="Vaga">
                        <input type="text" placeholder="Digite a latitude da vaga:" id="LatitudeVaga" name="Latitude">
                        <input type="text" placeholder="Digite a longitude da vaga:" id="LongetudeVaga" name="Longitude">
                        <input type="submit" value="Cadastrar vaga">

                        <input type="hidden" value="Livre" name="StatusDaVaga">
                    </form>
                </div>
                <div>
                    <h1>Vagas Cadastradas</h1>
                    <?php
                    $Selecaovagas = "SELECT * FROM Vagas";
                    $todasvagas = $conexao->prepare($Selecaovagas);
                    $todasvagas->execute();

                    $ArmazenadorDeVagas = $todasvagas->fetchAll(PDO::FETCH_ASSOC);

                    if ($ArmazenadorDeVagas) {
                        foreach ($ArmazenadorDeVagas as $Vagas) {
                    ?>
                            <p><?php echo $Vagas["Vaga"]; ?></p>
                            <p><?php echo $Vagas["StatusDaVaga"]; ?></p>
                            <p><?php echo $Vagas["Latitude"]; ?></p>
                            <p><?php echo $Vagas["Longitude"]; ?></p>

                            <form action="./ExcluirVagas.php" method="post" class="delete-form">
                                <input type="hidden" name="id" value="<?php echo $Vagas["id"]; ?>">
                                <input type="submit" value="Excluir">
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
                <style>
                    .map2Tela {
                        display: none;
                    }
                </style>

            </div>
        <?php
    } else {
        ?>

            <div class="boxmap">

                <div class="pesquisa">
                    <?php
                    if (!isset($_SESSION['Usuario'])) {
                    ?>
                        <input type="text" id="cepInput" placeholder="Faça seu login" maxlength="9">
                        <button class="btn" id="facaseulogin">Faça seu login</button>
                    <?php
                    } else {
                    ?>
                        <input id="cepInput" type="text" placeholder="Digite o CEP" maxlength="9">
                        <button id="LocalizarCEP" class="btn">Localizar no Mapa</button>
                    <?php
                    }
                    ?>
                </div>

                <script>
                    function aplicarMascaraCEP(valor) {
                        return valor
                            .replace(/\D/g, '')
                            .replace(/^(\d{5})(\d{0,3})/, '$1-$2')
                            .slice(0, 9);
                    }

                    document.getElementById('cepInput').addEventListener('input', function(event) {
                        event.target.value = aplicarMascaraCEP(event.target.value);
                    });
                </script>

                </ipt>

                <div id="map1" class="map1Tela"></div>

                <h1>Endereços Salvos</h1>
                <div class="boxscroll">
                    <?php
                    if (!isset($_SESSION['Usuario'])) {
                    ?>
                        <h3>Acesse seu perfil para localizar seus endereços cadastrados</h3>
                        <?php
                    } else
            if ($resultado) {
                        foreach ($resultado as $index => $endereco) {
                            $radioId = 'endereco' . $index; ?>


                            <input type="radio" name="endereco" id="<?php echo $radioId; ?>" value="<?php echo htmlspecialchars($endereco['Cep']); ?>">

                            <div class="boxfirst">
                                <div class="boxsecond">
                                    <label for="radioId">
                                        <?php
                                        echo "<font color='purple'><b>" . $endereco["Apelido"] . "</b></font><br>";
                                        echo "<b class='infoS'>" . $endereco["Cep"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Cidade"] . ", " . $endereco["Estado"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Rua"] . ", Nº " . $endereco["Numero"] . "</b><br>";
                                        echo "<b class='infoS'>" . $endereco["Bairro"] . "</b><br>";
                                        ?>
                                    </label>
                                </div>
                            </div>

                    <?php }
                    } ?>

                    <script>
                        document.querySelectorAll('input[name="endereco"]').forEach(function(input) {
                            input.addEventListener('change', function() {
                                const cepSelecionado = this.value;
                                geocodeCEP(cepSelecionado);
                            });
                        })
                    </script>

                </div>

                <div class="spaceB">
                    <button class="scrollbtn1" onclick="scrollUp()">▲</button>
                    <button class="scrollbtn2" onclick="scrollDown()">▼</button>
                </div>

            </div>



            <?php
            if (!isset($_SESSION['Usuario'])) {
            ?>
                <div class="endereco">
                    <h1>Adicione uma Localização</h1>

                    <input type="text" id="Apelido" placeholder="  Faça seu login" name="Apelido">
                    <input type="text" id="cep" placeholder=" Faça seu login" name="cep" maxlength="9">
                    <input type="text" id="Rua" placeholder="  Faça seu login" name="Rua">
                    <input type="text" id="Bairro" placeholder="  Faça seu login" name="Bairro">
                    <input type="text" id="Cidade" placeholder="  Faça seu login" name="Cidade">
                    <input type="text" id="Estado" placeholder="  Faça seu login" name="Estado">
                    <input type="Number" id="Numero" placeholder="  Faça seu login" name="Numero">
                    <button id="facaseulogin2" class="btn2">Faça seu login</button>
                </div>
            <?php
            } else {
            ?>
                <form action="validarEndereco.php" method="post" id="addressForm" class="endereco">

                    <h1>Adicione uma Localização</h1>

                    <input type="text" id="Apelido" placeholder="  Apelido para o endereço" name="Apelido">
                    <input type="text" id="cep" placeholder="  Digite seu Cep" name="cep" maxlength="9" onblur="getAddress()" required>
                    <input type="text" id="Rua" placeholder="  Digite sua Rua" name="Rua">
                    <input type="text" id="Bairro" placeholder="  Digite seu bairro" name="Bairro">
                    <input type="text" id="Cidade" placeholder="  Digite sua cidade" name="Cidade">
                    <input type="text" id="Estado" placeholder="  Digite seu estado" name="Estado">
                    <input type="Number" id="Numero" placeholder="  Digite seu Nº" name="Numero">


                    <input type="hidden" id="IdUsuario" name="IdUsuario" value="<?php echo $idUsuario; ?>">

                    <button type="submit" class="btn2">Cadastrar Endereço</button>
                </form>
        <?php
            }
        }
        ?>

        <script>
            function aplicarMascaraCEP(valor) {
                return valor
                    .replace(/\D/g, '')
                    .replace(/^(\d{5})(\d{0,3})/, '$1-$2')
                    .slice(0, 9);
            }

            document.getElementById('cep').addEventListener('input', function(event) {
                event.target.value = aplicarMascaraCEP(event.target.value);
            });

            function getAddress() {}
        </script>

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
            let markersMap1 = new Map();
            let markersMap2 = new Map();

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

            setInterval(() => {
                updateMarkers(map1, markersMap1);
                updateMarkers(map2, markersMap2);
            }, 1000);

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
                updateMarkers(map1, markersMap1);
            }

            function initMap2() {
                map2 = new google.maps.Map(document.getElementById('map2'), {
                    zoom: 15,
                    center: sensors[0],
                    mapTypeId: 'roadmap',
                });
                updateMarkers(map2, markersMap2);
            }

            function updateMarkers(map, markersMap) {
                fetch('vagas.php')
                    .then(response => response.json())
                    .then(data => {
                        const currentIds = new Set();

                        data.forEach(vaga => {
                            const markerId = `${vaga.Latitude}-${vaga.Longitude}`;
                            currentIds.add(markerId);

                            const iconUrl = vaga.StatusDaVaga === 'Livre' ?
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E' :
                                'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';

                            if (!markersMap.has(markerId)) {
                                const marker = new google.maps.Marker({
                                    position: {
                                        lat: parseFloat(vaga.Latitude),
                                        lng: parseFloat(vaga.Longitude)
                                    },
                                    map: map,
                                    icon: iconUrl
                                });
                                markersMap.set(markerId, marker);
                            } else {
                                const marker = markersMap.get(markerId);
                                marker.setIcon(iconUrl);
                            }
                        });

                        markersMap.forEach((marker, id) => {
                            if (!currentIds.has(id)) {
                                marker.setMap(null);
                                markersMap.delete(id);
                            }
                        });
                    })
                    .catch(error => console.error('Erro ao atualizar marcadores:', error));
            }

            function geocodeCEP(cep) {
                const formattedCEP = cep.replace(/\D/g, '');
                geocoder.geocode({
                    'address': formattedCEP,
                    'region': 'BR'
                }, (results, status) => {
                    if (status === 'OK') {
                        const location = results[0].geometry.location;

                        map1.setCenter(location);
                        map2.setCenter(location);

                        new google.maps.Marker({
                            position: location,
                            map: map1,
                            title: 'Localização do CEP'
                        });

                        new google.maps.Marker({
                            position: location,
                            map: map2,
                            title: 'Localização do CEP'
                        });
                    } else {
                        alert('Geocode não foi bem-sucedido: ' + status);
                    }
                });
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

<script>
    document.getElementById('facaseulogin').addEventListener('click', function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Faça seu login',
            footer: 'Por favor, entre na sua conta'
        });
    });
</script>
<script>
    document.getElementById('facaseulogin2').addEventListener('click', function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Faça seu login',
            footer: 'Por favor, entre na sua conta'
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const vagaNumero = this.querySelector('input[name="id"]').value;
            Swal.fire({
                title: 'Confirmar Exclusão',
                text: `Você tem certeza que deseja excluir a vaga número ${vagaNumero}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>

<script>
    document.querySelectorAll('.delete-form2').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const nomeUsuario = this.querySelector('input[name="nome"]').value;

            Swal.fire({
                title: 'Confirmar Exclusão',
                text: `Você tem certeza que deseja excluir o usuário ${nomeUsuario}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
