<?php

include("../../db/conexao.php");

session_start();

// Verifica se o usuário enviou o formulário
if (isset($_POST["nome-completo"]) && isset($_POST["email"]) && isset($_POST["senha"])) {

    $nomeCompleto = $_POST["nome-completo"];
    $nomesIndividuais = explode(" ", $nomeCompleto);

    if (count($nomesIndividuais) > 1) {
        $nome = $nomesIndividuais[0];
        $sobrenome = implode(" ", array_slice($nomesIndividuais, 1));
    } else {
        $nome = $nomeCompleto;
        $sobrenome = "";
    }

    $email = $_POST["email"];
    $senha = hash('sha256', $_POST["senha"]);

    $sql = "SELECT emailUsuario FROM tbusuarios WHERE emailUsuario = '$email'";
    $result = mysqli_query($conexao, $sql);

    //Verifica se o usuário já tem cadastro
    if (mysqli_num_rows($result) > 0) {
        echo "Usuário já cadastrado";
    } else {

        $sql = "INSERT INTO tbusuarios (nomeUsuario, sobrenomeUsuario, emailUsuario, senhaUsuario) VALUES ('$nome', '$sobrenome', '$email', '$senha')";
        $result = mysqli_query($conexao, $sql);

        $sql = "SELECT idUsuario FROM tbusuarios WHERE emailUsuario = '$email' AND senhaUsuario = '$senha'";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);

        $_SESSION["idUsuario"] = $row["idUsuario"];

        if ($result) {
            header("Location: ../criarPerfil/explicacao-1.php");
        } else {
            echo "Erro ao cadastrar";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Avesso</title>
</head>

<body>
    <h1>Cadastro</h1>

    <form action="cadastro.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="nome-complet">Nome completo:</label>
        <input type="text" name="nome-completo" id="nome-completo" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <label for="termos">Ao continuar você concorda com nossos <a href="../termos.php">Termos e condições</a>:</label>
        <br>
        <input type="submit" value="Continuar">
    </form>

    <label>- Ou -</label><br>

    <button>Entrar com Google</button><br>

    <label for="conta">Já possui uma conta?<a href="login.php">Conecte-se</a></label>
</body>

</html>