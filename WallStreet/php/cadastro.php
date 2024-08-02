<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../javascript/cadastro.js"></script>
    <link rel="stylesheet" href="../css/cadastro.css">

    <title>Cadastro De Perfil</title>
</head>

<body>


    <div class="page">
        <br>
        <form action="" method="post" class="formLogin">
            <h1>Cadastro</h1>
            <p>Preencha o formulário abaixo para criar uma conta.</p>

            <table>
                <tr>
                    <td>
                        <label for="name">Nome</label><br>
                        <input type="text" class="" name="Nome" placeholder="Digite seu nome" autofocus="true" required />
                    </td>

                    <td>

                        <label for="Nascimento">Data de Nascimento</label><br>
                        <input type="date" class="" id="" name="DataNascimento" placeholder="Data de Nascimento" required>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="cpf">CPF</label><br>
                        <input oninput="mascara(this)" type="text" id="cpf" name="Cpf" placeholder="Digite seu CPF" maxlength="11" required>

                    </td>

                    <td>
                        <label for="sexo">Sexo</label><br>
                        <select name="Sexo">
                            <option value="Masculino" selected>Masculno</option>
                            <option value="Femenino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="telefone">Telefone</label>
                        <input type="text" class="" id="" name="Telefone" placeholder="Digite seu Telefone" maxlength="15" required>

                    </td>

                    <td>
                        <label for="password">Senha</label><br>
                        <input type="password" id="" name="Senha" placeholder="Digite sua senha" required />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email">E-mail</label>
                        <input type="email" id="" name="Email" placeholder="Digite seu e-mail" required />
                    </td>

                    <td>
                        <label for="confirmPassword">Confirmar Senha</label>
                        <input type="password" name="ConfirmarSenha" placeholder="Confirme sua senha" required />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="usuario">Nome de Usuario</label>
                        <input type="text" class="" id="" name="Usuario" placeholder="Digite seu Usuario" maxlength="50" required>

                    </td>

                    <td>
                        <input type="submit" value="Cadastrar" class="btn" />
                    </td>
                </tr>


            </table>

            <center>
                <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
            </center>
        </form>
    </div>

    <?php

    if (isset($_POST["Nome"], $_POST["DataNascimento"], $_POST["Sexo"], $_POST["Cpf"], $_POST["Telefone"], $_POST["Email"], $_POST["Usuario"], $_POST["Senha"], $_POST["ConfirmarSenha"])) {
        $Nome = $_POST["Nome"];
        $DataNascimento = $_POST["DataNascimento"];
        $Sexo = $_POST["Sexo"];
        $Cpf = $_POST["Cpf"];
        $Telefone = $_POST["Telefone"];
        $Email = $_POST["Email"];
        $Usuario = $_POST["Usuario"];
        $Senha = $_POST["Senha"];
        $ConfirmarSenha = $_POST["ConfirmarSenha"];

        $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($Senha == $ConfirmarSenha) {
            $verificarUsuario = $conexao->prepare("SELECT * FROM Perfil WHERE Usuario = :Usuario OR Cpf = :Cpf OR Email = :Email");
            $verificarUsuario->bindParam(":Usuario", $Usuario);
            $verificarUsuario->bindParam(":Email", $Email);
            $verificarUsuario->bindParam(":Cpf", $Cpf);
            $verificarUsuario->execute();

            if ($verificarUsuario->rowCount() > 0) {
                echo "Usuário, CPF ou E-mail já existem";
            } else {

                $comandoSQL = $conexao->prepare("INSERT INTO Perfil (Nome, DataNascimento, Sexo, Cpf, Telefone, Email, Usuario, Senha) 
                                            VALUES (:Nome, :DataNascimento, :Sexo, :Cpf, :Telefone, :Email, :Usuario, :Senha)");
                $comandoSQL->bindParam(":Nome", $Nome);
                $comandoSQL->bindParam(":DataNascimento", $DataNascimento);
                $comandoSQL->bindParam(":Sexo", $Sexo);
                $comandoSQL->bindParam(":Cpf", $Cpf);
                $comandoSQL->bindParam(":Telefone", $Telefone);
                $comandoSQL->bindParam(":Email", $Email);
                $comandoSQL->bindParam(":Usuario", $Usuario);
                $comandoSQL->bindParam(":Senha", $Senha);
                $comandoSQL->execute();
                header("Location: ./login.php");
            }
        } else {
    ?>

            <script>
                alert("As senhas nao sao identicas")
            </script>
    <?php

        }
    }
    ?>

</body>

</html>