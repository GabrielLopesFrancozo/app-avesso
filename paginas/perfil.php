<?php
    $sql = "SELECT * FROM tbusuarios WHERE idUsuario = $idUsuario";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);
?>

<h1>Perfil</h1>

<div id="win-size" class="bg-dark text-light p-1"></div>

<img id="foto-usuario" src="./img/fotos-usuarios/<?= $dados["fotoPerfilUsuario"] ?>" alt="Foto do usuário" style="width: 200px; height: 200px; object-fit: cover;">

<div style="display: flex; flex-direction: row; gap: 10px;">
<h4 style="display: flex;"><?= $dados["nomeUsuario"] . " " . $dados["sobrenomeUsuario"] ?></h4>
<p style="display: flex;">    <?php
    function calcularIdade($dataNascimento)
    {
        $dataNascimento = new DateTime($dataNascimento); // Converte a data de nascimento para um objeto DateTime
        $dataAtual = new DateTime(); // Obtém a data atual
        $idade = $dataAtual->diff($dataNascimento); // Calcula a diferença entre a data atual e a data de nascimento
        return $idade->y; // Retorna a idade em anos
    }

    // Exemplo de uso
    $dataNascUsuario = $dados["dataNascUsuario"]; // Formato: AAAA-MM-DD
    $idade = calcularIdade($dataNascUsuario);
    echo $idade . " anos";
    ?></p>

</div>
<p id="bioUsuario"> <?= $dados["bioUsuario"] ?></p>

<div class="hashtags" style="display: flex; flex-direction: row; flex-wrap: wrap;">
    <?php
    $sql = "SELECT * FROM tbhashtags WHERE idUsuario = $idUsuario";
    $result = mysqli_query($conexao, $sql);

    while ($dados = mysqli_fetch_assoc($result)) {
        echo
        "<p style='margin-right: 10px; border: 1px solid black; padding-left: 10px; padding-right: 10px; padding-top: 3px; padding-bottom: 3px; border-radius: 150px; display: flex;'>#" . htmlspecialchars($dados["tituloHashtag"]) . "
                    </p>
                    ";
    }
    ?>

</div>

<p>Ingressou no Avesso em <?php     $sql = "SELECT * FROM tbusuarios WHERE idUsuario = $idUsuario";
    $result = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($result);echo $dados["dataCadastro"] ?></p>