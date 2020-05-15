let loadSpinner = `<span class="spinner-border spinner-border-sm align-vertical text-warning" role="status" aria-hidden="true"></span>`;


//mascaras
$("input[name='cpf'],#cpf").mask("000.000.000-00", { placeholder: "NNN.NNN.NNN-NN", clearIfNotMatch: true });
$("#inputCep").mask("00000000", { placeholder: "NNNNNNNN ", clearIfNotMatch: true })


//metodos para tela de cadastros

$("#email").focusout(() => {
   try {

      if (!isValidEmail($("input[name='email'], #email").val())) throw new TypeError("Formato de email inválido")

   } catch (err) {
      alertify.error("Digite um email válido");
   }
});

$("#btnViewPasswd").on("click", function () {
   let passwd = $("#passwd:eq(0)");
   let btnpwd = $(this).find("#iconPasswd:eq(0)");

   if (passwd.is("[type='password']")) {
      passwd.attr('type', 'text');
      btnpwd.text('lock_open');

   } else {
      passwd.attr('type', 'password');
      btnpwd.text('lock_outline');
   }
});

$("#searchCep").click(async function () {
   const res = await  searchCep($(this).val())
   
});

//pula para o próximo elemento que tem a classe .nextItem
$(".nextItem").keypress(function (e) {
   var tecla = e.keyCode ? e.keyCode : e.which;
   if (tecla == 13) {
      e.preventDefault();
      e.stopPropagation();

      var indexof = $(".nextItem").index(this) + 1;

      if (indexof < $(".nextItem:not(input[readonly])").length)
         $(`.nextItem:eq(${indexof})`).focus();
      else
         $("#btnSalvaItem").trigger('click');
   }
});


//definindo uma animação de rolagem mais lenta do scroll
$('.smoothScroll').click(function (elem) {
   elem.preventDefault();
   let id = $(this).attr('href'),
      menuHeight = $('nav').innerHeight(),
      target = $(id).offset().top - menuHeight;
   $(document).animate({ scrollTop: target }, 800);
})

//tela de recuperação de senha
$("#checkChave").change(function () {
   if ($(this).is(":checked")) {
      $("#recover-label").html("Cole a chave de acesso aqui");
      $(this).attr("value","1");
   }
   else {
      $("#recover-label").html("Digite o email:");
      $(this).attr("value","0");
   }
})

$("#recoverpwd").focusout( function() {
   if($("#checkChave").val() == 0) 
      if(!isValidEmail($(this).val())) 
         $("#recoverpwd").addClass("inputError");
      else 
      $("#recoverpwd").removeClass("inputError");
});

//eventos para manipulação do teclado
$("#passwd").keyup(function (evt) { $('span#length').html($(this).val().length) });

$("#inputCep").keyup(async function (evt) { if (evt.keyCode == 13) { const res =  await searchCep($("#inputCep").val()); console.log(res); }});

$("#passwd").keypress(evt => { if (evt.keyCode == 13) $("#btnViewPasswd").trigger("click"); })

//load

function load(l = false) {
   if(l) {
      let value =  $(".setLoad:eq(0)").text();
      $(".setLoad").html(`${loadSpinner} ${value}`);
   } else {
      $(".setLoad").find(".spinner-border").remove();
   }
}