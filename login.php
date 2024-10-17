<?php
    include("db/conexao.php");

    if (isset($_POST["email-tel"]) && isset($_POST["senha"])) {
        $email_tel = $_POST["email-tel"];
        $senha = $_POST["senha"];

        $sql = "SELECT emailUsuario, telefoneUsuario, senhaUsuario FROM tbusuarios WHERE (emailUsuario = '$email_tel' OR telefoneUsuario = '$email_tel') AND senhaUsuario = '$senha'";
        $result = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($email_tel == $row["emailUsuario"] || $email_tel == $row["telefoneUsuario"]) {
                session_start();
                $_SESSION["email_tel"] = $email_tel;
                header("Location: index.php");
            } else {
                echo "Email, telefone ou senha incorretos";
            }
        } else {
            echo "Email, telefone ou senha incorretos";
        }
    }
?>

<h1>Login</h1>

<form action="login.php" method="post">
    <label for="email-tel">Email ou telefone:</label>
    <input type="text" name="email-tel" id="email-tel" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <br>
    <input type="submit" value="Entrar">
</form>

<label for="ou">- Ou -</label><br>

<button>Entrar com Google</button><br>

<label for="conta">Não tem uma conta?<a href="cadastro.php">Cadastre-se</a></label>