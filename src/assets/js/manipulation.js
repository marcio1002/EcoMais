let loadSpinner = `<span class="spinner-border spinner-border-sm align-vertical text-warning" role="status" aria-hidden="true"></span>`;


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


function validaForm() {
   var forError = false;

   $("[data-required]").each(function () {
       if ($(this).is("input"))
           if ($(this).val().length == 0) {
               forError = true;
               $(this).addClass("formError");
           }
       if ($(this).is("select"))
           if ($(this).val().length == 0 || !$(this).val()) {
               forError = true;
               $(this).addClass("formError");
           }
   });

   return forError;
}