<?php
session_start();
include("conexao.php");
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

  // Consulta SQL para obter o currículo cadastrado
  $sql_get_curriculo = "SELECT * FROM curriculos WHERE email = '$email'";
  $result_get_curriculo = $conexao->query($sql_get_curriculo);
  $sql_entrevista = "SELECT * FROM entrevistas_agendadas WHERE curriculo_id = (SELECT email FROM curriculos WHERE email = '$email')";
$result_entrevista = $conexao->query($sql_entrevista);


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
    

    // Exibe o currículo
    echo '<html>
    <head>
    <link rel="stylesheet" type="text/css" href="../css/visualizar.css">

        <title>Seu Currículo</title>
        
    </head>
    <body>
        <div class="container">
            <h1>Seu Currículo</h1>
            <p><strong>Nome:</strong> ' . $curriculo['nome'] . '</p>
            <p><strong>Email:</strong> ' . $curriculo['email'] . '</p>
            <p><strong>data de nascimento:</strong> ' . $curriculo['data_nascimento'] . '</p>
            <p><strong>idade:</strong> ' . $curriculo['idade'] . '</p>
            <p><strong>rg:</strong> ' . $curriculo['rg'] . '</p>
            <p><strong>cpf:</strong> ' . $curriculo['cpf'] . '</p>
            <p><strong>filiacao:</strong> ' . $curriculo['filiacao'] . '</p>
            <p><strong>telefone1:</strong> ' . $curriculo['telefone1'] . '</p>
            <p><strong>telefone2:</strong> ' . $curriculo['telefone2'] . '</p>
            <p><strong>filhos:</strong> ' . $curriculo['filhos'] . '</p>
            <p><strong>idade dos filhos:</strong> ' . $curriculo['idade_filhos'] . '</p>
            <p><strong>horario:</strong> ' . $curriculo['horario'] . '</p>
            <p><strong>experiencia:</strong> ' . $curriculo['experiencia'] . '</p>
            <p><strong>vaga de interesse:</strong> ' . $curriculo['vaga'] . '</p>
           
          
         

            <form method="post" action="atualizar_curriculo.php">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="' . $curriculo['nome'] . '" required>
               
                <label for="idade">Idade:</label>
                <input type="text" id="idade" name="idade" value="' . $curriculo['idade'] . '" required>
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" value="' . $curriculo['rg'] . '" required>

                <label for="filiacao">Filiação:</label>
                <textarea id="filiacao" name="filiacao" required>' . $curriculo['filiacao'] . '</textarea>

                <label for="telefone-contato1">Telefone de Contato 1:</label>
                <textarea id="telefone-contato1" name="telefone-contato1" required>' . $curriculo['telefone1'] . '</textarea>

                <label for="telefone-contato2">Telefone de Contato 2:</label>
                <textarea id="telefone-contato2" name="telefone-contato2" required>' . $curriculo['telefone2'] . '</textarea>

                <label for="experiencia">Experiência Profissional:</label>
                <textarea id="experiencia" name="experiencia" required>' . $curriculo['experiencia'] . '</textarea>

                <label for="vaga-interesse">Vaga de Interesse:</label>
                <input type="text" id="vaga-interesse" name="vaga-interesse" value="' . $curriculo['vaga'] . '" required>


        
                <input type="submit" value="Atualizar Currículo">
            </form>
            <form method="post" action="sair.php" class="logout-button">
                <input type="submit" value="Sair">
            </form>
        </div>
    </body>
    </html>';
  } else {
    echo 'Nenhum currículo encontrado.';
  }
}

$conexao->close();
?>
