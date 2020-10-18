$(function () {
  alertify.set('notifier','position', 'top-right');

  let file = null;

  function formatBytes(bytes, decimals = 2) {
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return Math.round(bytes / Math.pow(k, i)).toFixed(dm).replace(".", ",") + ' ' + sizes[i];
  }

  let infoImageRemove = e => $("#fileInfo").remove()

  function infoImageAdd(e) {
    if (typeof file == "object") {
      $("#fileInfo").remove();
      $("#logo-company").append(
        `<div id='fileInfo' class='bg-dark-transparent text-white d-flex flex-column justify-content-around align-items-center position-absolute w-100 h-100'>
          <p class='badge badge-success p-2 font-size-1em'>${file.name}</p>
          <p class='badge badge-info p-2 w-50 font-size-1em'>${formatBytes(file.size)}</p>
      </div>`
      );
    }
  }

  function showInfoFile() {
    if (typeof file == "object") {
      $("#previous-img").remove();
      $("#logo-company")
        .hover(infoImageAdd, infoImageRemove)
        .find("#logo").prop("src",URL.createObjectURL(file))
    }
  }

  function requestUpdateImage(url,msg) {
    alertify.dismissAll()
    if($("#inputFile").val().length == 0) return alertify.warning("Nenhum arquivo foi escolhido")
    let data = new FormData($(this)[0]);

    const options = {
      method: 'POST',
      url,
      mycustomtype: "application/json",
      dataType: "json",
      data,
      processData: false,
      contentType: false,
      beforeSend: () => $("#saveImage").prop("disabled", true),
      complete: () => { $("#saveImage").prop("disabled", false); data.delete("image"); },
      success: (res) => {
        if (res.error) return alertify.warning("Tipo de imagem não suportada!")
        if(res.data) $("#thumbnailCompany").prop("src",`${BASE_URL}/${res.data.imagem}`)
        alertify.success(msg);
        infoImageRemove();
        $("#logo-company").off("mouseenter mouseleave")
      },
      error: () => alertify.error("Erro no servidor tente novamente!")
    };

    reqAjax(options);
  }

  $("#logo-company")
    .bind("dragover dragenter", function (evt) { $(this).css("background", "#EFCB47"); return false })
    .bind("dragleave", function (evt) { $(this).css("background", "transparent"); return false; })
    .bind("drop", function (e) { const { files } = e.originalEvent.dataTransfer; $("#inputFile").files = files; $(this).css("background", "green"); return false; })
    .on("click",() => { document.querySelector("#inputFile").click() });

  $("#inputFile").on("change", function (e) {file = this.files[0]; showInfoFile(); });

  $("#formImage").on("submit", function (e) {
    e.preventDefault();
    const { id } = e.originalEvent.submitter
    if(id == "saveImage"){
      requestUpdateImage.call(this,`${BASE_URL}/manager/updateimagecompany`,"Imagem atualizada com sucesso!");
    } else if(id == "removeImage") {
      return false
      requestUpdateImage.call(this,"","Imagem removida")
    }
  })
})