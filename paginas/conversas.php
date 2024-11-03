<?php

if (isset($_POST["message"])) {
    $message = $_POST["message"];
    $cumprimentos = ["Oi", "Ola", "oi", "ola", "Bom dia", "Boa noite", "Olá", "olá", "bom dia", "boa noite", "Iai", "iai"];

    $respondido = false;

    for($i = 0; $i < count($cumprimentos); $i++) {
        $c = $cumprimentos[$i];

        if ($message == $c) {
            echo "Olá, tudo bem?";
        } elseif (strpos($message, $c) !== false) {
            echo "Olá, estou bem e com você?";
        } 
        if (strpos($message, 'com voce') !== false && $respondido == false) {
            echo "Estou bem tambem, obrigado por perguntar!";
            $respondido = true;
        } 
        if (strpos($message, 'gosta') !== false && $respondido == false) {
            echo "Bom, eu gosto de me divertir com meus amigos! E voce?";
            $respondido = true;
        } 
    }
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../css/paginas/conversas.css">

<div class="contatos border-2 border-end">
    <div class="titulo">
        <h3>Mensagens</h3>
    </div>
    <div class="pesquisar">
        <input type="text" placeholder="Pesquisar">
    </div>
    <div class="filtros">
        <div class="filter"><a href="index.php?menu=conversas&filtro=tudo">Tudo</a></div>
        <div class="filter"><a href="index.php?menu=conversas&filtro=naoLidos">Não lidos</a></div>
        <div class="filter"><a href="index.php?menu=conversas&filtro=favoritos">Favoritos</a></div>
    </div>
    <div class="divisor"></div>
    <div class="conversas">

    </div>
    <form method="post">
        <input type="text" name="message">
        <button type="submit">Enviar</button>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>