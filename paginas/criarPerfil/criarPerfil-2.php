<?php
    include("../../db/conexao.php");
   
    session_start();

    $idUsuario = $_SESSION["idUsuario"];
    if (isset($_POST["bioUsuario"])) {
        $bio = $_POST["bioUsuario"];
        $sql = "UPDATE tbusuarios SET bioUsuario = '$bio' WHERE idUsuario = $idUsuario";
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
    <h1>Personalize sua conta</h1>
    <p>Adicione uma pequena biografia</p>
    <h2><?= $dados["nomeUsuario"] ?></h2>
    <div class="col-12">
        <?php
        if ($dados["fotoPerfilUsuario"] == "" || !file_exists('../../img/fotos-usuarios/' . $dados["fotoPerfilUsuario"])) {
            $nomeFoto = "SemFoto.jpg";
        } else {
            $nomeFoto = $dados["fotoPerfilUsuario"];
        }
        ?>
        <div class="mb-3">
            <img id="foto-usuario" class="img-fluid img-thumbnail" width="200" src="../../img/fotos-usuarios/<?= $nomeFoto ?>" alt="Foto do Usuário">
        </div>

<div>
    <form action="" method="post">
        <input type="text" name="bioUsuario" id="bioUsuario" value="<?= $dados["bioUsuario"] ?>"> 
        <button type="submit">+</button>
    </form>
</div>

        <a href="criarPerfil-1.php">Voltar</a>
        <a href="criarPerfil-3.php">Próximo</a>
    </div>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/jquery.form.js"></script>
    <script src="../../js/upload.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="../../js/validation.js"></script>
</body>

</html>