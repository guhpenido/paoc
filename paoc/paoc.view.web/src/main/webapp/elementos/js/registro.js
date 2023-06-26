document.addEventListener("DOMContentLoaded", function () {
    initApp();
});

function validateForm() {
    var forms = document.getElementsByClassName("needs-validation");
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.classList.add("was-validated");
    });

    var nomeEquipe = document.querySelector("#nome_equipe");
    var curso = document.querySelector("select[name=curso]");
    var nomeResponsavel = document.querySelector("#nome_responsavel");
    var emailResponsavel = document.querySelector("#email_responsavel");
    var nomeCapitao = document.querySelector("#nome_capitao");
    var emailCapitao = document.querySelector("#email_capitao");
    var matriculaCapitao = document.querySelector("#matricula_capitao");

    var nomeIntegrante1 = document.querySelector("#nome_integrante1");
    var matriculaIntegrante1 = document.querySelector("#matricula_integrante1");
    var emailIntegrante1 = document.querySelector("#email_integrante1");

    var nomeIntegrante2 = document.querySelector("#nome_integrante2");
    var matriculaIntegrante2 = document.querySelector("#matricula_integrante2");
    var emailIntegrante2 = document.querySelector("#email_integrante2");

    var nomeIntegrante3 = document.querySelector("#nome_integrante3");
    var matriculaIntegrante3 = document.querySelector("#matricula_integrante3");
    var emailIntegrante3 = document.querySelector("#email_integrante3");

    var nomeIntegrante4 = document.querySelector("#nome_integrante4");
    var matriculaIntegrante4 = document.querySelector("#matricula_integrante4");
    var emailIntegrante4 = document.querySelector("#email_integrante4");

    var nomeIntegrante5 = document.querySelector("#nome_integrante5");
    var matriculaIntegrante5 = document.querySelector("#matricula_integrante5");
    var emailIntegrante5 = document.querySelector("#email_integrante5");

    var checkbox = document.querySelector("input[name=checkbox]");

    if (nomeEquipe.checkValidity() && curso.checkValidity() && nomeResponsavel.checkValidity() &&
            emailResponsavel.checkValidity() && nomeCapitao.checkValidity() && emailCapitao.checkValidity() &&
            matriculaCapitao.checkValidity() && nomeIntegrante1.checkValidity() && matriculaIntegrante1.checkValidity() &&
            emailIntegrante1.checkValidity() && nomeIntegrante2.checkValidity() && matriculaIntegrante2.checkValidity() &&
            emailIntegrante2.checkValidity() && nomeIntegrante3.checkValidity() && matriculaIntegrante3.checkValidity() &&
            emailIntegrante3.checkValidity() && nomeIntegrante4.checkValidity() && matriculaIntegrante4.checkValidity() &&
            emailIntegrante4.checkValidity() && nomeIntegrante5.checkValidity() && matriculaIntegrante5.checkValidity() &&
            emailIntegrante5.checkValidity() && checkbox.checked) {
        if (
                !checkDuplicates([
                    matriculaCapitao.value,
                    matriculaIntegrante1.value,
                    matriculaIntegrante2.value,
                    matriculaIntegrante3.value,
                    matriculaIntegrante4.value,
                    matriculaIntegrante5.value
                ])
                ) {
            alert("As matrículas dos integrantes devem ser diferentes.");
        } else if (
                !checkDuplicates([
                    emailCapitao.value,
                    emailIntegrante1.value,
                    emailIntegrante2.value,
                    emailIntegrante3.value,
                    emailIntegrante4.value,
                    emailIntegrante5.value
                ])

                ) {
            alert("Os emails dos integrantes devem ser diferentes.");
        } else {
            alert("Todos os campos foram preenchidos corretamente!");
            let enviar = document.querySelector("#enviar");
            enviar.style.display = "block";
        }
    }
}

function checkDuplicates(arr) {
    var uniqueValues = new Set(arr);
    return uniqueValues.size === arr.length;
}

function initApp() {
    document.querySelector("#botao").addEventListener("click", validateForm, false);
}