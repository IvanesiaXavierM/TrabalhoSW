<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>adiministração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  
    <title>Painel de Administração</title>
    <link rel="stylesheet" type="text/css" href="../css/adm.css">
</head>
<body>
    <header class="header">
        <span>Bem-vindo, Alejandro</span>
    </header>
    <div class="content">
        <aside class="sidebar">
            <div class="entrevistas">
                <h2>Períodos de Entrevistas</h2>
                <form method="post" action="processar_horarios.php">
                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
                    <br>
                    <label for="inicio">Início:</label>
                    <input type="time" id="inicio" name="inicio[]" required>
                    <br>
                    <label for="fim">Fim:</label>
                    <input type="time" id="fim" name="fim[]" required>
                    <br>
                    <input type="hidden" name="email" value="<?php echo $email_curriculo; ?>">
                    <input class="btn btn-secondary" type="submit" value="Adicionar Período">
                    <br>
                </form>
                <a class="btn btn-primary" href="listar_entrevistas.php" role="button">Entrevistas</a>
            </div>
        </aside>
        <div class="curriculos">
            <h2>Curriculos Cadastrados</h2>
            <?php
                // Conexão com o banco de dados
                include("conexao.php");
                if (mysqli_connect_errno()) {
                    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
                    exit();
                }

                // Consulta para recuperar os currículos do banco de dados
                $consulta = mysqli_query($conexao, "SELECT * FROM curriculos");

                // Loop para exibir cada currículo
                while ($curriculo = mysqli_fetch_assoc($consulta)) {
                    echo "<div class='curriculo'>";
                    
                    echo "<h3>Nome: " . $curriculo['nome'] . "</h3>";
                    echo "<p>Data de Nascimento: " . $curriculo['data_nascimento'] . "</p>";
                    echo "<p>Idade: " . $curriculo['idade'] . "</p>";
                    echo "<p>RG: " . $curriculo['rg'] . "</p>";
                    echo "<p>CPF: " . $curriculo['cpf'] . "</p>";
                    echo "<p>Filiação: " . $curriculo['filiacao'] . "</p>";
                    echo "<p>Telefone de Contato 1: " . $curriculo['telefone1'] . "</p>";
                    echo "<p>Telefone de Contato 2: " . $curriculo['telefone2'] . "</p>";
                    echo "<p>Possui Filhos: " . $curriculo['filhos'] . "</p>";
                    echo "<p>Idade dos Filhos: " . $curriculo['idade_filhos'] . "</p>";
                    echo "<p>Disponibilidade de Horários: " . $curriculo['horario'] . "</p>";
                    echo "<p>Experiência: " . $curriculo['experiencia'] . "</p>";
                    echo "<p>Vaga de Interesse: " . $curriculo['vaga'] . "</p>";

                    // Consulta para recuperar as entrevistas agendadas do currículo
                    $email_curriculo = $curriculo['email'];

                    // Verifica se foi selecionada uma data para listar as entrevistas do dia
                    if (isset($_POST['data'])) {
                        $data_selecionada = $_POST['data'];
                        $entrevistas = mysqli_query($conexao, "SELECT * FROM entrevistas_agendadas WHERE curriculo_id = '$email_curriculo' AND DATE(horario_agendamento) = '$data_selecionada'");
                    } else {
                        $entrevistas = mysqli_query($conexao, "SELECT * FROM entrevistas_agendadas WHERE curriculo_id = '$email_curriculo'");
                    }

                    // Loop para exibir cada entrevista agendada
                    while ($entrevista = mysqli_fetch_assoc($entrevistas)) {
                        echo "<p>Entrevista Agendada: Data - " . $entrevista['horario_agendamento'] . "</p>";
                    }

                    echo "</div>";
                }

                // Fechando a conexão com o banco de dados
                mysqli_close($conexao);
            ?>
        </div>
    </div>
    <footer class="footer">
        <a class="btn btn-success" href="logout.php" role="button">Sair</a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>
