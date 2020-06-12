//Opições  padrão
option = {
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
}

$('body').ready(() => {
    $('*#btnDelete').click((evt) => {
        evt.preventDefault();
        const data = { id: $('input[name=id]').val() }
        option =
        {
            type: 'DELETE',
            url: `${BASE_URL}/manager/removeuser`,
            dataType: "json",
            data,
            success: (res) => {
                if (typeof res == undefined || !res) throw new TypeError("Object null");
                return (!res.error) ? (alertify.success('Usuario deletado com sucesso'), location.href = "http://localhost/WWW/CrudEcoMais/product") : console.log(res.status, res.msg);
            },
            error: (err) => {
                alertify.error("Ocorreu um erro no servidor");
            }
        }

        alertify.confirm("Confirme a deleção", "Deseja realmente deletar ?", () => reqAjax(option), () => { return })

    });

    $('*#btnUpdate').click(function (evt) {
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
            sucess: (res) => {
                if (typeof res == "undefined" || !res) throw new TypeError("Object null");

                return (!res.error) ? alertify.success('Dados Atualizado') : alertify.error("Não foi possível fazer a atualização!");
            },
        }

        reqAjax(option);

    });
    $("#passwd").keyup(evt => { if (evt.keyCode === 13) $("#btnLogar").click(); });
})
