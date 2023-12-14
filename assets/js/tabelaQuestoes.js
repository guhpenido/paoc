var tabela = document.getElementById("tabelaQuestoes");
var linhas = tabela.getElementsByTagName("tr");

for (var i = 0; i < linhas.length; i++) {
  var linha = linhas[i];
  linha.addEventListener("click", function () {
    //Adicionar ao atual
    selLinha(this, false); //Selecione apenas um
    //selLinha(this, true); //Selecione quantos quiser
  });
}

/**
Caso passe true, você pode selecionar multiplas linhas.
Caso passe false, você só pode selecionar uma linha por vez.
**/
function selLinha(linha, multiplos) {
  if (!multiplos) {
    var linhas = linha.parentElement.getElementsByTagName("tr");
    for (var i = 0; i < linhas.length; i++) {
      var linha_ = linhas[i];
      linha_.classList.remove("selecionado");
    }
  }
  linha.classList.toggle("selecionado");
}

/**
Exemplo de como capturar os dados
**/
var btnVisualizar = document.getElementById("visualizarDados");

btnVisualizar.addEventListener("click", function () {
  var selecionados = tabela.getElementsByClassName("selecionado");
  //Verificar se eestá selecionado
  if (selecionados.length < 1) {
    alert("Selecione pelo menos uma linha");
    return false;
  }

  let idQuestao = "";

  for (var i = 0; i < selecionados.length; i++) {
    var selecionado = selecionados[i];
    selecionado = selecionado.getElementsByTagName("td");

    idQuestao = selecionado[0].innerHTML;
  }

  getDataFromServer(idQuestao);
});

function getDataFromServer(idQuestao) {
  console.log(idQuestao);
  fetch(`buscarQuestao.php?idQuestao=${idQuestao}`)
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Erro ao buscar questao");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      document.getElementById("areaComp").innerText = data.area;
      document.getElementById("nivelDif").innerText = data.nivel;
      document.getElementById("tempoS").innerText = data.tempo;
      document.getElementById("criadorQ").innerText = data.autor;
      document.getElementById("showAlt1").innerText = data.alt1;
      document.getElementById("showAlt2").innerText = data.alt2;
      document.getElementById("showAlt3").innerText = data.alt3;
      document.getElementById("showAlt4").innerText = data.alt4;
      document.getElementById("showAltCor").innerText = data.altCorreta;
      document.getElementById("imagemCorpo").src = data.corpo;

      let botaoExcluir = document.getElementById("btnExcluir");
      botaoExcluir.addEventListener("click", function () {
        excluirQuestao(idQuestao);
      });

      $(".tabelaQues").modal("show");
    })
    .catch((error) => {
      // Trata o erro caso ocorra
      console.error("Erro ao buscar qiestao:", error);
    });
}
function excluirQuestao(idQuestao) {
  var url = `excluirQuestao.php?idQuestao=${encodeURIComponent(idQuestao)}`;

  // Enviar a requisição usando fetch (ou $.ajax caso esteja usando jQuery)
  fetch(url)
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Erro ao excluir questao");
      }
      return response.text(); // ou response.json() caso o PHP retorne um JSON
    })
    .then((data) => {
      if (data.success) {
        // The team was approved successfully, do something here if needed
        alert("Questao excluida!");
        location.reload();
      } else {
        // There was an error in the approval process, handle the error here
        alert("Questao excluida!");
        location.reload();
      }
    })
    .catch((error) => {
      // Handle any other errors that may occur during the AJAX request
      console.error("Erro na requisição AJAX:", error);
    });
}
