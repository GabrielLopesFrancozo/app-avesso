<?php

include("../../db/conexao.php");

session_start();

// Verifica se o usuário realizou o envio do formulário
if (isset($_POST["nomeCompleto"]) && isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"]) && isset($_POST["dataNascUsuario"])) {

    $nomeCompleto = $_POST["nomeCompleto"];
    $nomesIndividuais = explode(" ", $nomeCompleto);

    if (count($nomesIndividuais) > 1) {
        $nomeUsuario = $nomesIndividuais[0];
        $sobrenomeUsuario = implode(" ", array_slice($nomesIndividuais, 1));
    } else {
        $nomeUsuario = $nomeCompleto;
        $sobrenomeUsuario = "";
    }

    $emailUsuario = $_POST["emailUsuario"];
    $senhaUsuario = hash('sha256', $_POST["senhaUsuario"]);
    $dataNascUsuario = $_POST["dataNascUsuario"];

    // Procura se o usuário existe no banco de dados
    $sql = "SELECT emailUsuario FROM tbusuarios WHERE emailUsuario = '$emailUsuario'";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se o usuário já possui cadastro
    if (mysqli_num_rows($resultado) > 0) {
        echo "Usuário já cadastrado";
    } else {
        // Insere o usuário no banco de dados
        $sql = "INSERT INTO tbusuarios (nomeUsuario, sobrenomeUsuario, emailUsuario, senhaUsuario, dataNascUsuario) VALUES ('$nomeUsuario', '$sobrenomeUsuario', '$emailUsuario', '$senhaUsuario', '$dataNascUsuario')";
        $resultado = mysqli_query($conexao, $sql);

        // Cria uma sessão para o usuário
        $sql = "SELECT idUsuario, statusCadastro FROM tbusuarios WHERE emailUsuario = '$emailUsuario'";
        $resultado = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($resultado);

        $_SESSION["idUsuario"] = $dados["idUsuario"];

        if ($resultado) {
            // Atualiza o status de cadastro para 1
            $sql = "UPDATE tbusuarios SET statusCadastro = 1 WHERE idUsuario = $dados[idUsuario]";
            $resultado = mysqli_query($conexao, $sql);
            header("Location: ../criarPerfil/tutorial-1.php");
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
    <form action="cadastro.php" method="post">
        <img src="../../img/imagens-app/Logo.svg" alt="Avesso - Nome do app">
        <br>
        <spam>Cadastrar-se</spam>
        <br>
        <label for="emailUsuario">Email:</label>
        <input type="email" name="emailUsuario" id="emailUsuario" required>
        <br>
        <label for="nomeCompleto">Nome completo:</label>
        <input type="text" name="nomeCompleto" id="nomeCompleto" required>
        <br>
        <label for="senhaUsuario">Senha:</label>
        <input type="password" name="senhaUsuario" id="senhaUsuario" required>
        <br>
        <label for="dataNascUsuario">Data de nascimento:</label>
        <input type="date" name="dataNascUsuario" id="dataNascUsuario" required>
        <br>
        <label for="localizacaoUsuario">Cidade:</label>
        <input type="text" name="localizacaoUsuario" id="localizacaoUsuario">
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