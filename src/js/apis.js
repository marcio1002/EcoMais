async function searchCep() {
    try {
        const cep = iptCep.val();
        const validcep = /[0-9]{8}$/;
        if (!validcep.test(cep)) throw TypeError('Invalid zip code');
        
        const info  = await axios.get(`https://viacep.com.br/ws/${cep}/json/`);

        const {logradouro,localidade,bairro,uf,erro} = info.data;
        
        if(erro) throw new Error("0");
        iptCity.val(localidade)[0];
        iptAddre.val(`${bairro}, ${logradouro}`)[0];
        statiElem.val(uf)[0];     
    } catch (erro) {
        const UNDEFINED = "Error: 0";
        if(erro == UNDEFINED) return alertify.error("Não foi possível buscar o cep!");
        alertify.error('Cep inválido');
    }
}

/**
 * @param {Object} option
 * Defini uma opção de parametros para o ajax;
 */
function reqAjax(opt = option) 
{

    const {method, url, data,dataType,xhrFields,success,error,beforeSend,complete,accepts} = opt;

    $.ajax({
        method,
        url,
        data,
        dataType,
        xhrFields,
        beforeSend,
        complete,
        success,
        error: (xhr,desc,err) => { throw new Error(`${xhr.status} \n xhr descrition: ${xhr.responseText} \n Description: ${desc} \n Error: ${err}`); },
    })
    
}