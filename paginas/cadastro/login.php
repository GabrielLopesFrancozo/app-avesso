<?php

include("../../db/conexao.php");


if (isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"])) {

    $emailUsuario = $_POST["emailUsuario"];
    $senhaUsuario = hash('sha256', $_POST["senhaUsuario"]);

    $sql = "SELECT idUsuario, statusCadastro FROM tbusuarios WHERE emailUsuario = '$emailUsuario' AND senhaUsuario = '$senhaUsuario'";
    $result = mysqli_query($conexao, $sql);

    //Verifica se o usuário existe
    if (mysqli_num_rows($result) > 0) {

        $dados = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION["idUsuario"] = $dados["idUsuario"];

        if ($dados["statusCadastro"] < 5) {
            header("Location: ../criarPerfil/criarPerfil-{$dados['statusCadastro']}.php");
        } else {
            header("Location: ../../index.php");
        }

    } else {
        echo "
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script>
            $(document).ready(function() {
                // Mostra o aviso
                $('.error').show();
            });
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Avesso</title>
    <link rel="shortcut icon" type="image/svg" href="../../img/imagens-app/favicon.ico" />
    <link rel="stylesheet" href="../../css/paginas/cadastro.css">
</head>

<body>
    <div class="card-login">
        <img id="logo" src="../../img/imagens-app/Logo-texto.svg" width="200" alt="Avesso - Logo do app">

        <div class="divisor"></div>

        <form action="login.php" method="post">
            <span>Entrar com login e senha</span>

            <div class="area-input">
                <input id="emailUsuario" name="emailUsuario" type="email" placeholder="Email" value="usuario@example.com" required>
                <input id="senhaUsuario" name="senhaUsuario" type="password" placeholder="Senha" value="1234" required>
            </div>

            <div class="error" style="display: none;">
                <span>Email ou senha incorretos!</span>
            </div>

            <input type="submit" value="Entrar">
        </form>

        <div class="divisor-ou">
            <div class="divisor"></div> Ou <div class="divisor"></div>
        </div>

        <button>Entrar com Google</button>

        <span>Não possui uma conta?<a href="cadastro.php">Cadastre-se</a></span>
    </div>
</body>

</html>