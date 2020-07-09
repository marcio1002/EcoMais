let loadSpinner = `<span class="spinner-border spinner-border-sm align-vertical text-warning" role="status" aria-hidden="true"></span>`;



// <--- functions users --->

function load(l = false, elem) {
   if(l) {
      let value =  $(elem).text();
      $(elem).html(`${loadSpinner} ${value}`);
   } else {
      $(elem).find(".spinner-border").remove();
   }
}

//pula para o próximo elemento que tem a classe .nextItem
$(".nextItem").keypress(function (e) {
   var tecla = e.keyCode ? e.keyCode : e.which;
   if (tecla == 13) {
      e.preventDefault();

      var indexof = $(".nextItem").index(this) + 1;

      if (indexof < $(".nextItem:not(input[readonly])").length) {

         $(`.nextItem:eq(${indexof})`).focus();
      }
      else {
         return null
      }
   }
});

$("#searchCep").on("click", async function () {
   try {
       alertify.set('notifier','position', 'top-right');
       const res = await searchCep($("#inputCep").val())
       if (res !== null) {
           $("#uf").val(res.uf);
           $("#inputAddres").val(`${res.bairro}, ${res.logradouro}`);
           $("#locality").val(res.localidade);
       } else {
          return alertify.error("Não foi possível buscar o cep informado!")
       }
   } catch (e) {
      return alertify.error('Cep inválido');
   }
});

$("#inputCep").keyup(function (evt) { if (evt.keyCode == 13) $("#searchCep").trigger("click") });

$('#btnRegisterCompany').click(function() {
   $("[data-required]").removeClass("formError");

   let formError = validaForm();

   if (formError) return;
   if (!$("#termos").is(":checked")) return alertify.alert("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!", "Você precisa aceitar os termos para concluir o cadastro")

   let personLegal = {
       fantasia: $("#name").val(),
       razao: $('#razao').val(),
       cnpj: $('#cnpj').val(),
       email: $("#email").val(),
       cep: $("#inputCep").val(),
       uf: $("#uf").val(),
       addres: $("#inputAddres").val(),
       locality: $("#locality").val(),
       input: $('#inputState option:selected').val(),
       senha: $('#senha').val()
   };
   option = {
       method: 'POST',
       mycustomtype: "application/json charset=utf-8",
       url: `${BASE_URL}/manager/`,
       dataType: "json",
       data: person,
       beforeSend: () => {
           load(true, this);
           $(this).prop("disabled",true);
       },
       complete: () => {
           load(false, this);
           $(this).prop("disabled",false);
       },
       success: (res) => {
           load(false, "#btnRegisterCompany");
           if (typeof res == undefined || !res) throw new TypeError("Object null");

           if (!res.error) {
               alertify.success('Cadastro realizado com sucesso');
           } else {
               if (res.status == 0) alertify.error("Preencha todos os campos!");
               if (res, status != 0) alertify.error("Não foi possível fazer o cadastro");
           }
       },
       error: (e) =>  {
           alertify.error("Ocorreu um erro no servidor!");
       }
   };
   reqAjax(option);

});
