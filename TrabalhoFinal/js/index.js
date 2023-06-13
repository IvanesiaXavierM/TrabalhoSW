$(document).ready(function(){
  var form = document.getElementById("login-form");
  var emailInput = document.getElementById("email");
  var senhaInput = document.getElementById("senha");

  form.addEventListener("submit", function() {
      senhaInput.value = "";
      emailInput.value = "";
  });
});

document.addEventListener("DOMContentLoaded", function() {
  var cessoTrigger = document.querySelector(".cesso-trigger");
  var cessoOptions = document.querySelector(".cesso-options");

  cessoTrigger.addEventListener("click", function() {
    cessoOptions.classList.toggle("right"); // Adiciona ou remove a classe "right"
    cessoOptions.style.display = cessoOptions.style.display === "block" ? "none" : "block";
  });

  window.addEventListener("resize", function() {
    if (cessoOptions.style.display === "block") {
      var rect = cessoOptions.getBoundingClientRect();
      if (rect.right > window.innerWidth) {
        cessoOptions.classList.add("right");
      } else {
        cessoOptions.classList.remove("right");
      }
    }
  });
});
