<?php

include("../../db/conexao.php");

// Verifica se o usuário realizou o envio do formulário
if (isset($_POST["nomeCompleto"]) && isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"]) && isset($_POST["dataNascUsuario"])) {

    $dataNascUsuario = $_POST["dataNascUsuario"];
    $idade = calcularIdade($dataNascUsuario);

    if ($idade >= 18) {
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

            session_start();
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
    } else {
        include("../../componentes/modal/modal.php");
        $modal = new Modal("Atenção!", "Você deve ter pelo menos 18 anos para se cadastrar.", "Ok", "../../paginas/cadastro/cadastro.php");
        $modal->exibir();
    }
}

function calcularIdade($dataNascUsuario)
{
    $dataNasc = new DateTime($dataNascUsuario);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNasc);
    return $idade->y;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Avesso</title>
    <link rel="shortcut icon" type="image/svg" href="../../img/imagens-app/favicon.ico" />
    <link rel="stylesheet" href="../../css/paginas/cadastro.css">
</head>

<body>
    <div class="card-cadastro">
        <img id="logo" src="../../img/imagens-app/Logo-texto.svg" width="200" alt="Avesso - Logo do app">

        <div class="divisor"></div>

        <form action="cadastro.php" method="post">
            <span>Cadastrar-se</span>

            <div class="area-input">
                <input
                    id="emailUsuario"
                    name="emailUsuario"
                    type="email"
                    placeholder="Email"
                    value="usuario@example.com"
                    required>
                <input
                    id="senhaUsuario"
                    name="senhaUsuario"
                    type="password"
                    placeholder="Senha"
                    value="1234"
                    required>
                <input
                    id="nomeCompleto"
                    name="nomeCompleto"
                    type="text"
                    placeholder="Nome completo"
                    value="Usuário Teste"
                    required>
                <input
                    id="dataNascUsuario"
                    name="dataNascUsuario"
                    type="text"
                    placeholder="Data de nascimento"
                    onfocus="this.type='date'"
                    onblur="if (!this.value) this.type='text'"
                    value="2000-01-01"
                    required>
                <input
                    id="localizacaoUsuario"
                    name="localizacaoUsuario"
                    placeholder="Localização"
                    value="Brasília"
                    type="text">
            </div>

            <label id="termos" for="termos">Ao continuar você concorda com nossos <a href="../termos.php">Termos e condições</a></label>

            <input type="submit" value="Continuar">
        </form>

        <div class="divisor-ou">
            <div class="divisor"></div> Ou <div class="divisor"></div>
        </div>

        <button>Entrar com Google</button>

        <span>Já possui uma conta?<a href="login.php">Conecte-se</a></span>
    </div>

</body>

</html>