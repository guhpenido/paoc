var btnVisualizarE = document.getElementById("comuEquipe");

btnVisualizarE.addEventListener("click", function () {
  $(".modalEquipe").modal("show");
});
var btnVisualizarD = document.getElementById("comuIndividual");

btnVisualizarD.addEventListener("click", function () {
  $(".modalIndividual").modal("show");
});
var btnVisualizarC = document.getElementById("comuGeral");

btnVisualizarC.addEventListener("click", function () {
  $(".modalGeral").modal("show");
});


var quill1 = new Quill("#editor-container-equipe", {
  theme: "snow",
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, false] }],
      ["bold", "italic", "underline"],
      [{ list: "ordered" }, { list: "bullet" }],
      ["link"],
      ["clean"],
    ],
  },
});
var quill2 = new Quill("#editor-container-individual", {
    theme: "snow",
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, 4, false] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["link"],
        ["clean"],
      ],
    },
  });
  var quill3 = new Quill("#editor-container-geral", {
    theme: "snow",
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, 4, false] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["link"],
        ["clean"],
      ],
    },
  });
var hiddenEditor1 = document.getElementById("hidden-editor1");
var hiddenEditor2 = document.getElementById("hidden-editor2");
var hiddenEditor3 = document.getElementById("hidden-editor3");
quill1.on("text-change", function () {
  hiddenEditor1.value = quill1.root.innerHTML;
});

quill2.on("text-change", function () {
    hiddenEditor2.value = quill2.root.innerHTML;
  });

  quill3.on("text-change", function () {
    hiddenEditor3.value = quill3.root.innerHTML;
  });
