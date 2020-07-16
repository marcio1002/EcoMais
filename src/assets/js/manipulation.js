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

function formatDateTime(string) {
   let datetime = string.split(" ");
   let format = datetime[0].split("-");
   return `${format[2]}/${format[1]}/${format[0]} ${datetime[1]}`;
}

function formatDate(string) {
   let date = /^\d{4}\-\d{2}\-\d{2}/g.exec(string)[0].split("-");
   if(date){
      return `${date[2]}/${date[1]}/${date[0]}`;
   }
   return "";
}

function clearInput() {
   $('input[type=text]').val("");
   $('input[type=email]').val("");
   $('input[type=password]').val("");
   $('input[type=tel]').val("");

}

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