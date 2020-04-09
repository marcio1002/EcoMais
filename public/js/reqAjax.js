var option = {
    method: String,
    url: String,
    cache: Boolean,
    processData: Boolean,
    dataType: String,
    data: Object,
    accepts: Object,
    xhrFields: Object,
    statusCode: Object,
    beforeSend: Function,
    error: Function,
    dataFilter: Function,
    success: Function,
    complete: Function,
        
}

$('body').ready(() => {
    const BASE_URL = "https://localhost/WWW/CrudEcoMais";

    $('#submit').click((evt) =>{
        evt.preventDefault();
        let data = {
            name : $('#name').val(),
            email: $("#email").val(),
            pwd: $('#pwd').val()
        };
        option = 
        {
            method: 'POST',
            url: BASE_URL,
            dataType: "json",
            data,
            success: (response) =>{
                const res = JSON.parse(response);
                if(typeof res == "undefined" || !res) throw new TypeError("Object null");
            
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
            }
        }

            reqAjax(option);

    });

    $('#btndelete').click((evt) =>{
        evt.preventDefault();
        const data = { id: $('input[name=id]').val() }
        option = 
        {
            method: 'POST',
            url: BASE_URL,
            dataType: "json",
            data,
            success: (response) =>{
                const res = JSON.parse(response);
                if(typeof res == "undefined" || !res) throw new TypeError("Object null");
                return (!res.error) ? alertify.success('Usuario deletado com sucesso'): console.log(res.status,res.msg);
            },
        }

        alertify.confirm("Confirme a deleção","Deseja realmente deletar ?",() => reqAjax(option),() => {return} )

    });

    $('#btnUpdate').click(function (evt){
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
            method: 'POST',
            url: BASE_URL,
            dataType: "json",
            data,
            sucess: (response) =>{
               const res = JSON.parse(response);
                if(typeof res == "undefined" || !res) throw new TypeError("Object null");

                return (!res.error) ? alertify.success('Dados Atualizado'): alertify.error("Não foi possível fazer a atualização!");
            },
        }

            reqAjax(option);
            
    });

    $('#login').click((evt)  => {
        
        const data = { email: $("#email").val(),pwd: $('#pwd').val() };
        option = {
            method: 'POST',
            url: `${BASE_URL}/controller/`,
            dataType: "json",
            data,
            success: (response) =>{
              const  res = JSON.parse(response);
                if(typeof res == "undefined" ||!res) throw new TypeError("Object null");
                if (!res.error) {
                    location.href = "./view/mostrar.php";
                } else{
                    (res.status == 0) ?  alertify.error( 'Preencha todos os campos!') : alertify.error( 'Email ou senha inválidos');
                }
            }
        }
        reqAjax(option);

    })
}).keypress((evt) => {
    if(evt.key === "Enter") 
    $('#login').click();
});


/**
 * @param {Object} option
 * Defini uma option de parametros para o ajax;
 */
function reqAjax(opt = option) {

    const {method, url, data,dataType,xhrFields,success,error,beforeSend,accepts} = opt;

    $.ajax({
        method,
        url,
        data,
        dataType,
        xhrFields,
        success,
        error: (xhr,desc,err) => { throw new Error(`${xhr.status} \n xhr descrition: ${xhr.responseText} \n Description: ${desc} \n Error: ${err}`); },
    })
    
}