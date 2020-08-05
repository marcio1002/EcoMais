$(function(){
  let isDisabled = true;
var typePackage = $("#typePackage").val();
$("#edit-info").click(function(){
  let value = $("#typePackage").val();
  $("#passwd").val("");
  $("#confirmPasswd").val("");
  $("#typePackage > option*").remove();
  $("input").removeClass("formError");
  $("#typePackage").append(`
      <option value="10">Sacolinha</option>
      <option value="20">Cestinha</option>
      <option value="30">Carrinho</option>
  `).val(value);


  (isDisabled) ?  $(".confirmPasswd").show(400) :  $(".confirmPasswd").hide(400);
  let disabled = (isDisabled) ?  false : true;

  isDisabled = !isDisabled

  $("#passwd").prop("disabled",disabled);
  $("#confirmPasswd").prop("disabled",disabled);
  $("#typePackage").prop("disabled",disabled);
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
    if($("#passwd").val().length == 0 && $("#typePackage").val() == typePackage) return alertify.warning("Nenhuma alteração foi realizada!");
    if($("#passwd").val().length ) 
        if($("#passwd").val() != $("#confirmPasswd").val()){
          $("#passwd").addClass("formError");
          $("#confirmPasswd").addClass("formError");
          return alertify.error("As senhas não os coincidem");
        }

        data.id = $("#id_company").val();
        
        if($("#passwd").val().length) data.passwd = $("#passwd").val();
        if($("#typePackage").val().length) data.typePackage = $("#typePackage").val();

       let option = {
          method: 'PUT',
          mycustomtype: "application/json",
          url: `${BASE_URL}/manager/updateinfocompany`,
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

      if($("#typePackage").val() != typePackage)
         alertify.confirm("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!",
        `Antes de qualquer mudança analisamos seus dados, para que você possa mudar seu plano. Se houver alguma conta 
        pedente ou algo que não esteja dentro da nossas diretrizes essa ação não será procedida. 
        <br/> você deseja realmente mudar o plano?`,
        () =>{
            reqAjax(option);
         },
          () => {}
        ).set({
          'labels': {ok: "Sim", cancel: "Não"},
          'closable': false
        });
      
    if(data.passwd && data.typePackage == typePackage) reqAjax(option);
});
})