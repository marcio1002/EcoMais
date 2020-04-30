const iptEmail = $("#email");
const iptCep = $("#cep");
const iptCity = $("#city");
const iptAddre = $("#addre");
const iptCpf= $("#cpf");
const iptName = $("#name");
const passwd = $("#pwd"); 
const statiElem = $("#stati");

$('#search').click(() => searchCep());


$("#btnPwd").on("click", () => {
   if(passwd[0].type === "password") {
    passwd.attr('type','text');
    $("#btnPwd").attr('value','Ocultar');
    
   }else{
    passwd.attr('type','password');
    $("#btnPwd").attr('value','Ver');
   }   
});



iptCpf.on("focusout", function() {
    let cpf = $(this).val();
    iptCpf.val(cpf.replace(/(\d{3})?(\d{3})?(\d{3})?(\d{2})/, "$1.$2.$3-$4"));
});

iptCpf.focusin((evt) =>{
    let cpf = evt.target.value;
    iptCpf.val(cpf.replace(/[.-]/g,""));

})

iptEmail.focusout(() =>{  

   try {

    if( !isValidEmail(iptEmail.val()) ) throw new TypeError("Formato de email inválido")

   }catch(err) {
        M.toast({html: "Digite um email válido",classes:"alert"})
   }
});

$('.smoothScroll').click(function(elem)  {
    elem.preventDefault();
    let id = $(this).attr('href'),
    menuHeight = $('nav').innerHeight(),
    target = $(id).offset().top - menuHeight;
    $(doc).animate({  scrollTop: target  },800);
})

//eventos para manipulação do teclado
passwd.keyup( evt => { $('span#length').html(evt.target.value.length);});

iptCep.keyup( evt => { if(evt.keyCode == 13) searchCep() });

passwd.keypress( evt => { if(evt.keyCode == 13) $("#btnPwd").trigger("click") })