<?php
set_time_limit(0);
include_once('../db/conexao.php');

$extensoes_validas = array(".jpg", ".png", ".bmp");
$caminho_absoluto = "../img/fotos-usuarios/";
$tamanho_bytes = 5000000; // 5 MB

// Verifica se o arquivo foi enviado corretamente
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $idUsuario = $_POST['idUsuario'];
    $nome_arquivo = $_FILES['arquivo']['name'];
    $extensao = strrchr($nome_arquivo, '.');
    $tamanho_arquivo = $_FILES['arquivo']['size'];
    $arquivo_temporario = $_FILES['arquivo']['tmp_name'];
    $nome_arquivo_novo = $idUsuario . $extensao;

    // Verifica o tamanho do arquivo
    if ($tamanho_arquivo > $tamanho_bytes) {
        die("Arquivo deve ter no máximo {$tamanho_bytes} bytes.;aviso");
    }

    // Verifica se a extensão é válida
    if (!in_array($extensao, $extensoes_validas)) {
        die("Extensão de arquivo de imagem inválida para o upload.;aviso");
    }

    // Verifica se a pasta de destino existe e se é gravável
    if (!is_dir($caminho_absoluto) || !is_writable($caminho_absoluto)) {
        die("O diretório de destino não existe ou não tem permissões de escrita.;erro");
    }

    // Move o arquivo para o caminho de destino
    if (move_uploaded_file($arquivo_temporario, $caminho_absoluto . $nome_arquivo_novo)) {
        // Atualiza o caminho da foto no banco de dados
        $sql = "UPDATE tbusuarios SET fotoPerfilUsuario = '{$nome_arquivo_novo}' WHERE idUsuario = '{$idUsuario}'";
        mysqli_query($conexao, $sql);

        if (mysqli_affected_rows($conexao) > 0) {
            echo "./img/fotos-usuarios/{$nome_arquivo_novo};concluido";
        } else {
            die("Erro ao atualizar o banco de dados.;erro");
        }
    } else {
        die("O arquivo não pode ser copiado para o servidor.;erro");
    }
} else {
    // Exibe erro se o arquivo não foi corretamente enviado
    switch ($_FILES['arquivo']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            die("O arquivo excede o limite de tamanho permitido.;aviso");
        case UPLOAD_ERR_NO_FILE:
            die("Nenhum arquivo foi enviado.;aviso");
        default:
            die("Erro no upload do arquivo.;erro");
    }
}
?>
