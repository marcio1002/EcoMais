async function searchCep() {
    try {
        const cep = iptCep.val();
        const validcep = /[0-9]{8}$/;
        if (!validcep.test(cep)) throw TypeError('Invalid zip code');

        const info  = await axios.get(`https://viacep.com.br/ws/${cep}/json/`);
        const {logradouro,localidade,bairro,uf,erro} = info.data;
        
        if(erro) throw new Error("Undefined value");
        
        iptCity.val(localidade);
        iptAddre.val(`${bairro}, ${logradouro}`);
        statiElem.val(uf);      
    } catch (erro) {
        alert('Cep inválido');
        clearInput();
    }
}