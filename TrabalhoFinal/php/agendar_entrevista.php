
<!DOCTYPE html>
<html>
<head>
    <title>Agendar Entrevista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Agendar Entrevista</h2>

        <?php
        session_start();

        include("conexao.php");

        if (!isset($_SESSION['email'])) {
            header('Location: login.php');
            exit();
        }

        $email = $_SESSION['email'];

        // Verificar se o usuário já possui uma entrevista agendada
        $sql_verificar_agendamento = "SELECT * FROM entrevistas_agendadas WHERE curriculo_id = '$email'";
        $result_verificar_agendamento = $conexao->query($sql_verificar_agendamento);

        if ($result_verificar_agendamento->num_rows > 0) {
            // O usuário já possui um agendamento, exibir mensagem
            echo "<p>Você já possui uma entrevista agendada.</p>";
        } else {
            // Restante do código para agendar a entrevista...

            if (isset($_POST['horario'])) {
                $horarioSelecionado = $_POST['horario'];

                // Extrai o período e a hora selecionados
                $horarioSelecionado = explode("-", $horarioSelecionado);
                $periodo_id = $horarioSelecionado[0];
                $horaSelecionada = $horarioSelecionado[1];

                // Obtém a data do período selecionado e o ID da entrevista
                $sql_periodo = "SELECT id, periodo_inicio FROM entrevistas WHERE id = '$periodo_id'";
                $result_periodo = $conexao->query($sql_periodo);

                if ($result_periodo->num_rows > 0) {
                    $periodo = $result_periodo->fetch_assoc();
                    $entrevista_id = $periodo['id'];
                    $dataSelecionada = date('Y-m-d', strtotime($periodo['periodo_inicio']));

                    // Cria a data e hora completas para salvar no banco de dados
                    $dataHoraCompleta = $dataSelecionada . ' ' . $horaSelecionada;

                    // Salva a entrevista no banco de dados
                    $sql_salvar_entrevista = "INSERT INTO entrevistas_agendadas (curriculo_id, entrevista_id, horario_agendamento) VALUES ('$email', '$entrevista_id', '$dataHoraCompleta')";
                    $conexao->query($sql_salvar_entrevista);

                    // Redireciona para a página correta após o agendamento da entrevista
                    
                    header("Location: visualizar_curriculo.php");
                    exit();
                }
            }

            // Restante do código para exibir os períodos disponíveis e tratar outros casos

            ?>

            <!-- Exibir os períodos disponíveis -->
            <form method="post" action="">
                <div class="mb-3">
                    <label for="horario" class="form-label">Selecione um horário de entrevista disponível:</label>
                    <select name="horario" class="form-select">
                        <?php
                        // Obtém os períodos de entrevista disponíveis
                        $sql_periodos = "SELECT * FROM entrevistas WHERE periodo_inicio >= NOW() AND disponivel = 1 ORDER BY periodo_inicio";
                        $result_periodos = $conexao->query($sql_periodos);

                        if ($result_periodos->num_rows > 0) {
                            while ($periodo = $result_periodos->fetch_assoc()) {
                                $horario_inicio = date('d/m/Y H:i', strtotime($periodo['periodo_inicio']));
                                $horario_fim = date('H:i', strtotime($periodo['periodo_fim']));
                                $periodo_id = $periodo['id'];

                                // Gera uma lista de horários dentro do período disponível
                                $horarioAtual = strtotime($periodo['periodo_inicio']);
                                $horarioFim = strtotime($periodo['periodo_fim']);
                                while ($horarioAtual <= $horarioFim) {
                                    $horarioOpcao = date('H:i', $horarioAtual);
                                    echo "<option value='{$periodo_id}-{$horarioOpcao}'>$horario_inicio - $horarioOpcao</option>";
                                    $horarioAtual = strtotime('+30 minutes', $horarioAtual);
                                }
                            }
                        } else {
                            echo "<option value=''>Nenhum horário disponível</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agendar</button>
            </form>

        <?php
        }

        mysqli_close($conexao);
        ?>

<a href="#" onclick="document.getElementById('retornoForm').submit();" class="btn btn-secondary mt-3">Retornar</a>
<form id="retornoForm" action="login.php" method="post" style="display: none;">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="senha" value="<?php echo $senha; ?>">
    <input type="hidden" name="perfil" value="<?php echo $perfil; ?>">
</form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>
