<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="../css/senha1.css">
    <script src="../javascript/cadastro.js"></script>
    <title>Login</title>
</head>

<body>
   
    

    
    <div class="page">
        <br>

        <div class="formLogin2">

         <h1>Esqueci minha senha</h1>

            <p>Digite seu CPF abaixo para podermos verificar seu login.</p>

        </div>

        <form action="./TrocarSenha.php" method="post" class="formLogin">

           
            
                        <label for="cpf">Digite seu CPF</label>
                        <input oninput="mascara(this)" type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" maxlength="11" minlength="10" required>

            
        

            <input type="submit" value="Verificar" class="btn" />
       
        
        </form>
        
    </div>

</body>

</html>
