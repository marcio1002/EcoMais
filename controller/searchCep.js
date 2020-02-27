async function searchCep() {
    try {
        const cep = inputCep.value;
        const validcep = /^[0-9]{8}$/
        if (!validcep.test(cep)) return alert('Cep inválido');

        const info  = await axios.get(`https://viacep.com.br/ws/${cep}/json/`);
        console.log(info.data)
        const {logradouro,localidade,bairro,uf,erro} = info.data;
        
        if(erro) throw new TypeError("Undefined value");
        
        inputCity.value = localidade;
        inputAddre.value = `${bairro} ${logradouro}`;
        stati.value = uf;      
    } catch (erro) {
        alert('Não foi possível buscar o cep');
        console.log(erro.request);
        console.log(erro.response);
        console.log(erro);
        clearInput();
    }
}