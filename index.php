<!-- <?php
        include("./db/conexao.php");
        ?> -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avesso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center fixed-bottom h">
        <ul class="navbar-nav nav-underline">
            <li class="nav-item active">
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
    <main>
        <div class="container">
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
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>