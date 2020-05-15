const BASE_URL = "https://www.localhost/WWW/CrudEcoMais";
//Opições  padrão
option = {
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
}

$('body').ready(() => {
//cadastro do usuario
    $('#register').click((evt) =>{
        evt.preventDefault();
        let person = {
          //os dados
        };
        option = 
        {
            method: 'POST',
            mycustomtype: "application/json",
            url: `${BASE_URL}/manager/addaccount`,
            dataType: "json",
            data: person,
            error: (e) => console.log(`estado pronto: ${e.readyState} \nestado: ${e.status} \nestado texto: ${e.statusText}: \nfunção estado: ${e.state()}`),
            beforeSend: () => {
              load(true);
            },
            success: (res) =>{
                load(false);
                if(typeof res == undefined || !res) throw new TypeError("Object null");
            
                if (!res.error) {
                    alertify.success('Cadastro realizado com sucesso');
                    $('input[type=text]').val("");
                    $('input[type=email]').val("");
                    $('input[type=password]').val("");
                } else{
                    if(res.status == 0) alertify.error("Preencha todos os campos!");
                    if(res,status != 0) alertify.error("Não foi possível fazer o cadastro");
                    return console.log(res.status,res.msg);
                } 
            },
            
        }

            reqAjax(option);

    });

    $('*#btnDelete').click((evt) =>{
        evt.preventDefault();
        const data = { id: $('input[name=id]').val() }
        option = 
        {
            type: 'DELETE',
            url: `${BASE_URL}/manager/removeuser`,
            dataType: "json",
            data,
            success: (res) =>{
                if(typeof res == undefined || !res) throw new TypeError("Object null");
                return (!res.error) ? ( alertify.success('Usuario deletado com sucesso'), location.href = "http://localhost/WWW/CrudEcoMais/product" ): console.log(res.status,res.msg);
            },
            error: (err) => {
                alertify.error("Ocorreu um erro no servidor");
            }
        }

        alertify.confirm("Confirme a deleção","Deseja realmente deletar ?",() => reqAjax(option), () => {return} )

    });

    $('*#btnUpdate').click(function (evt){
        evt.preventDefault();
        const data = 
        {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            passwd: $('input[name=passwd]').val(),
            id: $('input[name=id]').val(),
        }

        option = 
        {
            type: 'POST',
            url: BASE_URL,
            dataType: "json",
            data,
            sucess: (res) =>{
                if(typeof res == "undefined" || !res) throw new TypeError("Object null");

                return (!res.error) ? alertify.success('Dados Atualizado'): alertify.error("Não foi possível fazer a atualização!");
            },
        }

            reqAjax(option);
            
    });
    
//requisição de login
    $('#btnLogar').click(()  => {
        
        const person = { email: $("#inputEmail").val(),passwd: $('#inputPwd').val() };
        option = {
            method: 'POST',
            mycustomtype: "application/json",
            url: `${BASE_URL}/manager/login`,
            dataType: "json",
            data: person,
            success: (res) =>{

                if(typeof res == undefined ||!res) throw new TypeError("Object null");
                if (! res.error) {
                    location.href = `${BASE_URL}/product/`;
                } else{
                    if( res.status == 400) {
                        $("#inputEmail").addClass("inputError");
                        $('#inputPwd').addClass("inputError");
                        alertify.error( 'Preencha todos os campos!');
                    } else {
                        alertify.error( 'Email ou senha inválidos');
                    }
                }
            }
        }
        reqAjax(option);

    })

//recuperar senha 
$("#btnrRcoverPwd").click(() => {
    if(!$("input:eq(0)").hasClass("inputError")) {
        let data = {
            option: $("#checkChave").val(),
            value: $("#recoverpwd").val(),
        };

        option = {
            method: 'PUT',
            mycustomtype: "application/json",
            url: `${BASE_URL}/manager/recoverpwd`,
            dataType: "json",
            data: data,
            success: (res) =>{
                if(typeof res == undefined || !res) throw new TypeError("Object null");
                console.log(res);
            } ,
            error: (err) => {
                alertify.error("OCorreu um erro no servidor")
            }
        }
        reqAjax(option);
    }
})

    $("#passwd").keyup( evt => { if(evt.keyCode === 13)  $("#login").click(); });
})
