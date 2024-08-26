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
        <form action="validarcadastro.php" method="post" class="formLogin">
            <h1>Cadastro</h1>
            <p>Preencha o formulário abaixo para criar uma conta.</p>

            <table>
                <tr>
                    <td>
                        <label for="name">Nome</label><br>
                        <input type="text" class="" name="Nome" placeholder="Digite seu nome" autofocus="true" required />
                    </td>

                    <td>

                        <label for="Nascimento" class="TDLEFT">Data de Nascimento</label><br>
                        <input type="date" class="TDLEFT" id=""  name="DataNascimento" placeholder="Data de Nascimento" required>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="cpf">CPF</label><br>
                        <input oninput="mascara(this)" type="text" id="cpf" name="Cpf" placeholder="Digite seu CPF" maxlength="11" required>

                    </td>

                    <td>
                        <label for="sexo" class="TDLEFT">Sexo</label><br>
                        <select name="Sexo" class="TDLEFT">
                            <option value="Masculino" selected>Masculno</option>
                            <option value="Femenino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="telefone">Telefone</label>
                        <input type="text" id="phone" name="Telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" placeholder="Digite seu telefone" required />                        
                    </td>

                    <td>
                        <label for="password" class="TDLEFT">Senha</label><br>
                        <input type="password" class="TDLEFT" name="Senha" placeholder="Digite sua senha" required />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email">E-mail</label>
                        <input type="email" id="" name="Email" placeholder="Digite seu e-mail" required />
                    </td>

                    <td>
                        <label for="confirmPassword" class="TDLEFT">Confirmar Senha</label>
                        <input type="password" class="TDLEFT" name="ConfirmarSenha" placeholder="Confirme sua senha" required />
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

            <div class="checkbox-container">
                <input type="checkbox" id="terms" name="terms" required />
                
                <label for="terms">Li e estou de acordo com as</a> <a targe href="PoliticaDePrivacidade.php" target="_blank"> Políticas de privacidade</a>.</label>
            </div>

            <center>
                <p class="FINAL">Já tem uma conta? <a href="login.php">Faça login</a></p>
            </center>
        </form>
    </div>

 



</body>

</html>