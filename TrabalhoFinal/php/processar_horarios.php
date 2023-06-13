<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $data = $_POST["data"];
    $inicio = $_POST["inicio"];
    $fim = $_POST["fim"];

    // Validação dos dados (pode ser adicionada de acordo com suas necessidades)

    // Insere cada período no banco de dados
    include("conexao.php"); // Inclua o arquivo de conexão ao banco de dados

    // Loop para inserir cada período
    for ($i = 0; $i < count($inicio); $i++) {
        $periodo_inicio = $data . ' ' . $inicio[$i];
        $periodo_fim = $data . ' ' . $fim[$i];

        // Verifica se já existem períodos de entrevista para o mesmo horário
        $query = "SELECT * FROM entrevistas WHERE periodo_inicio = '$periodo_inicio' OR periodo_fim = '$periodo_fim'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) > 0) {
            // Se já existem períodos de entrevista para o mesmo horário, exiba uma mensagem de erro ou tome outra ação adequada
            
            header("Location: admin.php?mensagem=Já existe um período de entrevista marcado para esse horário.");
        } else {
            // Se não existem períodos de entrevista para o mesmo horário, insere o novo período no banco de dados
            $query = "INSERT INTO entrevistas (periodo_inicio, periodo_fim) VALUES ('$periodo_inicio', '$periodo_fim')";
            mysqli_query($conexao, $query);
            
            header("Location: admin.php?mensagem=Período de entrevista marcado com sucesso!");
        }
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
