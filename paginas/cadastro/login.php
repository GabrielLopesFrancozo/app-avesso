<?php

include("../../db/conexao.php");

if (isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"])) {
    $emailUsuario = $_POST["emailUsuario"];
    $senhaUsuario = hash('sha256', $_POST["senhaUsuario"]);

    $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, senhaUsuario, fotoPerfilUsuario, statusCadastro FROM tbusuarios WHERE emailUsuario = '$emailUsuario' AND senhaUsuario = '$senhaUsuario'";
    $result = mysqli_query($conexao, $sql);

    //Verifica se o usuário existe
    if (mysqli_num_rows($result) > 0) {

        $dados = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION["idUsuario"] = $dados["idUsuario"];

        switch ($dados["statusCadastro"]) {
            case 0:
                header("Location: ../criarPerfil/criarPerfil-1.php");
                break;
            
            case 1:
                header("Location: ../criarPerfil/criarPerfil-2.php");
                break;
            
            case 2:
                header("Location: ../criarPerfil/criarPerfil-3.php");
                break;
            
            case 3:
                header("Location: ../criarPerfil/criarPerfil-4.php");
                break;
            
            default:
                echo "<p>Lamentamos, ocorreu um erro inesperado :(</p>";
                break;
        }

        // if($dados["statusCadastro"] == 0){
        //     header("Location: ./../../index.php");

        // } else {
        //     session_start();
        //     $_SESSION["emailUsuario"] = $emailUsuario;
        //     $_SESSION["senhaUsuario"] = $senhaUsuario;
        //     $_SESSION["nomeUsuario"] = $dados["nomeUsuario"];
        //     $_SESSION["idUsuario"] = $dados["idUsuario"];
            
        // }
    } else {
        echo "Email ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Avesso</title>
</head>

<body>
    <form action="login.php" method="post">
        <img src="../../img/imagens-app/Logo.svg" alt="Avesso - Nome do app">
        <br>
        <spam>Entrar com login e senha</spam>
        <br>
        <label for="emailUsuario">Email:</label>
        <input type="email" name="emailUsuario" id="emailUsuario" required>
        <br>
        <label for="senhaUsuario">Senha:</label>
        <input type="password" name="senhaUsuario" id="senhaUsuario" required>
        <br>
        <input type="submit" value="Entrar">
    </form>

    <label for="ou">- Ou -</label><br>

    <button>Entrar com Google</button><br>

    <label for="conta">Não possui uma conta?<a href="cadastro.php">Cadastre-se</a></label>
</body>

</html>