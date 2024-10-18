<?php
const SERVIDOR = "localhost";
const USUARIO = "root";
const SENHA = "";
const BANCO = "dbavesso";

$conexao = mysqli_connect(SERVIDOR,USUARIO,SENHA,BANCO) 
or die("Erro ao Conectar no servidor: " . mysqli_connect_error() );

/* Define o caracter padrão */
mysqli_set_charset($conexao, 'utf8mb4');
?>