<?php
// Aqui você deve adicionar as configurações do seu banco de dados
include ("conexao.php");



// Consulta para obter os currículos
$sql = 'SELECT * FROM curriculo';
$result = $conexao->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
  $curriculos = array();

  // Loop através dos resultados e armazena os currículos em um array
  while ($row = $result->fetch_assoc()) {
    $curriculo = array(
      'id' => $row['id'],
      'nome' => $row['nome'],
      'email' => $row['email']
    );
    array_push($curriculos, $curriculo);
  }

  // Retorna o array de currículos como JSON
  header('Content-Type: application/json');
  echo json_encode($curriculos);
} else {
  echo 'Nenhum currículo encontrado.';
}
$conexao->close();
?>
