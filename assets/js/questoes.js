var btnVisualizar = document.getElementById("abreModal");

btnVisualizar.addEventListener("click", function () {
  $(".bd-example-modal-lg").modal("show");
});

var quill = new Quill("#editor-container", {
  theme: "snow",
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, false] }],
      ["bold", "italic", "underline"],
      [{ list: "ordered" }, { list: "bullet" }],
      ["link", "image"],
      ["clean"],
    ],
  },
});

var hiddenEditor = document.getElementById("hidden-editor");

quill.on("text-change", function () {
  hiddenEditor.value = quill.root.innerHTML;
});

/*var imageInput = document.getElementById("image-input");

imageInput.addEventListener("change", function (e) {
  var file = e.target.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var range = quill.getSelection();
      quill.insertEmbed(range.index, "image", e.target.result);
    };
    reader.readAsDataURL(file);
  }
});*/
