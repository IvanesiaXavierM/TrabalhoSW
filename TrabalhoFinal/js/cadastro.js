window.addEventListener("DOMContentLoaded", function() {
    var senhaInput = document.getElementById("senha");
    var confirmacaoSenhaInput = document.getElementById("confirmacao_senha");
    var senhaError = document.getElementById("senha_error");
  
    confirmacaoSenhaInput.addEventListener("input", function() {
      if (senhaInput.value !== confirmacaoSenhaInput.value) {
        senhaError.textContent = "A senha e a confirmacao da senha nao coincidem. Por favor, verifique.";
      } else {
        senhaError.textContent = "";
      }
    });
  });
$(document).ready(function(){
    var form = document.getElementById("cadastroForm");
    var nomeInput = document.getElementById("nome");
    var emailInput = document.getElementById("email");
  
    form.addEventListener("submit", function() {
        nomeInput.value = "";
        emailInput.value = "";
    });
});
  

  