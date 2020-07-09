alertify.set('notifier', 'position', 'top-right');


function formatDateTime(param) {
    let datetime = param.split(" ");
    let format = datetime[0].split("-");
    return `${format[2]}/${format[1]}/${format[0]} ${datetime[1]}`;
}

function createTable() {
    $("#list-product").append(`<table id="table" class="table table-striped table-bordered bg-dark text-white" style="width:100%"></table>`);
    $("#list-product #table").append(`<thead id="thead" class="thead bg-light text-red-wine font-weight-bold"></thead>`);
    $("#list-product #table").append(`<tbody id="tbody"></tbody>`);
    const data = { id: "2", fkCompany: "1" };

    const option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/searchproduct`,
        dataType: "json",
        data,
        success: (res) => {
            if (res)
                if (!res.error) {
                    if (res.data) {
                        $("#table #thead").append(`
                                <tr>
                                    <td>Nome</td>
                                    <td>Preço</td>
                                    <td>Marca</td>
                                    <td>Descrição</td>
                                    <td>Quanti.</td>
                                    <td>Data/Hora ini. promoção</td>
                                    <td>Data/Hora fim promoção</td>
                                <tr>
                            `);
                        res.data.forEach((val, index) => {
                            $("#table #tbody").append(`
                                <tr data-id="${val.id_produto}" >
                                    <td>${val.nome}</td>
                                    <td>${val.preco}</td>
                                    <td>${val.marca}</td>
                                    <td>${val.descricao}</td>
                                    <td>${val.quantidade}</td>
                                    <td>${formatDateTime(val.periodo_inicio)}</td>
                                    <td>${formatDateTime(val.periodo_fim)}</td>
                                <tr>
                                `)
                        })
                    }
                } else {
                    alertify.alert("aviso", "Erro ao buscar produto");
                }
        },
        error: (err) => alertify.error("Ocorreu um erro no servidor!")
    };


    reqAjax(option);
   
    
}

createTable();