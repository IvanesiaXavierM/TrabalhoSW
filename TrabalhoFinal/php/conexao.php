<?php
$hostname = "localhost";
$bancodedados = "cadastro";
$usuario = "root";
$senha ="";

// Cria a conexão
$conexao =  mysqli_connect($hostname, $usuario ,$senha ,$bancodedados );

// Verifica se houve erro na conexão
if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados:( " . $conexao->connect_error. ")".$conexao->connect_error;
}
    


?>