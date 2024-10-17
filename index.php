<?php
    include("./db/conexao.php");

    session_start();

    if (!isset($_SESSION["emailUsuario"]) && !isset($_SESSION["senhaUsuario"])) {
        header("Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App | Avesso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav id="bottom-navbar" class="navbar bg-light justify-content-center fixed-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?menu=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=chats">Chats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=profile">Profile</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container-fluid d-flex p-0">
        <div id="sidebar" class="navbar bg-light align-items-start border-2 border-end" style="width: 200px;">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a id="sidebar-link" class="nav-link" aria-current="page" href="index.php?menu=home">Home</a>
                </li>
                <li class="nav-item">
                    <a id="sidebar-link" class="nav-link" href="index.php?menu=chats">Chats</a>
                </li>
                <li class="nav-item">
                    <a id="sidebar-link" class="nav-link" href="index.php?menu=profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a id="sidebar-link" class="nav-link" href="logout.php">Sair</a>
                </li>
                <li class="nav-item">
                    <a id="sidebar-link" class="nav-link" href="#"><?php echo $_SESSION["nomeUsuario"]; ?></a>
                </li>
            </ul>
        </div>
        <main>
            <?php
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
            } else {
                $menu = "";
            }

            switch ($menu) {
                case "home":
                    include("home.php");
                    break;
                case "chats":
                    include("chats.php");
                    break;
                case "profile":
                    include("profile.php");
                    break;
                default:
                    include("home.php");
            }
            ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/resizeWindow.js"></script>
</body>

</html>