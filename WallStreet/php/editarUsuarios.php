<?php
if (isset($_POST["id"])) {
    $IdUsuario = $_POST["id"];

    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

    $SelecaoUsuarios = "SELECT * FROM Perfil WHERE id = :idUsuario";
    $TodosUsuarios = $conexao->prepare($SelecaoUsuarios);
    $TodosUsuarios->bindParam(':idUsuario', $IdUsuario, PDO::PARAM_INT);
    $TodosUsuarios->execute();

    $ArmazenadorDeUsuarios = $TodosUsuarios->fetch(PDO::FETCH_ASSOC);
?>
    <form method="post" action="#">
        <input type="hidden" name="id" value="<?php echo $ArmazenadorDeUsuarios['id']; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $ArmazenadorDeUsuarios['Nome']; ?>"><br>
        <label>Gênero:</label>
        <input type="text" name="genero" value="<?php echo $ArmazenadorDeUsuarios['Genero']; ?>"><br>
        <label>CPF:</label>
        <input type="text" name="cpf" value="<?php echo $ArmazenadorDeUsuarios['CPF']; ?>"><br>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $ArmazenadorDeUsuarios['Telefone']; ?>"><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $ArmazenadorDeUsuarios['Email']; ?>"><br>
        <label>Usuário:</label>
        <input type="text" name="usuario" value="<?php echo $ArmazenadorDeUsuarios['Usuario']; ?>"><br>
        <label>Função:</label>
        <select name="funcao">
            <option value="Usuario" <?php echo ($ArmazenadorDeUsuarios['Funcao'] == 'Usuario') ? 'selected' : ''; ?>>Usuário</option>
            <option value="Administrador" <?php echo ($ArmazenadorDeUsuarios['Funcao'] == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
        </select><br>
        <input type="submit" value="Atualizar">
    </form>
<?php
}
?>

<?php
if (isset($_POST["id"]) && isset($_POST["funcao"])) {
    $IdUsuario = $_POST["id"];
    $novaFuncao = $_POST["funcao"];

    $conexao = new PDO("mysql:host=127.0.0.1;dbname=WallStreet", "root", "");

    $AtualizarUsuario = "UPDATE Perfil SET Funcao = :novaFuncao WHERE id = :idUsuario";
    $comando = $conexao->prepare($AtualizarUsuario);
    $comando->bindParam(':novaFuncao', $novaFuncao, PDO::PARAM_STR);
    $comando->bindParam(':idUsuario', $IdUsuario, PDO::PARAM_INT);
    $comando->execute();
    header("location:inicio.php");
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o envio automático do formulário
        const nomeUsuario = document.querySelector('input[name="nome"]').value;
        Swal.fire({
            title: 'Confirmar Atualização',
            text: `Você tem certeza que deseja mudar a função do usuário ${nomeUsuario}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, atualizar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
              
                document.querySelector('form').submit();
            }
        });
    });
</script>