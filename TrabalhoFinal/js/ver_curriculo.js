window.addEventListener('DOMContentLoaded', function() {
  var tableBody = document.querySelector('#curriculos-table tbody');

  // Função para carregar os currículos na tabela
  function carregarCurriculos() {
    // Faz uma requisição AJAX para obter os dados dos currículos
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/obter_curriculos.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);

        // Limpa o conteúdo da tabela antes de preenchê-la novamente
        tableBody.innerHTML = '';

        if (response.length > 0) {
          // Loop através dos currículos e adiciona as linhas na tabela
          response.forEach(function(curriculo) {
            var row = document.createElement('tr');
            var nomeCell = document.createElement('td');
            var emailCell = document.createElement('td');
            var acaoCell = document.createElement('td');
            var visualizarLink = document.createElement('a');
            visualizarLink.href = 'visualizar_curriculo.php?id=' + curriculo.id;
            visualizarLink.textContent = 'Visualizar';

            nomeCell.textContent = curriculo.nome;
            emailCell.textContent = curriculo.email;
            acaoCell.appendChild(visualizarLink);

            row.appendChild(nomeCell);
            row.appendChild(emailCell);
            row.appendChild(acaoCell);

            tableBody.appendChild(row);
          });
        } else {
          var emptyRow = document.createElement('tr');
          var emptyCell = document.createElement('td');
          emptyCell.setAttribute('colspan', 3);
          emptyCell.textContent = 'Nenhum currículo encontrado.';

          emptyRow.appendChild(emptyCell);
          tableBody.appendChild(emptyRow);
        }
      } else {
        console.error('Erro ao carregar os currículos.');
      }
    };
    xhr.send();
  }

  // Chama a função para carregar os currículos quando a página carregar
  carregarCurriculos();
});
