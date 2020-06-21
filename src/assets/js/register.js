let forca = 0;


function validaForm() {
    var forError = false;

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
    });

    return forError;
}

//mascaras
$("#inputCep").mask("00000000", { placeholder: "nnnnnnnn", clearIfNotMatch: true })


//verifica o email
$("#cadEmail").focusout(function(e) {
    if (!isValidEmail($("#cadEmail").val())) {
        $("#cadEmail").addClass("formError");
    } else {
        $("#cadEmail").removeClass("formError");
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

$("#passwd").keypress(function () {
    $("#progress-bar").removeClass().addClass("progress-bar");
    let value = $(this).val();
    forca = 5;
    if (value.length < 8 ) {
        if(/[A-Z]+/.test(value)  &&  /[a-z]+/.test(value) || /[\d]+/.test(value) && /[a-z]+/.test(value)) forca = 27;
        if(/[A-Z]+/.test(value) && /[a-z]+/.test(value) && /[\d]+/.test(value)  || /[a-z]+/.test(value) && /[\d]+/.test(value) && /[@!#$%&*/\\]+/.test(value) ) forca = 39;

    }else {
        if ( /[A-Z]+/.test(value)  &&  /[a-z]+/.test(value) ||/[\d]+/.test(value) &&  /[a-z]+/.test(value) ) forca = 57;

        if ( /[a-z]+/.test(value) && /[\d]+/.test(value) && /[A-Z]+/.test(value)) forca = 80;

        if (/[a-z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[A-Z]+/.test(value) )  forca = 85;
        if(/[a-z]+/.test(value) && /[A-Z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[\d]+/.test(value)) forca = 100;
    }

    if (forca < 30)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-danger");
    else if (forca > 30 && forca <= 68)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-warning");
    else if (forca > 70)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-success");
})

$("#searchCep").on("click", async function () {
    try {
        const res = await searchCep($("#inputCep").val())
        if (res !== null) {
            $("#uf").val(res.uf);
            $("#inputAddres").val(`${res.bairro}, ${res.logradouro}`);
            $("#localidade").val(res.localidade);
        } else {
           return alertify.error("Não foi possível buscar o cep informado!")
        }
    } catch (e) {
       return alertify.error('Cep inválido');
    }
});

$("#inputCep").keyup(async function (evt) { if (evt.keyCode == 13) $("#searchCep").trigger("click") });


// <--- Functions Server --->

$('#btnRegister').click(() => {

    load(false, "#btnRegister");
    $("[data-required]").removeClass("formError");

    let formError = validaForm();

    if (formError) return alertify.error("Preencha os campos em vermelho!");
    if (!$("#termos").is(":checked")) return alertify.alert("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!", "Você precisa aceitar os termos para concluir o cadastro")

    let person = {
        name: $("#inputName").val(),
        email: $("#cadEmail").val(),
        passwd: $("#passwd").val(),
        cpf: $("#cpf").val(),
        cep: $("#inputCep").val(),
        uf: $("#uf").val(),
        addres: $("#inputAddres").val(),
        localidade: $("#localidade").val(),
    };
    option = {
        method: 'POST',
        mycustomtype: "application/json charset=utf-8",
        url: `${BASE_URL}/manager/addaccountpersonphysical`,
        dataType: "json",
        data: person,
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
            }
        },
        error: (e) =>  {
            alertify.error("Ocorreu um erro no servidor!");
        }
    }
    reqAjax(option);

});