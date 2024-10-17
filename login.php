<?php
include("db/conexao.php");

if (isset($_POST["email"]) && isset($_POST["senhaUsuario"])) {
    $emailUsuario = $_POST["email"];
    $senhaUsuario = $_POST["senhaUsuario"];

    $sql = "SELECT nomeUsuario, emailUsuario, senhaUsuario FROM tbusuarios WHERE emailUsuario = '$emailUsuario' AND senhaUsuario = '$senhaUsuario'";
    $result = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($emailUsuario == $row["emailUsuario"]) {
            session_start();
            $_SESSION["emailUsuario"] = $emailUsuario;
            $_SESSION["senhaUsuario"] = $senhaUsuario;
            $_SESSION["nomeUsuario"] = $row["nomeUsuario"];
            header("Location: index.php");
        } else {
            echo "Email, telefone ou senha incorretos";
        }
    } else {
        echo "Email, telefone ou senha incorretos";
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
        <label for="senhaUsuario">Senha:</label>
        <input type="password" name="senhaUsuario" id="senhaUsuario" required>
        <br>
        <input type="submit" value="Entrar">
    </form>

    <label for="ou">- Ou -</label><br>

    <button>Entrar com Google</button><br>

    <label for="conta">Não tem uma conta?<a href="cadastro.php">Cadastre-se</a></label>
</body>

</html>