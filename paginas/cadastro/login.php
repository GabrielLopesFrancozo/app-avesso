<?php

include("../../db/conexao.php");

if (isset($_POST["email"]) && isset($_POST["senha"])) {
    $emailUsuario = $_POST["email"];
    $senhaUsuario = hash('sha256', $_POST["senha"]);

    $sql = "SELECT idUsuario, nomeUsuario, emailUsuario, senhaUsuario, fotoPerfilUsuario FROM tbusuarios WHERE emailUsuario = '$emailUsuario' AND senhaUsuario = '$senhaUsuario'";
    $result = mysqli_query($conexao, $sql);

    //Verifica se o usuário existe
    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if($row["fotoPerfilUsuario"] == "null"){
            session_start();
            $_SESSION["idUsuario"] = $row["idUsuario"];
            header("Location: ../criarPerfil/criarPerfil-1.php");

        } else {
            session_start();
            $_SESSION["emailUsuario"] = $emailUsuario;
            $_SESSION["senhaUsuario"] = $senhaUsuario;
            $_SESSION["nomeUsuario"] = $row["nomeUsuario"];
            $_SESSION["idUsuario"] = $row["idUsuario"];
            header("Location: ./../../index.php");
        }
    } else {
        echo "Email ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Avesso</title>
</head>

<body>
    <h1>Login</h1>

    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <input type="submit" value="Entrar">
    </form>

    <label for="ou">- Ou -</label><br>

    <button>Entrar com Google</button><br>

    <label for="conta">Não possui uma conta?<a href="cadastro.php">Cadastre-se</a></label>
</body>

</html>