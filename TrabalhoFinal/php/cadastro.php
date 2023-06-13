<?php
session_start();
include ("conexao.php");
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmacaoSenha = $_POST['confirmacao_senha'];
$perfil = $_POST['perfil'];

// Verifica se a senha e a confirmação da senha são iguais
if ($senha === $confirmacaoSenha) {
    // Senha e confirmação de senha são iguais, pode prosseguir com o cadastro

    // Hash da senha
    $senhaHash = md5($senha);

    // Verifica se o email já está cadastrado no banco de dados
    $sqlVerificaEmail = "SELECT * FROM contas WHERE email = '$email'";
    $resultVerificaEmail = $conexao->query($sqlVerificaEmail);

    if ($resultVerificaEmail->num_rows > 0) {
        echo "O email já está cadastrado. Por favor, use um email diferente.";
        header("Location: ../cadastro_usuario.html");
    } else {
        // Insere os dados no banco de dados
        $sqlInsert = "INSERT INTO contas (nome,email, senha, perfil) VALUES ('$nome','$email', '$senhaHash', '$perfil')";
        if ($conexao->query($sqlInsert) === TRUE) {
            echo "Cadastro realizado com sucesso!";
            // Redireciona para a página desejada
            header("Location: ../login.html");
            exit();
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
    }
} else {
    // Senha e confirmação de senha não são iguais
    echo "A senha e a confirmação da senha não coincidem. Por favor, verifique.";
}

$conexao->close();
?>
