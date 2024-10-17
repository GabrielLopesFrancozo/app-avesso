<?php

include("db/conexao.php");

session_start();

if (isset($_POST["nome-completo"]) && isset($_POST["email-tel"]) && isset($_POST["senha"]) && isset($_POST["confirmar-senha"])) {

    $nomeCompleto = $_POST["nome-completo"];
    $nomesIndividuais = explode(" ", $nomeCompleto);

    if (count($nomesIndividuais) > 1) {
        $nome = $nomesIndividuais[0];
        $sobrenome = implode(" ", array_slice($nomesIndividuais, 1));
    } else {
        $nome = $nomeCompleto;
        $sobrenome = "";
    }

    $email = strpos($_POST["email-tel"], "@") ? $_POST["email-tel"] : "";
    if ($email == "") {
        $telefone = $_POST["email-tel"];
    } else {
        $telefone = "";
    }

    $senha = $_POST["senha"];
    $senhaConfirmada = $_POST["confirmar-senha"];

    if ($senha != $senhaConfirmada) {
        echo "Senhas diferentes";
    } else {

        $sql = "SELECT emailUsuario FROM tbusuarios WHERE emailUsuario = '$email'";
        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Email ou telefone ja existente";
        } else {

            $sql = "INSERT INTO tbusuarios (nomeUsuario, sobrenomeUsuario, emailUsuario, senhaUsuario) VALUES ('$nome', '$sobrenome', '$email', '$senha')";
            $result = mysqli_query($conexao, $sql);

            $sql = "SELECT idUsuario FROM tbusuarios WHERE emailUsuario = '$email' AND senhaUsuario = '$senha'";
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_fetch_assoc($result);

            $_SESSION["idUsuario"] = $row["idUsuario"];

            if ($result) {
                header("Location: cadastro2.php");
            } else {
                echo "Erro ao cadastrar";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Avesso</title>
</head>

<body>
    <h1>Cadastro</h1>

    <form action="cadastro.php" method="post">
        <label for="email-tel">Email ou telefone:</label>
        <input type="text" name="email-tel" id="email-tel" required>
        <br>
        <label for="nome-complet">Nome completo:</label>
        <input type="text" name="nome-completo" id="nome-completo" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <label for="confirmar-senha">Confirme sua senha:</label>
        <input type="password" name="confirmar-senha" id="confirmar-senha" required>
        <br>
        <label for="termos">Aceito os <a href="./termosECondicoes.php">termos e condições</a>:</label>
        <input type="checkbox" name="termos" id="termos" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>

    <label for="ou">- Ou -</label><br>

    <button>Entrar com Google</button><br>

    <label for="conta">Já tem uma conta?<a href="login.php">Logue-se</a></label>
</body>

</html>