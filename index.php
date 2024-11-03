<?php
include("./db/conexao.php");

session_start();

if (!isset($_SESSION["idUsuario"])) {
    header("Location: ./paginas/cadastro/login.php");
} else {
    $idUsuario = $_SESSION["idUsuario"];

    $sql = "SELECT * FROM tbusuarios WHERE idUsuario = $idUsuario";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);

    if ($dados["statusCadastro"] != 5) {
        header("Location: ./paginas/cadastro/login.php");
    }
}

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
} else {
    $menu = "";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avesso</title>
    <link rel="shortcut icon" type="image/svg" href="./img/imagens-app/Logo-icone.svg" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid d-flex p-0">
        <nav class="sidebar navbar border-2 border-end">
            <ul class="navbar-nav">
                <img src="./img/imagens-app/Logo-texto.svg" width="150" alt="">
                <div class="divisor"></div>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "principal") echo "active"; ?>" aria-current="page" href="index.php?menu=principal">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "conversas") echo "active"; ?>" href="index.php?menu=conversas">Conversas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "pesquisar") echo "active"; ?>" href="index.php?menu=pesquisar">Pesquisar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "notificacoes") echo "active"; ?>" href="index.php?menu=notificacoes">Notificações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "perfil") echo "active"; ?>" href="index.php?menu=perfil">Perfil</a>
                </li>
                <div class="nav-bottom">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu == "configuracoes") echo "active"; ?>" href="index.php?menu=configuracoes">Configurações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu == "sair") echo "active"; ?>" href="index.php?menu=sair">Sair</a>
                    </li>
                </div>
            </ul>
        </nav>
        <main>
            <?php
            switch ($menu) {
                case "principal":
                    include("./paginas/principal.php");
                    break;
                case "conversas":
                    include("./paginas/conversas.php");
                    break;
                case "pesquisar":
                    include("./paginas/pesquisar.php");
                    break;
                case "notificacoes":
                    include("./paginas/notificacoes.php");
                    break;
                case "perfil":
                    include("./paginas/perfil.php");
                    break;
                case "configuracoes":
                    include("./paginas/configuracoes.php");
                    break;
                case "sair":
                    include("./componentes/modal/modal.php");
                    $modal = new Modal("Sair", "Você realmente deseja sair?", "Sair", "../../paginas/cadastro/logout.php");
                    $modal->exibir();
                    break;
                default:
                    include("./paginas/principal.php");
            }
            ?>
        </main>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Local Script -->
    <script src="./js/resizeWindow.js"></script>
    <script src="./js/removeBlur.js"></script>
</body>

</html>