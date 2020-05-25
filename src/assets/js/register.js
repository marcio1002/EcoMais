let forca = 0;

//mascaras
$("input[name='cpf'],#cpf").mask("000.000.000-00", { placeholder: "NNN.NNN.NNN-NN", clearIfNotMatch: true });
$("#inputCep").mask("00000000", { placeholder: "NNNNNNNN ", clearIfNotMatch: true })


//eventos para manipulação do teclado

//verifica o email
$("#email").focusout(() => {
    if (!isValidEmail($("#email").val())) {
        $("#email").addClass("formError");
    } else {
        $("#email").removeClass("formError");
    }
});

//mostra o palavra chave (senha)
$("#btnViewPasswd").on("click", function () {
    let passwd = $("#passwd:eq(0)");
    let icon = $(this).find("#iconPasswd:eq(0)");

    if (passwd.is("[type='password']")) {
        passwd.attr('type', 'text');
        icon.removeClass("fa-eye-slash");
        icon.addClass("fa-eye");

    } else {
        passwd.attr('type', 'password');
        icon.removeClass("fa-eye");
        icon.addClass("fa-eye-slash");
    }
});
$("#passwd").keyup(function (evt) { $('span#length').html($(this).val().length) });

$("#passwd").keypress(function () {
    $(this)
        .removeClass("bg-danger")
        .removeClass("bg-warning")
        .removeClass("bg-info")
        .removeClass("bg-success");

    if (($(this).val().length > 4) && ($(this).val().length < 8)) 
        forca += 10;     
    else if (($(this).val().length > 8) && ($(this).val().match(/[a-z]+/)))
        forca += 40;
    else if (($(this).val().length > 8) && ($(this).val().match(/[A-Z]+/)))
        forca += 50;
    else if (($(this).val().length > 8) && ($(this).val().match(/[\d+]+/)))
        forca += 100;
    

    if(forca < 30 )
        $("#progress-bar").css("width", "20%").addClass("bg-danger");
    else if(forca > 30 && forca < 60)
        $("#progress-bar").css("width", "40%").addClass("bg-warning");
    else if(forca > 60 && forca < 80)
        $("#progress-bar").css("width", "60%").addClass("bg-info");
    else 
        $("#progress-bar").css("width", "100%").addClass("bg-success");
})

$("#searchCep").on("click", async function () {
    const res = await searchCep($("#inputCep").val())

    $("#uf").val(res.uf);
    $("#inputAddres").val(`${res.bairro}, ${res.logradouro}`);
    $("#localidade").val(res.localidade);
});

$("#inputCep").keyup(async function (evt) { if (evt.keyCode == 13) $("#searchCep").trigger("click") });


// <--- Functions Server --->

$('#btnRegister').click(() => {
    let forError = false;

    load(false, "#btnRegister");
    $("[data-required]").removeClass("formError");

    $("[data-required]").each(function () {
        if ($(this).is("input"))
            if ($(this).val().length == 0) {
                forError = true;
                $(this).addClass("formError");
            }
        if ($(this).is("select"))
            if ($(this).val().length == 0 || !$(this).val()) {
                forError = true;
                $(this).addClass("formError");
            }
    })

    if (forError) return alertify.error("Corrija os campos em vermelho");
    if (!$("#termos").is(":checked")) return alertify.alert("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!", "Você precisa aceitar os termos para concluir o cadastro")

    let person = {
        name: $("#inputName").val(),
        email: $("#email").val(),
        passwd: $("#passwd").val(),
        cpf: $("#cpf").val(),
        cep: $("#inputCep").val(),
        uf: $("#uf").val(),
        addres: $("#inputAddres").val(),
        localidade: $("#localidade").val(),
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
            load(true, "#btnRegister");
        },
        success: (res) => {
            load(false, "#btnRegister");
            if (typeof res == undefined || !res) throw new TypeError("Object null");

            if (!res.error) {
                alertify.success('Cadastro realizado com sucesso');
            } else {
                if (res.status == 0) alertify.error("Preencha todos os campos!");
                if (res, status != 0) alertify.error("Não foi possível fazer o cadastro");
                return console.log(res.status, res.msg);
            }
        },

    }
    reqAjax(option);

});