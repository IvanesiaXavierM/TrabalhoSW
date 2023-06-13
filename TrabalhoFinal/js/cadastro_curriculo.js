$(document).ready(function(){
  mostrarCampoIdade();
});

function mostrarCampoIdade() {
  var select = document.getElementById("possui-filhos");
  var campoIdade = document.getElementById("campo-idade");

  if (select.value === "Sim") {
    campoIdade.style.display = "block";
  } else {
    campoIdade.style.display = "none";
  }
  
}

document.addEventListener('DOMContentLoaded', function() {
  var possuiFilhos = document.getElementById('possui-filhos');
  var campoIdadeFilhos = document.getElementById('campo-idade');
  var form = document.getElementById('curriculo-form');
  var btnSalvar = document.querySelector('button[type="submit"]');
  
 
  if (form && btnSalvar) {
    form.addEventListener('submit', function(event) {
      var inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
      var preencheuCampos = true;
      
      inputs.forEach(function(input) {
        if (!input.value) {
          preencheuCampos = false;
        }
      });
      
      if (!preencheuCampos) {
        event.preventDefault();
        alert('Por favor, preencha todos os campos obrigatórios.');
      }
    });
  }
});

