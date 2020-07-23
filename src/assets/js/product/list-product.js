$(function () {
    alertify.set('notifier', 'position', 'top-right');

    function createTable() {
        $("#list-product").append(`<table id="table" class="table table-striped table-bordered bg-dark text-white" style="width:100%"></table>`);
        $("#list-product #table").append(`<thead id="thead" class="thead bg-light text-red-wine font-weight-bold"></thead>`);
        $("#list-product #table").append(`<tbody id="tbody" class='text-center'></tbody>`);

        const data = { id: 2, fkCompany: 3 };

        const option = {
            method: 'POST',
            mycustomtype: "application/json",
            url: `${BASE_URL}/manager/searchproduct`,
            dataType: "json",
            data,
            success: (res) => {
                if (res && !res.error) {
                    if (res.data) {
                        $("#logoCompany").append(`<img class="img-fluid w-100" src="${res.data[0].imagem}" alt="logo do(a) tenda-atacado">`);
                        $("#table #thead").append(`
                                <tr>
                                    <th>Nome</th>
                                    <th>Marca</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Inicio promoção</th>
                                    <th>Fim promoção</th>
                                </tr>
                            `);

                        res.data.forEach((val, index) => {
                            $("#table #tbody").append(`
                                <tr data-id="${val.id_produto}" >
                                    <td>${val.nome}</td>
                                    <td>${val.marca}</td>
                                    <td>${val.descricao}</td>
                                    <td> <span class="badge badge-success p-2 font-size-1em">${val.preco}</span></td>
                                    <td>${val.quantidade}</td>
                                    <td><span class="badge badge-info font-size-1em">${formatDate(val.periodo_inicio)}</span></td>
                                    <td><span class="badge badge-info font-size-1em">${formatDate(val.periodo_fim)}</span></td>
                                </tr>`);
                        });
                        $("#list-product #table").dataTable({
                            "language": {
                                "sEmptyTable": "Nenhum produto encontrado",
                                "sInfo": "Mostrando de _START_ até _END_    total de _TOTAL_ registros",
                                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                                "sLengthMenu": "_MENU_ resultados por página",
                                "sLoadingRecords": "Carregando...",
                                "sProcessing": "Processando...",
                                "sZeroRecords": "Nenhum produto encontrado",
                                "sSearch": "Pesquisar",
                                "oPaginate": {
                                    "sNext": "Próximo",
                                    "sPrevious": "Anterior",
                                    "sFirst": "Primeiro",
                                    "sLast": "Último"
                                },
                            }
                        });
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
});