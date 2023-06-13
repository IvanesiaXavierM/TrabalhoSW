<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

  // Atualiza os dados do currículo no banco de dados
  $sql_update = "UPDATE curriculos SET nome = '$nome', idade = '$idade', rg = '$rg',  filiacao = '$filiacao', telefone1 = '$telefone_contato1', telefone2 = '$telefone_contato2',horario = '$disponibilidade_horarios', experiencia = '$experiencia', vaga = '$vaga_interesse' WHERE email = '$email'";
  if ($conexao->query($sql_update) === TRUE) {
    echo '<script>window.location.href = "visualizar_curriculo.php";</script>';
    exit; // Encerra o script após o redirecionamento
  } else {
    echo 'Erro ao atualizar os dados do currículo: ' . $conexao->error;
  }
}

$conexao->close();
?>
