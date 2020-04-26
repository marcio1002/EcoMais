const iptEmail = $("#email");
const iptCep = $("#cep");
const iptCity = $("#city");
const iptAddre = $("#addre");
const iptCpf= $("#cpf");
const iptName = $("#name");
const passwd = $("#pwd"); 
const statiElem = $("#stati");
let connection;

$('#search').click(() => searchCep());


$("#btnPwd").click(() => {
   if(passwd[0].type === "password") {
    passwd.attr('type','text');
    $("#btnPwd").attr('value','Ocultar');
   }else{
    passwd.attr('type','password');
    $("#btnPwd").attr('value','Ver');
   }   
});



iptCpf.focusout((evt) => {
    let cpf = evt.target.value;
    iptCpf.val(cpf.replace(/(\d{3})?(\d{3})?(\d{3})?(\d{2})/, "$1.$2.$3-$4"));
});

iptCpf.focusin((evt) =>{
    let cpf = evt.target.value;
    iptCpf.val(cpf.replace(/[.-]/g,""));

})

iptEmail.focusout(() =>{   
    try{
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
            ".co",
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
        const regExp =  new RegExp("(.)+\@[a-z]+("+expDomain+"){1,3}$","g");

        if(!regExp.test(iptEmail.val())) throw new TypeError("Invalid format");

    }catch(error) {
        setMessage({html: "Digite um email válido",classes:"alert"});
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

//eventos de conexão
window.ononline = () => {
    (connection === "OFFLINE")? setMessage({html: "Sua Conexão voltou"}) : setMessage({html: "Conectado"});
    connection = "ONLINE";
};
window.onoffline = () => {
    connection = "OFFLINE";
    setMessage({html: "Você está offline"});
};

/**
 * funções para manipular os elementos
 * 1 - Limpar os inputs,
 * 2 - Mostrar load,
 * 3 - Eventos do teclado
 */
function clearInput() {
    $('input[type=text]').val("");
    $('input[type=email]').val("");
    $('input[type=password]').val("");
    $('input[type=tel]').val("");

}

function setMessage(option = Object) {
    M.toast(option);
}