<!DOCTYPE html>
<html>
<head>
    <title>Painel de Administração - Listar Entrevistas do Dia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/adm.css">
</head>
<body>
    <header class="header">
        <span>Bem-vindo, Alejandro</span>
    </header>
    <div class="content">
        
        <div class="curriculos">
            <h2>Entrevistas do Dia</h2>
            <form method="post" action="listar_entrevistas.php">
                <label for="data">Selecione a data:</label>
                <input type="date" id="data" name="data" required>
                <input type="submit" value="Listar Entrevistas">
            </form>
            <?php
                // Verifica se a data foi enviada pelo formulário
                if(isset($_POST['data'])){
                    $data = $_POST['data'];

                    // Conexão com o banco de dados
                    include("conexao.php");
                    if (mysqli_connect_errno()) {
                        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
                        exit();
                    }

                    // Consulta para recuperar as entrevistas agendadas para a data selecionada
                    $consulta = mysqli_query($conexao, "SELECT * FROM entrevistas_agendadas WHERE DATE(horario_agendamento) = '$data'");

                    // Verifica se existem entrevistas agendadas para a data selecionada
                    if(mysqli_num_rows($consulta) > 0){
                        // Loop para exibir cada entrevista
                        while ($entrevista = mysqli_fetch_assoc($consulta)) {
                            echo "<div class='curriculo'>";
                            echo "<h3><a href='detalhes_curriculos.php?curriculo_id=" . $entrevista['curriculo_id'] . "'>Curriculo ID: " . $entrevista['curriculo_id'] . "</a></h3>";
                            echo "<p>Entrevista Agendada: Data - " . date('d/m/Y H:i', strtotime($entrevista['horario_agendamento'])) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Não há entrevistas agendadas para a data selecionada.</p>";
                    }

                    // Fechando a conexão com o banco de dados
                    mysqli_close($conexao);
                }
            ?>
        </div>
    </div>
    <footer class="footer">
    <a class="btn btn-success" href="admin.php" role="button">Voltar</a>

        
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>
</html>
