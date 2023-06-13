<?php

session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Dados do formulário
  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $data_nascimento = $_POST['data-nascimento'];
  $idade = $_POST['idade'];
  $rg = $_POST['rg'];
  $cpf = $_POST['cpf'];
  $filiacao = $_POST['filiacao'];
  $telefone_contato1 = $_POST['telefone-contato1'];
  $telefone_contato2 = $_POST['telefone-contato2'];
  $possui_filhos = $_POST['possui-filhos'];
  $idade_filhos = $_POST['idade-filhos'];
  $disponibilidade_horarios = isset($_POST['disponibilidade-horarios']) ? $_POST['disponibilidade-horarios'] : '';
  $experiencia = $_POST['experiencia'];
  $vaga_interesse = $_POST['vaga-interesse'];
  

  // Verifica se o currículo já está cadastrado com o mesmo e-mail
  $sql_verifica = "SELECT * FROM curriculos WHERE email = '$email'";
  $result_verifica = $conexao->query($sql_verifica);

  if ($result_verifica->num_rows > 0) {
    $_SESSION['email'] = $email;
    echo 'Usuário já existe.';
    header("Location: visualizar_curriculo.php");
  } else {
    // Insere o currículo no banco de dados
    $sql_insert = "INSERT INTO curriculos (email,nome, data_nascimento, idade, rg, cpf, filiacao, telefone1, telefone2, filhos, idade_filhos, horario, experiencia, vaga) VALUES ('$email','$nome', '$data_nascimento', '$idade', '$rg', '$cpf', '$filiacao', '$telefone_contato1', '$telefone_contato2', '$possui_filhos', '$idade_filhos', '$disponibilidade_horarios', '$experiencia', '$vaga_interesse')";

    if ($conexao->query($sql_insert) === TRUE) {
      echo 'Currículo cadastrado com sucesso.';

      // Consulta SQL para obter o currículo cadastrado
      $sql_get_curriculo = "SELECT * FROM curriculos WHERE email = '$email'";
      $result_get_curriculo = $conexao->query($sql_get_curriculo);

      if ($result_get_curriculo->num_rows > 0) {
        $row = $result_get_curriculo->fetch_assoc();
        $curriculo = array(
          'email' => $row['email'],
          'nome' => $row['nome'],
          'data_nascimento' => $row['data_nascimento'],
          'idade' => $row['idade'],
          'rg' => $row['rg'],
          'cpf' => $row['cpf'],
          'filiacao' => $row['filiacao'],
          'telefone1' => $row['telefone1'],
          'telefone2' => $row['telefone2'],
          'filhos' => $row['filhos'],
          'idade_filhos' => $row['idade_filhos'],
          'horario' => $row['horario'],
          'experiencia' => $row['experiencia'],
          'vaga' => $row['vaga']

        );
        $_SESSION['email'] = $email;

        // Redireciona para a página do currículo
        header("Location: visualizar_curriculo.php");
      } else {
        echo 'Nenhum currículo encontrado.';
      }
    } else {
      echo 'Erro ao cadastrar o currículo: ' . $conexao->error;
    }
  }
}

$conexao->close();
?>
