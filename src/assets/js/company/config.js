$(function () {
  alertify.set('notifier','position', 'top-right')

  let isDisabled = true
  var typePackage = $("#typePackage").val()
  let dataPackage


  function updateConfiguration(isModified) {
    let data = new Object

    if(!isModified) return alertify.warning("Nenhuma alteração foi realizada!")

    if ($("#passwd").val().length)
      if ($("#passwd").val() != $("#confirmPasswd").val()) {
        $("#passwd").addClass("formError")
        $("#confirmPasswd").addClass("formError")
        return alertify.error("As senhas não coincidem!")
      }


    data.id = $("#id_company").val()
    if ($("#passwd").val().length) data.passwd = $("#passwd").val()
    if($("#email").val().length) data.email = $("#email").val()
    if($("#contact").val().length) data.contact = $("#contact").val()

    let options = {
      method: 'PUT',
      mycustomtype: "application/json",
      url: `${BASE_URL}/manager/updateinfocompany`,
      dataType: "json",
      data,
      beforeSend: () => $(this).attr("disabled", true),
      complete: () => $(this).attr("disabled", false),
      success: res => (!res.error) ? alertify.success("Seus dados foram atualizados com sucesso!") : alertify.warning("Não foi possível atualizar os dados!"),
      error: er =>  alertify.error("Ocorreu um erro no servidor")
    }

    if ($("#typePackage").val() != dataPackage) 
      alertify.confirm("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!",
        `Antes de qualquer mudança analisamos seus dados, para que você possa mudar seu plano. Se houver alguma conta 
        pedente ou algo que não esteja dentro da nossas diretrizes essa ação não será procedida. 
        <br/> você deseja realmente mudar o plano?`,
        () => { 
          data.typePackage = $("#typePackage").val() 
          if(isModified)  reqAjax(options)
        },
        () => {
          if(isModified) reqAjax(options)
        }
      ).set({
        'labels': { ok: "Sim", cancel: "Não" },
        'closable': false
      })

  }

  $("#content:input:not(#edit-info,#delete-company)").prop("disabled", true)

  $("#edit-info").click(function () {
    $("#passwd").val("")
    $("#confirmPasswd").val("")
    $("#typePackage > option*").remove()
    $("input").removeClass("formError")
    $("#typePackage").append(`
      <option value="10">Sacolinha</option>
      <option value="20">Cestinha</option>
      <option value="30">⭐Carrinho</option>
    `).val(typePackage);


    (isDisabled) ? $(".confirmPasswd").show(400) : $(".confirmPasswd").hide(400)
    let disabled = (isDisabled) ? false : true

    isDisabled = !isDisabled

    $("#passwd").prop("disabled", disabled).removeClass("bg-blue-night").addClass("bg-blue-dark-1")
    $("#confirmPasswd").prop("disabled", disabled).removeClass("bg-blue-night").addClass("bg-blue-dark-1")
    $("#typePackage").prop("disabled", disabled).removeClass("bg-blue-night").addClass("bg-blue-dark-1")
    $("#email").prop("disabled",disabled).removeClass("bg-blue-night").addClass("bg-blue-dark-1")
    $("#contact").prop("disabled",disabled).removeClass("bg-blue-night").addClass("bg-blue-dark-1")
    $("#save-config-company").prop("disabled", disabled)
    $("#btnViewPasswd").prop("disabled", disabled)
  });

  $("#btnViewPasswd").on("click",() => viewPasswd("#passwd"));

  $("#save-config-company").on("click", async function () {
    alertify.dismissAll()
    $(":input").removeClass("formError")

    let options = {
      method: "POST",
      url: `${BASE_URL}/manager/findcompany`,
      data: {id: $("#id_company").val()},
      dataType: "json",
      success: res => {
        if(!res.data)  return
          let isModified = false 
          dataPackage = res.data["pacote"]
            
          if($("#email").val().length){
            if(res.data["email"] != $("#email").val()) isModified = true
          }
            
          if($("#contact").val().length) {
            if(res.data["contato"] != $("#contact").val()) isModified = true
          }

          if (res.data["pacote"] != $("#typePackage").val()) isModified = true

          updateConfiguration(isModified)
      },
      error: err =>  alertify.error("Ocorreu um erro no servidor")
    }

    reqAjax(options)

  })
})