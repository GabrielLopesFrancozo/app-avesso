<?php
include("../../db/conexao.php");

session_start();

$idUsuario = $_SESSION["idUsuario"];

$sql = "SELECT * FROM tbusuarios WHERE idUsuario = $idUsuario";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($resultado);

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

        <div class="adicionarInfoContainer" style="border: 1px solid black;">
            <p>Adicione uma foto para seu perfil</p>

            <div class="fotoPerfil" style="width: 200px; height: 200px; display: flex; justify-content: center; align-items: center;">
                <?php
                if ($dados["fotoPerfilUsuario"] == "" || !file_exists('../../img/fotos-usuarios/' . $dados["fotoPerfilUsuario"])) {
                    $nomeFoto = "SemFoto.jpg";
                } else {
                    $nomeFoto = $dados["fotoPerfilUsuario"];

                    $sql = "UPDATE tbusuarios SET statusCadastro = 2 WHERE idUsuario = $idUsuario";
                    $resultado = mysqli_query($conexao, $sql);

                    if ($resultado) {
                        // header("Location: ../criarPerfil/criarperfil-2.php");
                    }
                }
                ?>
                <img id="foto-usuario" src="../../img/fotos-usuarios/<?= $nomeFoto ?>" alt="Foto do usuário" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div id="editar-foto">
                <form id="form-upload-foto" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idUsuario" value="<?= $idUsuario ?>">
                    <label class="form-label" for="arquivo">Selecione um arquivo de imagem da foto</label>
                    <div>
                        <input id="arquivo" type="file" name="arquivo">
                        <input id="btn-enviar-foto" type="submit" value="Enviar">
                    </div>
                </form>

                <div id="mensagem" class="mb-3 alert alert-success"></div>

            </div>
        </div>
    </div>

    <div class="inferior">
        <a href="criarPerfil-2.php"><?= $dados["fotoPerfilUsuario"] != "SemFoto.jpg" ? "Próximo" : "Pular" ?></a>
    </div>

    <script src="../../js/jquery.js"></script>
    <script src="../../js/jquery.form.js"></script>
    <script src="../../js/upload.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="../../js/validation.js"></script>
</body>

</html>