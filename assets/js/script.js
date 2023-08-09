var caixinhas = document.querySelectorAll(".caixinhas");

// Adiciona um ouvinte de evento a cada elemento
caixinhas.forEach(function (caixinha) {
  caixinha.addEventListener("click", function () {
    // Redireciona para a página desejada
    window.location.href = "./pages/sobre.html";
  });
});
