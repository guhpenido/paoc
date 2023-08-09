var tabela = document.getElementById("tabelaEquipes");
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

  let nomeEquipe = "";
  let cursoEquipe = "";
  for (var i = 0; i < selecionados.length; i++) {
    var selecionado = selecionados[i];
    selecionado = selecionado.getElementsByTagName("td");

    nomeEquipe = selecionado[1].innerHTML;
    cursoEquipe = selecionado[2].innerHTML;
  }

  getDataFromServer(nomeEquipe, cursoEquipe);
});

function getDataFromServer(nomeEquipe, cursoEquipe) {
  console.log(nomeEquipe, cursoEquipe);
  fetch(`buscarEquipe.php?nomeEquipe=${nomeEquipe}&cursoEquipe=${cursoEquipe}`)
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Erro ao buscar equipe");
      }
      return response.json();
    })
    .then((data) => {
      document.getElementById("nomeEq").innerText = data.nome;
      document.getElementById("cursoEq").innerText = data.curso;
      document.getElementById("nmRespEq").innerText = data.nome_responsavel;
      document.getElementById("emRespEq").innerText = data.email_responsavel;
      document.getElementById("nmCapEq").innerText = data.nome_capitao;
      document.getElementById("emCapEq").innerText = data.email_capitao;
      document.getElementById("matCapEq").innerText = data.matricula_capitao;
      document.getElementById("nomeInt1").innerText = data.nome_int1;
      document.getElementById("emailInt1").innerText = data.email_int1;
      document.getElementById("matInt1").innerText = data.matricula_int1;
      document.getElementById("nomeInt2").innerText = data.nome_int2;
      document.getElementById("emailInt2").innerText = data.email_int2;
      document.getElementById("matInt2").innerText = data.matricula_int2;
      document.getElementById("nomeInt3").innerText = data.nome_int3;
      document.getElementById("emailInt3").innerText = data.email_int3;
      document.getElementById("matInt3").innerText = data.matricula_int3;
      document.getElementById("nomeInt4").innerText = data.nome_int4;
      document.getElementById("emailInt4").innerText = data.email_int4;
      document.getElementById("matInt4").innerText = data.matricula_int4;
      document.getElementById("nomeInt5").innerText = data.nome_int5;
      document.getElementById("emailInt5").innerText = data.email_int5;
      document.getElementById("matInt5").innerText = data.matricula_int5;
      document.getElementById("situacaoEq").innerText = data.status;

      let botaoAprovar = document.getElementById("btnAprovar");
      if (data.status == "Pendente") {
        botaoAprovar.innerHTML = "Aprovar!";
        botaoAprovar.disabled = false;
        botaoAprovar.style.cursor = "pointer";
        botaoAprovar.addEventListener("click", function() {
          aprovarEquipe(nomeEquipe, cursoEquipe);
        });
      } else {
        botaoAprovar.innerHTML = "Já aprovada!";
        botaoAprovar.disabled = true;
        botaoAprovar.style.cursor = "not-allowed";
      }
      $(".bd-example-modal-lg").modal("show");
    })
    .catch((error) => {
      // Trata o erro caso ocorra
      console.error("Erro ao buscar equipe:", error);
    });
}
function aprovarEquipe(nomeEquipe, cursoEquipe) {
  var url = `aprovaEquipe.php?nomeEquipe=${encodeURIComponent(
    nomeEquipe
  )}&cursoEquipe=${encodeURIComponent(cursoEquipe)}`;

  // Enviar a requisição usando fetch (ou $.ajax caso esteja usando jQuery)
  fetch(url)
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error("Erro ao aprovar equipe");
      }
      return response.text(); // ou response.json() caso o PHP retorne um JSON
    })
    .then(data => {
      if (data.success) {
        // The team was approved successfully, do something here if needed
        alert("Equipe aprovada!");
        location.reload();
      } else {
        // There was an error in the approval process, handle the error here
        alert("Equipe aprovada!");
        location.reload();
      }
    })
    .catch(error => {
      // Handle any other errors that may occur during the AJAX request
      console.error('Erro na requisição AJAX:', error);
    });
}
