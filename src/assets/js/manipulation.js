let loadSpinner = `<span class="spinner-border spinner-border-sm align-vertical text-warning" role="status" aria-hidden="true"></span>`;



// <--- functions users --->

function load(l = false) {
   if(l) {
      let value =  $(".setLoad:eq(0)").text();
      $(".setLoad").html(`${loadSpinner} ${value}`);
   } else {
      $(".setLoad").find(".spinner-border").remove();
   }
}

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