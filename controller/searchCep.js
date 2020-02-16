async function searchCep() {
    try {
        const cep = inputCep.value;
        const validcep = /^[0-9]{8}$/
        if (!validcep.test(cep)) return alert('Cep inválido');

        const info  = await axios.get(`https://viacep.com.br/ws/${cep}/json/`,{ responseType: 'json'});
        const {logradouro,localidade,bairro,uf} = info.data;
        inputCity.value = localidade;
        inputAddre.value = logradouro+ ` ${bairro}`;
        stati.value = uf;
        
    } catch (erro) {
        alert('Não foi possível buscar o cep');
        console.log(erro.request)
        console.log(erro)
        clearInput();
    }
}