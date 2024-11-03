<link rel="shortcut icon" type="image/svg" href="../../img/imagens-app/Logo-icone.svg"/>
<link rel="stylesheet" href="../../componentes/modal/modal.css">

<?php
class Modal {

    public $titulo;
    public $texto;
    public $botao;
    public $redirect;

    public function __construct($titulo = "Alerta", $texto = "Algo deu errado.", $botao = "Ok", $redirect = "../../paginas/cadastro/login.php") {
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->botao = $botao;
        $this->redirect = $redirect;
    }

    public function exibir() {
        echo "
        <!-- Modal de Alerta -->
        <div id='modal' style='display: none;'>
            <div class='conteudo-modal'>
                <h2>{$this->titulo}</h2>
                <p>{$this->texto}</p>
                <button id='fechar-modal'>{$this->botao}</button>
                <button id='fechar'>Voltar</button>
                </div>
        </div>

        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script>
            $(document).ready(function() {
                // Mostra o modal
                $('#modal').fadeIn(100);

                // Fecha o modal e redireciona quando o botão OK é clicado
                $('#fechar-modal').click(function() {
                    $('#modal').hide();

                    window.location.href = '{$this->redirect}';
                });

                // Fecha o modal
                $('#fechar').click(function() {
                    $('#modal').hide();

                    window.location.href = document.referrer;
                });
            });
        </script>
        ";
    }
}
?>