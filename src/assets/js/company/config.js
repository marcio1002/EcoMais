let isDisabled = true;
$("#edit-info").click(function(){
  $("#passwd").val("");
  $("#confirmPasswd").val("");
  $("#plano > option*").remove();
  $("input").removeClass("formError");

  $("#plano").append(`
    <option value="" selected disabled>Escolha...</option>
    <option value="10">Sacolinha</option>
    <option value="20">Cestinha</option>
    <option value="30">Carrinho</option>
  `);

  (isDisabled) ?  $(".confirmPasswd").show(400) :  $(".confirmPasswd").hide(400);
  let disabled = (isDisabled) ?  false : true;

  isDisabled = !isDisabled

  $("#passwd").prop("disabled",disabled);
  $("#confirmPasswd").prop("disabled",disabled);
  $("#plano").prop("disabled",disabled);
  $("#save-config-company").prop("disabled",disabled);
  $("#btnViewPasswd").prop("disabled",disabled);
});


$("#btnViewPasswd").on("click", function () {
  let icon = $(this).find("#iconPasswd:eq(0)");

  if ($("#passwd:eq(0)").is("[type='password']")) {
      $("#passwd:eq(0)").attr('type', 'text');
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
  } else {
      $("#passwd:eq(0)").attr('type', 'password');
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
  }
});



$("#save-config-company").on("click",function(){
  let data = new Object;
    if($("#passwd").val().length == 0 && $("#plano").val() == null) return alertify.warning("Nenhuma alteração foi realizada!");
    if($("#passwd").val().length ) 
        if($("#passwd").val() != $("#confirmPasswd").val()){
          $("#passwd").addClass("formError");
          $("#confirmPasswd").addClass("formError");
          return alertify.error("As senhas não os coincidem");
        }

        data.id = $("#id_company").val();
        
        if($("#passwd").val().length) data.passwd = $("#passwd").val();
        

       let option = {
          method: 'PUT',
          mycustomtype: "application/json",
          url: `${BASE_URL}/manager/updatecompany`,
          dataType: "json",
          data,
          beforeSend: () => $(this).attr("disabled",true),
          success: (res) => {
            $(this).attr("disabled",false);
            if(!res.error) alertify.success("Seus dados foram atualizados com sucesso");
          },
          error: (er) => {
              $(this).attr("disabled",false);
              alertify.error("Ocorreu um erro no servidor");
          }
      }

      if($("#plano").val() != null)
         alertify.confirm("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!",
        `Antes de qualquer mudança analisamos seus dados, para que você possa mudar seu plano. Se houver alguma conta 
        pedente ou algo que não esteja dentro da nossas diretrizes essa ação não será procedida. 
        <br/> você deseja realmente mudar o plano?`,
         async () =>{movable
            data.typePackage = await $("#passwd").val();
            reqAjax(option);
         },
          () => {}
        ).set({
          'labels': {ok: "Sim", cancel: "Não"},
          'closable': false
        });
      
    if(data.passwd) reqAjax(option);
});