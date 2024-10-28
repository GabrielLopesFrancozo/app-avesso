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

<body style="display: flex; flex-direction: column; gap: 10px;">

    <div class="progresso" style="border: 1px solid black;">
        <spam><?php echo $dados["statusCadastro"] ?></spam>
    </div>

    <div class="principal" style="width: 100%;">
        <h1>Customizando perfil</h1>
        <div class="conteudoPrincipal" style="display: flex; flex-direction: row; gap: 10px; width: 100%;">
            <div class="previsualizacao" style="border: 1px solid black; width: 18rem; display: flex; flex-direction: column; justify-content: start; align-items: center;">
                <div class="fotoUsuario">
                    <?php
                    if ($dados["fotoPerfilUsuario"] == "" || !file_exists('../../img/fotos-usuarios/' . $dados["fotoPerfilUsuario"])) {
                        $nomeFoto = "SemFoto.jpg";
                    } else {
                        $nomeFoto = $dados["fotoPerfilUsuario"];
                    }
                    ?>
                    <img src="../../img/fotos-usuarios/<?= $nomeFoto ?>" alt="Foto do usuário" width="100">
                </div>
                <p><?= $dados["nomeUsuario"] . " " . $dados["sobrenomeUsuario"] ?></p>
            </div>
            <div class="adicionarFoto" style="border: 1px solid black; width: 100%;">
                <p>Adicione uma foto para seu perfil</p>
                <div class="col-12">
                    <div class="mb-3" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        <img id="foto-usuario" src="../../img/fotos-usuarios/<?= $nomeFoto ?>" alt="Foto do usuário" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" id="btn-editar-foto">
                            <i class="bi bi-camera"></i> Editar Foto
                        </button>
                    </div>
                    <div id="editar-foto">
                        <form id="form-upload-foto" class="mb-3" method="post">
                            <input type="hidden" name="idUsuario" value="<?= $idUsuario ?>">
                            <label class="form-label" for="arquivo">Selecione um arquivo de imagem da foto</label>
                            <div class="input-group">
                                <input class="form-control" type="file" name="arquivo" id="arquivo">
                                <input id="btn-enviar-foto" class="btn btn-secondary" type="submit" value="Enviar">
                            </div>
                        </form>

                        <div id="mensagem" class="mb-3 alert alert-success">

                        </div>
                        <div id="preloader" class="progress">
                            <div id="barra"
                                class="progress-bar bg-danger"
                                role="progressbar"
                                style="width: 0%"
                                aria-valuenow="0"
                                aria-valuemin="0"
                                aria-valuemax="100">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="inferior">
        <a href="criarPerfil-2.php"><?= isset($_POST["arquivo"])?"Próximo":"Pular" ?></a>
    </div>

    <script src="../../js/jquery.js"></script>
    <script src="../../js/jquery.form.js"></script>
    <script src="../../js/upload.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="../../js/validation.js"></script>
</body>

</html>