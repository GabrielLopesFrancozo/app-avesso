<?php
include("../../db/conexao.php");

session_start();

$idUsuario = $_SESSION["idUsuario"];

if (isset($_POST["bioUsuario"])) {
    $bio = $_POST["bioUsuario"];
    $sql = "UPDATE tbusuarios SET bioUsuario = '$bio', statusCadastro = 3 WHERE idUsuario = $idUsuario";
    mysqli_query($conexao, $sql);
}

$sql = "SELECT * FROM tbusuarios WHERE idUsuario = $idUsuario";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Avesso</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="progresso" style="border: 1px solid black;">
        <p><?php echo $dados["statusCadastro"] ?></p>
    </div>

    <div class="principal" style="width: 100%;">
        <h1>Customizando perfil</h1>

        <div class="previzualizacao">
            <img src="../../img/fotos-usuarios/<?= $dados["fotoPerfilUsuario"] ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="Foto do Usuário">
            <p id="bioUsuario"> <?= $dados["bioUsuario"] ?></p>
        </div>

        <div class="adicionarInfoContainer" style="border: 1px solid black;">
            <p>Adicione uma bio</p>
            <div class="bio">
                <form method="post">
                    <input id="bioUsuarioInput" type="text" name="bioUsuario" required>
                    <button type="submit">Ok</button>
                </form>
            </div>
        </div>
    </div>

    <div class="inferior">
        <a href="criarPerfil-1.php">Voltar</a>
        <a href="criarPerfil-3.php">Próximo</a>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>