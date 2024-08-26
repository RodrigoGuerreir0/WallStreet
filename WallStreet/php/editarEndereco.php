<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
    echo "<h2>Você ainda não está logado. Faça seu login.</h2>";
    echo '<a href="./login.php">Login</a>';
    exit();
}

$usuario = $_SESSION['Usuario'];

try {
    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id FROM Perfil WHERE Usuario = :Usuario";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':Usuario', $usuario);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario) {
        $idUsuario = $usuario['id'];
    } else {
        throw new Exception('Usuário não encontrado.');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["Id"], $_POST["Apelido"], $_POST["Cep"], $_POST["Cidade"], $_POST["Rua"], $_POST["Bairro"], $_POST["Estado"], $_POST["Numero"], $_POST["Referencia"])) {
            $Id = $_POST["Id"];
            $novoApelido = $_POST['Apelido'];
            $novoCep = $_POST['Cep'];
            $novaCidade = $_POST['Cidade'];
            $novaRua = $_POST["Rua"];
            $novoBairro = $_POST['Bairro'];
            $novoEstado = $_POST['Estado'];
            $novoNumero = $_POST['Numero'];
            $novaReferencia = $_POST['Referencia'];

            $stmt = $conexao->prepare("SELECT * FROM Endereco WHERE id = :id");
            $stmt->bindParam(':id', $Id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $stmt = $conexao->prepare("UPDATE Endereco SET Apelido = :Apelido, Cep = :Cep, Rua = :Rua, Bairro = :Bairro, Cidade = :Cidade, Estado = :Estado, Numero = :Numero, Referencia = :Referencia WHERE id = :id");
                $stmt->bindParam(':Apelido', $novoApelido);
                $stmt->bindParam(':Cep', $novoCep);
                $stmt->bindParam(':Rua', $novaRua);
                $stmt->bindParam(':Bairro', $novoBairro);
                $stmt->bindParam(':Cidade', $novaCidade);
                $stmt->bindParam(':Estado', $novoEstado);
                $stmt->bindParam(':Numero', $novoNumero);
                $stmt->bindParam(':Referencia', $novaReferencia);
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

    $stmt = $conexao->prepare("SELECT * FROM Endereco WHERE idUsuario = :idUsuario");
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    $InformacaoDeEndereco = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereço</title>
</head>

<body>
    <main>
        <div class="page">
            <?php if ($InformacaoDeEndereco) { ?>
                <form method="POST" action="" class="formLogin" id="addressForm">
                    <input type="hidden" name="Id" value="<?php echo $InformacaoDeEndereco['id']; ?>">

                    <input type="text" id="Apelido" name="Apelido" value="<?php echo $InformacaoDeEndereco['Apelido']; ?>" placeholder="Apelido: ">
                    <input type="text" id="Cep" name="Cep" value="<?php echo $InformacaoDeEndereco['Cep']; ?>" required placeholder="Cep: " onblur="getAddress()">
                    <input type="text" id="Rua" name="Rua" value="<?php echo $InformacaoDeEndereco['Rua']; ?>" placeholder="Rua: ">
                    <input type="text" id="Bairro" name="Bairro" value="<?php echo $InformacaoDeEndereco['Bairro']; ?>" placeholder="Bairro: ">
                    <input type="text" id="Cidade" name="Cidade" value="<?php echo $InformacaoDeEndereco['Cidade']; ?>" placeholder="Cidade: ">
                    <input type="text" id="Estado" name="Estado" value="<?php echo $InformacaoDeEndereco['Estado']; ?>" placeholder="Estado: ">
                    <input type="text" id="Numero" name="Numero" value="<?php echo $InformacaoDeEndereco['Numero']; ?>" placeholder="Numero: ">
                    <input type="text" id="Referencia" name="Referencia" value="<?php echo $InformacaoDeEndereco['Referencia']; ?>" placeholder="Referencia: ">

                    <input type="submit" value="Atualizar" class="btn">
                </form>
            <?php } else { ?>
                <p>Não foi possível recuperar as informações do usuário.</p>
            <?php } ?>

            <script>
                function getAddress() {
                    var cep = document.getElementById('Cep').value.replace(/\D/g, ''); // Use 'Cep' aqui para corresponder ao ID
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

</html>
