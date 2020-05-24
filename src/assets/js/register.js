

//mascaras
$("input[name='cpf'],#cpf").mask("000.000.000-00", { placeholder: "NNN.NNN.NNN-NN", clearIfNotMatch: true });
$("#inputCep").mask("00000000", { placeholder: "NNNNNNNN ", clearIfNotMatch: true })


//eventos para manipulação do teclado
$("#passwd").keyup(function (evt) { $('span#length').html($(this).val().length) });

$("#inputCep").keyup(async function (evt) { if (evt.keyCode == 13) { const res = await searchCep($("#inputCep").val()); console.log(res); } });

$("#passwd").keypress(evt => { if (evt.keyCode == 13) $("#btnViewPasswd").trigger("click"); })

//verifica o email
$("#email").focusout(() => {
    try {
        if (!isValidEmail($("input[name='email'], #email").val())) throw new TypeError("Formato de email inválido")

    } catch (err) {
        alertify.error("Digite um email válido");
    }
});

//mostra o palavra chave (senha)
$("#btnViewPasswd").on("click", function () {
    let passwd = $("#passwd:eq(0)");
    let btnpwd = $(this).find("#iconPasswd:eq(0)");

    if (passwd.is("[type='password']")) {
        passwd.attr('type', 'text');
        btnpwd.text('lock_open');

    } else {
        passwd.attr('type', 'password');
        btnpwd.text('lock_outline');
    }
});

$("#searchCep").click(async function () {
    const res = await searchCep($(this).val())

});


// <--- Functions Server --->

$('#register').click((evt) => {
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
        success: (res) => {
            load(false);
            if (typeof res == undefined || !res) throw new TypeError("Object null");

            if (!res.error) {
                alertify.success('Cadastro realizado com sucesso');
                $('input[type=text]').val("");
                $('input[type=email]').val("");
                $('input[type=password]').val("");
            } else {
                if (res.status == 0) alertify.error("Preencha todos os campos!");
                if (res, status != 0) alertify.error("Não foi possível fazer o cadastro");
                return console.log(res.status, res.msg);
            }
        },

    }
    reqAjax(option);

});