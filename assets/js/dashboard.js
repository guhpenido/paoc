document.addEventListener("DOMContentLoaded", function (event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);

    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        // show navbar
        nav.classList.toggle("show");
        // change icon
        toggle.classList.toggle("bx-x");
        // add padding to body
        bodypd.classList.toggle("body-pd");
        // add padding to header
        headerpd.classList.toggle("body-pd");
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }
  linkColor.forEach((l) => l.addEventListener("click", colorLink));

  // Your code to run since DOM is loaded and ready
});

var btnVisualizar = document.getElementById("abrirCriarSimulado");

btnVisualizar.addEventListener("click", function () {
  $(".modalCriarSimu").modal("show");
});

function abreOlimpiada(id){
    console.log(id);
  fetch(`buscarOlimpiada.php?idSimulado=${id}`)
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Erro ao buscar simulado");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      document.getElementById("simuTitulo").innerText = data.titulo;
      document.getElementById("simuInicio").innerText = data.inicio;
      document.getElementById("simuTermino").innerText = data.termino;
      document.getElementById("simuCriador").innerText = data.criador;
      document.getElementById("numLt").innerText = data.numLinguagem;
      document.getElementById("numMt").innerText = data.numMatematica;
      document.getElementById("numCn").innerText = data.numCienNatu;
      document.getElementById("numCh").innerText = data.numCienHum;


      let botaoExcluir = document.getElementById("btnExcluir");
      botaoExcluir.addEventListener("click", function () {
        excluirSimulado(id);
      });

      $(".mostraSimu").modal("show");
    })
    .catch((error) => {
      // Trata o erro caso ocorra
      console.error("Erro ao buscar simulado:", error);
    });
}

function excluirSimulado(id) {
    var url = `excluirSimulado.php?idSimulado=${encodeURIComponent(id)}`;
  
    // Enviar a requisição usando fetch (ou $.ajax caso esteja usando jQuery)
    fetch(url)
      .then((response) => {
        console.log(response);
        if (!response.ok) {
          throw new Error("Erro ao excluir simulado");
        }
        return response.text(); // ou response.json() caso o PHP retorne um JSON
      })
      .then((data) => {
        if (data.success) {
          // The team was approved successfully, do something here if needed
          alert("Olimpíada excluida!");
          location.reload();
        } else {
          // There was an error in the approval process, handle the error here
          alert("Olimpíada excluida!");
          location.reload();
        }
      })
      .catch((error) => {
        // Handle any other errors that may occur during the AJAX request
        console.error("Erro na requisição AJAX:", error);
      });
  }
  