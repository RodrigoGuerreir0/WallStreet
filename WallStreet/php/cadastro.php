<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../javascript/cadastro.js"></script>
    <title>Cadastro</title>
</head>

<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="./validarcadastro.php" method="post">
            <h2>Cadastrar-se</h2>

            <div class="divisoria3">
                <div class="inputBox">

                    <input type="email" name="Email" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
            </div>

            <div class="divisorias">

                <div class="divisoria1">
                    <div class="inputBox">
                        <input class="tamanhoinput" type="text" name="Nome" required="required">
                        <span>Nome</span>
                        <i></i>

                    </div>

                    <div class="inputBox">
                        <input oninput="mascara(this)" type="text" id="cpf" name="Cpf" maxlength="11" required="required">
                        <span>Cpf</span>
                        <i></i>
                    </div>

                    <div class="inputBox">
                        <input type="text" name="Telefone" id="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" required="required">
                        <span>Telefone</span>
                        <i></i>
                    </div>

                    <div class="inputBox">
                        <input type="password" name="Senha" required="required">
                        <span>Senha</span>
                        <i></i>
                    </div>
                </div>

                <div class="divisoria2">
                    <div class="inputBox">
                        <input type="text" name="Usuario" required="required">
                        <span>Nome de Usuario</span>
                        <i></i>
                    </div>

                    <div class="inputBox">
                        <input type="date" id="" name="DataNascimento" placeholder="Data de Nascimento" required>
                    </div>

                    <div class="inputBox">

                        <select name="Genero" class="">
                            <option value="" disabled selected>Selecione seu Gênero</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>

                        <i></i>
                    </div>

                    <div class="inputBox">
                        <input type="password" name="ConfirmarSenha" required="required">
                        <span>Confirmar Senha</span>
                        <i></i>
                    </div>
                </div>

            </div>


            <div class="links">
                <div class="checkbox-container">
                    <input type="checkbox" id="terms" name="terms" required />

                        <label for="terms">Li e estou de acordo com as</a> <a targe href="PoliticaDePrivacidade.php" target="_blank">Políticas de privacidade</a>.</label>
                </div>

                <a href="./login.php">Já tem conta? Faça seu login</a>
            </div>
            <input type="submit" value="Cadastrar-se">
        </form>
    </div>
</body>
<script>
    const dateInput = document.getElementById('dateInput');

    dateInput.addEventListener('change', function() {
        if (dateInput.value !== "") {
            dateInput.classList.add('date-selected');
        }
    });
</script>

</html>