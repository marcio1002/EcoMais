$(function () {
  alertify.set('notifier','position', 'top-right');

  let fileInfo = null;

  let formatBytes = (bytes, decimals = 2) => {
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return Math.round(bytes / Math.pow(k, i)).toFixed(dm).replace(".", ",") + ' ' + sizes[i];
  }

  let infoImage = (e) => {
    $("#fileInfo*").remove();
    if (typeof fileInfo == "object") {

      $("#logo-company").append(
        `<div id='fileInfo' class='bg-dark-transparent text-white d-flex flex-column justify-content-around align-items-center position-absolute w-100 h-100'>
          <p class='badge badge-success p-2 font-size-1em'>${fileInfo.name}</p>
          <p class='badge badge-info p-2 w-50 font-size-1em'>${formatBytes(fileInfo.size)}</p>
      </div>`
      );
    }
  }

  let infoImageRemove = e => $("#fileInfo").remove()

  let startUpload = files => {
    fileInfo = files[0];
    if (typeof files[0] == "object") {
      $("#logo").remove();
      $("#previous-img").remove();
      $("#logo-company p ").remove();
      $("#logo-company").append(`<img style=""  id="previous-img" class="card-img-top img-fluid  border-none" src='${URL.createObjectURL(files[0])}' alt="Uma Imagem de capa do atacado" class="img-thumbnail" style="width: 100%;height: auto;">`)
      $("#logo-company").hover(infoImage, infoImageRemove)
    }
  }

  $("#logo-company")
    .bind("dragover dragenter", function (evt) { $(this).css("background", "#EFCB47"); return false })
    .bind("dragleave", function (evt) { $(this).css("background", "transparent"); return false; })
    .bind("drop", function (e) {
      $(this).css("background", "transparent");
      startUpload(e.originalEvent.dataTransfer.files);
      let inputFile = $("#image");
      inputFile[0].files = e.originalEvent.dataTransfer.files;
      return false;
    })
    .click(evt => $("#image").trigger("click"));

  $("#image").on("change", function (e) { startUpload(this.files); });

  $("#formImage").on("submit", function (e) {
    e.preventDefault();
    let data = new FormData($(this)[0]);

    const option = {
      method: 'POST',
      url: `${BASE_URL}/manager/updateimagecompany`,
      mycustomtype: "application/json",
      dataType: "json",
      data,
      processData: false,
      contentType: false,
      beforeSend: () => $("#saveImage").prop("disabled", true),
      complete: () => { $("#saveImage").prop("disabled", false); data.delete("image"); },
      success: (res) => {
        if (res.error) return alertify.warning("Tipo de imagem não suportada!")
        alertify.success("Imagem atualizada com sucesso! 😋");

      },
      error: () => alertify.error("Erro no servidor tente novamente!")
    };

    reqAjax(option);
  });
})