<?php
session_start();

include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    // Redireciona para a página de login caso não esteja logado
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

// Verifica se o usuário já agendou um horário de entrevista
$sql_entrevista = "SELECT * FROM entrevistas_agendadas WHERE curriculo_id = (SELECT email FROM curriculos WHERE email = '$email')";
$result_entrevista = $conexao->query($sql_entrevista);

if ($result_entrevista->num_rows > 0) {
    // O usuário já agendou um horário, redireciona para a página principal
    header('Location: index.php');
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o horário selecionado
    $horarioSelecionado = $_POST['horario'];

    // Divide o valor para obter o ID do período e o horário selecionado
    $horarioExplode = explode('-', $horarioSelecionado);
    $periodoId = $horarioExplode[0];
    $horario = $horarioExplode[1];

    // Obtém a data atual no formato desejado
    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date('Y-m-d H:i:s');

    // Combina a data atual com o horário selecionado
    $dataHorarioSelecionado = date('Y-m-d', strtotime($dataAtual)) . ' ' . $horario;

    // Insere o agendamento da entrevista no banco de dados
    $sql_agendar = "INSERT INTO entrevistas_agendadas (curriculo_id, entrevista_id, horario_agendamento) 
                    SELECT c.email, p.id, '$dataHorarioSelecionado' 
                    FROM curriculos c 
                    INNER JOIN entrevistas p ON p.id = '$periodoId'
                    WHERE c.email = '$email'";

    $resultado_agendar = $conexao->query($sql_agendar);

    if ($resultado_agendar) {
        // Agendamento realizado com sucesso, redireciona para a página principal
        header('Location: login.php');

        exit();
    } else {
        // Erro ao agendar a entrevista, exibe mensagem de erro
        $mensagemErro = "Erro ao agendar a entrevista. Tente novamente mais tarde.";
    }
}

mysqli_close($conexao);
?>


