$(function () {
  setTimeout(function () {
    $("body").addClass("loaded");
  }, 500);

  $("#registrar").hide();
  $("#mostrar").click(function () {
    $("#login").hide();
    $("#registrar").show(200);
  });

  $("#formlogin").click(function () {
    $("#registrar").hide();
    $("#login").show(200);
  });
});

/*script vista previa de la imagen */
document.addEventListener("DOMContentLoaded", function () {
  [].forEach.call(document.querySelectorAll(".dropimage"), function (img) {
    img.onchange = function (e) {
      var inputfile = this,
        reader = new FileReader();
      reader.onloadend = function () {
        inputfile.style["background-image"] = "url(" + reader.result + ")";
      };
      reader.readAsDataURL(e.target.files[0]);
    };
  });
});
