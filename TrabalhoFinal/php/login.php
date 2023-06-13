
<?php
session_start();

include ("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];
$perfil = $_POST['perfil'];

// Aplica o hash MD5 na senha fornecida pelo usuário
$senhaHash = md5($senha);
$_SESSION['email'] = $email;


$sql = "SELECT * FROM contas WHERE email = '$email'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $senhaArmazenada = $row['senha'];
    $perfilArmazenado = $row['perfil'];

    // Verifica se a senha fornecida corresponde à senha armazenada e se o perfil é válido
    if ($senhaHash === $senhaArmazenada && $perfil === $perfilArmazenado) {
        // Login bem-sucedido

        // Redireciona para a página correta após o login bem-sucedido
        if ($perfil === 'usuario') {
            // Verifica se o currículo já está cadastrado para exibi-lo
            $sql_curriculo = "SELECT * FROM curriculos WHERE email = '$email'";
            $result_curriculo = $conexao->query($sql_curriculo);

            if ($result_curriculo->num_rows > 0) {
                // Currículo encontrado, exiba-o
                $curriculo = $result_curriculo->fetch_assoc();
                $_SESSION['email'] = $email;
                ?>

                <html>
                <head>
                <link rel="stylesheet" type="text/css" href="../css/loginus.css">
                    <title>Seu Currículo</title>
                    
                </head>
                <body>
                <div class="container">
                    <h1>Seu Currículo</h1>
                    <p><strong>Nome:</strong> <?php echo $curriculo['nome']; ?></p>
                    <p><strong>Email:</strong> <?php echo $curriculo['email']; ?></p>
                    <p><strong>Data de Nascimento:</strong> <?php echo $curriculo['data_nascimento']; ?></p>
                    <p><strong>Idade:</strong> <?php echo $curriculo['idade']; ?></p>
                    <p><strong>RG:</strong> <?php echo $curriculo['rg']; ?></p>
                    <p><strong>CPF:</strong> <?php echo $curriculo['cpf']; ?></p>
                    <p><strong>Filiação:</strong> <?php echo $curriculo['filiacao']; ?></p>
                    <p><strong>Telefone 1:</strong> <?php echo $curriculo['telefone1']; ?></p>
                    <p><strong>Telefone 2:</strong> <?php echo $curriculo['telefone2']; ?></p>
                    <p><strong>Filhos:</strong> <?php echo $curriculo['filhos']; ?></p>
                    <p><strong>Idade dos Filhos:</strong> <?php echo $curriculo['idade_filhos']; ?></p>
                    <p><strong>Horário:</strong> <?php echo $curriculo['horario']; ?></p>
                    <p><strong>Experiência:</strong> <?php echo $curriculo['experiencia']; ?></p>
                    <p><strong>Vaga de Interesse:</strong> <?php echo $curriculo['vaga']; ?></p>
                    <form method="post" action="visualizar_curriculo.php">
                    <input type="submit" value="Atualizar Currículo">
                    </form>
                    <form method="post" action="agendar_entrevista.php">
                        <input type="hidden" name="curriculo_id" value="<?php echo $curriculo['email']; ?>">
                        <input type="submit" value="Agendar Entrevista">
                    </form>
                </div>
                </body>
                </html>

                <?php
            } else {
                // Currículo não encontrado, redirecione para a página de cadastro de currículo
                header('Location: ../curriculo.html');
                exit();
            }
        } elseif ($perfil === 'admin') {
            header('Location: admin.php');
            exit();
        }
    } else {
        // Credenciais inválidas
        header("Location: ../login.html?mensagem=Credenciais inválidas!");
    }
} else {
    // Credenciais inválidas
    header("Location: ../index.html?mensagem=Credenciais inválidas!");
}

mysqli_close($conexao);
?>
