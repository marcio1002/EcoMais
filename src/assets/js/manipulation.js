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

$(".image-checkbox").each(function () {
   if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
     $(this).addClass('image-checkbox-checked');
   }
   else {
     $(this).removeClass('image-checkbox-checked');
   }
 });
 
 // sync the state to the input
 $(".image-checkbox").on("click", function (e) {
   $(this).toggleClass('image-checkbox-checked');
   var $checkbox = $(this).find('input[type="checkbox"]');
   $checkbox.prop("checked",!$checkbox.prop("checked"))
 
   e.preventDefault();
 });
