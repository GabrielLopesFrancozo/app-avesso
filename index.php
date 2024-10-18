<?php
include("./db/conexao.php");

session_start();

if (!isset($_SESSION["emailUsuario"]) && !isset($_SESSION["senhaUsuario"])) {
    header("Location: ./paginas/cadastro/login.php");
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav id="bottom-navbar" class="navbar bg-light justify-content-center fixed-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?menu=principal">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=conversas">Conversas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=pesquisar">Pesquisar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=perfil">Perfil</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container-fluid d-flex p-0">
        <div id="sidebar" class="navbar bg-light align-items-start border-2 border-end" style="width: 200px;">
            <ul class="navbar-nav flex-column">
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
                    <a class="nav-link <?php if ($menu == "perfil") echo "active"; ?>" href="index.php?menu=perfil">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "configuracoes") echo "active"; ?>" href="index.php?menu=configuracoes">Configurações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($menu == "sair") echo "active"; ?>" href="index.php?menu=sair">Sair</a>
                </li>
            </ul>
        </div>
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
                case "perfil":
                    include("./paginas/perfil.php");
                    break;
                case "configuracoes":
                    include("./paginas/configuracoes.php");
                    break;
                case "sair":
                    include("./paginas/cadastro/logout.php");
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