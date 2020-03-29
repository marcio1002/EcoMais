$('body').ready(() => {
    
    $('#submit').click((evt) =>{
        evt.preventDefault();
        let data = {
            name : $('#name').val(),
            email: $("#email").val(),
            pwd: $('#pwd').val()
        };
            const res = reqAjax('POST','../controller/adicionarContaController.php',data, (res) =>{
                if(typeof res == "undefined" || !res) throw new TypeError("Object null");
            
                if (!res.error) {
                    M.toast({html: 'Cadastro realizado com sucesso', classes: "text",outDuration: 210});
                    $('input[type=text]').val("");
                    $('input[type=email]').val("");
                    $('input[type=password]').val("");
                } else{
                    M.toast({html: 'Tente cadastrar novamente', classes: "alert",outDuration: 210});
                    return console.log(res.status,res.msg);
                } 
            });

    });

    $('#btndelete').click((evt) =>{
        evt.preventDefault();
        const data = { id: $('input[name=id]').val() }
        if(!confirm("Deseja realmente deletar!")) return;

        const res = reqAjax('POST','../controller/deletarContaController.php',data,(res) =>{
            if(typeof res == "undefined" || !res) throw new TypeError("Object null");
            return (!res.error) ? M.toast({html: 'Usuario deletado com sucesso', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
        });
    });


    $('#btnDltImage').click(function (evt){
        evt.preventDefault();
        if(!confirm('Deseja realmente deletar!')) return;

        const data = {img: $('input[name=image]').val()};
    
        const res = reqAjax('POST','../controller/deletarImagemController.php', data, (res) =>{
            if(typeof res == "undefined" || !res ) throw new TypeError("Object null");

            return (!res.error) ? M.toast({html: 'Imagem deletada', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
        });

       
    });

    $('#btnUpdate').click(function (evt){
        evt.preventDefault();
        const data = {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            passwd: $('input[name=passwd]').val(),
            id: $('input[name=id]').val(),
        }
            const res =  reqAjax('POST','../controller/atualizarContaController.php', data,(res) =>{

                if(typeof res == "undefined" || !res) throw new TypeError("Object null");

            return (!res.error) ? M.toast({html: 'Dados Atualizado', classes: "text",outDuration: 210}): console.log(res.status,res.msg);
            } );
            
    });

    $('#login').click((evt)  => {
        evt.preventDefault();
        const data = { email: $("#email").val(),pwd: $('#pwd').val() };

        reqAjax('GET','./controller/loginController.php',data, (res) =>{
            if(typeof res == "undefined" ||!res) throw new TypeError("Object null");
            if (!res.error) {
                location.href = "./view/mostrar.php";
            } else{
                if(res.status == 0) M.toast({html: 'Preencha todos os campos!', classes: "alert",outDuration: 210});
                if(res.status == 3) M.toast({html: 'Email ou senha inválidos', classes: "alert",outDuration: 210});
            }
        });

    })
});


/**
 * @param method String
 * @param url  String
 * @param data Object
 * @param response Callback
 */
function reqAjax(method,url,data,response) {
    $.ajax({
        method,
        url,
        data,
        dataType: "json",
        success: (res) =>{ response(res); },
        error: (xhr,desc,err) => { throw new Error(`ErrXHR: ${xhr.status} \n ${xhr.responseText} Description: ${desc} \n Error: ${err}`); },
    })
    
}