/**
 * 
 * @param {String} elem 
 * Elementos pai
 */
function validaForm(elem = "") {
   var forError = false;

   $(`${elem} [data-required]`).each(function () {
       if ($(this).is("input"))
           if ($(this).val().length == 0) {
               forError = true;
               $(this).addClass("formError");
           }
       if ($(this).is("select"))
           if (!$(this).val() || $(this).val().length == 0 ) {
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

/**
 * 
 * @param {String} url 
 */
function getPropsUrl(url) {
   let obj = new Object;
   let infoUrl = new URL(url);
   let params = infoUrl.search.replace("?","").split("&");

   params.forEach(val => {
       let array = val.split("=");
       let prop =  array[0];
       let value = array[1];
       obj[prop] = value; 
   });
   return obj;
}

function clearInput() {
   $('input[type=text]').val("");
   $('input[type=email]').val("");
   $('input[type=password]').val("");
   $('input[type=tel]').val("");

}

function isValidEmail(email) {

    const array_Exp = new Array(
        ".com",
        ".br",
        ".org",
        ".net",
        ".sp",
        ".info",
        ".biz",
        ".name",
        ".cc",
        ".ws",
        ".mobi",
        ".in",
        ".me",
        ".online",
        ".site",
        ".top",
        ".club",
        ".website",
        ".link",
        ".vc",
        ".click",
        ".cool",
        ".men",
        ".gratis",
        ".plus",
        ".legal",
        ".email",
        ".host",
        ".tech",
        ".download",
        ".cloud",
        ".digital",
        ".software",
        ".webcam",
        ".chat",
        ".blog",
        ".network",
        ".vlog",
        ".flog",
        ".sale",
        ".store",
        ".shopping",
        ".shop",
        ".promo",
        ".news",
        ".live",
        ".review",
        ".love",
        ".capital",
        ".trade",
        ".work",
        ".business",
        ".ltda",
        ".company",
        ".ind",
        ".bar",
        ".pizza",
        ".beer",
        ".fit",
        ".pub",
        ".vodka",
        ".cafe",
        ".diet",
        ".wine",
        ".delivery",
        ".studio",
        ".hospital",
        ".stream",
        ".dog",
        ".pet",
        ".camera",
        ".gardem",
        ".global",
        ".sc",
        ".us",
        ".city",
        ".world",
        ".contagem",
        ".sampa",
        ".bsb",
        ".campinas",
        ".curitiba",
        ".floripa",
        ".goiana",
        ".joinville",
        ".poa",
        ".recife",
        ".rio",
        ".pro",
        ".taxi",
        ".bio",
        ".vet",
        ".coach",
        ".adm",
        ".adv",
        ".arq",
        ".cnt",
        ".eng",
        ".eti",
        ".med",
        ".mus",
        ".odo",
        ".gov"
    );
    const expDomain = array_Exp.join("|");
    const regExp = new RegExp("(.)+\@[a-z]+(" + expDomain + "){1,3}$", "g");

    return (regExp.test(email)) ? true : false;

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