<!DOCTYPE html>
<html>
<head>
    <title>Painel de Administração - Detalhes do Currículo</title>
    <link rel="stylesheet" type="text/css" href="../css/detalhes.css">
</head>
<body>
    <header class="header">
        <span>Bem-vindo, Alejandro</span>
    </header>
    <div class="content">
       
        <div class="curriculos">
            <h2>Detalhes do Currículo</h2>
            <?php
                // Verifica se o ID do currículo foi passado pela URL
                if(isset($_GET['curriculo_id'])){
                    $curriculo_id = $_GET['curriculo_id'];

                    // Conexão com o banco de dados
                    include("conexao.php");
                    if (mysqli_connect_errno()) {
                        echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
                        exit();
                    }

                    // Consulta para recuperar as informações do currículo
                    $consulta = mysqli_query($conexao, "SELECT * FROM curriculos WHERE email = '$curriculo_id'");

                    // Verifica se o currículo existe
                    if(mysqli_num_rows($consulta) > 0){
                        $curriculo = mysqli_fetch_assoc($consulta);

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
                        echo "</div>";
                    } else {
                        echo "<p>O currículo não foi encontrado.</p>";
                    }

                    // Fechando a conexão com o banco de dados
                    mysqli_close($conexao);
                } else {
                    echo "<p>Erro: ID do currículo não foi fornecido.</p>";
                }
            ?>
        </div>
    </div>
    <footer class="footer">
        <a href="listar_entrevistas.php" class="btn">Voltar</a>
    </footer>
</body>
</html>
