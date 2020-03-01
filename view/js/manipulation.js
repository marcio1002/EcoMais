const iptEmail = $("#email");
const iptCep = $("#cep");
const passwd = $("#pwd"); 
const statiElem = $("#stati");
const iptCity = $("#city");
const iptAddre = $("#addre");
const iptCpf= $("#cpf");

$('#search').click(() => searchCep());

iptCep.keypress((evt) => {
    if(evt.keyCode === 13) {
        evt.preventDefault();
        searchCep();
    }   
});

$("#btnPwd").click(() => {
   if(passwd[0].type === "password") {
    passwd.attr('type','text');
    $("#btnPwd").attr('value','Ocultar');
   }else{
    passwd.attr('type','password');
    $("#btnPwd").attr('value','Ver');
   }
    
});

iptCpf.keypress(() => {
    const {length} = iptCpf.val();
    let val = iptCpf.val();
    if(length === 3 || length === 7) {
        val += ".";
        iptCpf.val(val);
    }else if(length === 11) {
        val += "-";
        iptCpf.val(val);
    }
});

iptEmail.blur(() =>{   
    try{
        const regExp = /(.)+\@[a-z]+\.(com|br|gov|org|net|sp){1,3}$/;

        if(!regExp.test(iptEmail.val())) throw new TypeError("Invalid format");

    }catch(error) {
        alert("Formato inválido");
        console.log(error);
    }
});

function clearInput() {
    iptCep.val("");
    iptCity.val("");
    iptAddre.val("");
    statiElem.val("");
}