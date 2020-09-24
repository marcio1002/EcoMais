$(function () {
    let forca = 0;
    let maskContact = "(00) 00000-0000";
    let optionsMask = {
        placeholder: "telefone fixo ou telefone móvel",
        clearIfNotMatch: true,
    }

    alertify.set('notifier', 'position', 'top-right');


    $("#contato")
    .mask(maskContact, optionsMask)
    .on("keypress", function (evt) {
        let value = $("#contato").val().replace(/\D/g, "");
        value += evt.key;
        maskContact = value.length > 10 ? "(00) 00000-0000" : "(00) 0000-0000";
        $("#contato").mask(maskContact, optionsMask);
        console.clear();
    });

    $("#cnpj").mask("00.000.000/0000-00", { placeholder: "__.____.___/____-__", clearIfNotMatch: true });
    $("#mesValidade").mask("00", { placeholder: "__", clearIfNotMatch: true });
    $("#anoValidade").mask("0000", { placeholder: "____", clearIfNotMatch: true });
    $("#creditCardHolderCPF").mask("000.000.000-00", { placeholder: "___.___.___-__", clearIfNotMatch: true });
    $("#cvvCartao").mask("000", { placeholder: "___", clearIfNotMatch: true });
    $("#numCartao").mask("0000 0000 0000 0000", { placeholder: "___ ___ ___ ___", clearIfNotMatch: true });



    $("#searchCep").on("click", async function () {
        try {
            const res = await searchCep($("#inputCep").val())
            if (res !== null) {
                $("#uf").val(res.uf);
                $("#address").val(`${res.bairro}, ${res.logradouro}`);
                $("#locality").val(res.localidade);
            } else {
                return alertify.error("Não foi possível buscar o cep informado!")
            }
        } catch (e) {
            return alertify.error('Cep inválido');
        }
    });

    $("#inputCep")
        .mask("00000000", { placeholder: "_ _ _ _ _ _ _ _", clearIfNotMatch: true })
        .keypress(evt => { if (evt.keyCode == 13) (evt.preventDefault(),$("#searchCep").trigger("click")) });

    $("#email").focusout(function () {
        if (!isValidEmail($(this).val())) {
            $(this).addClass("formError");
        } else {
            $(this).removeClass("formError");
        }
    });

    $("#passwd").keypress(function (e) {
        $("#progress-bar").removeClass().addClass("progress-bar");
        let value = $(this).val() || e.target.value;
        forca = 5;
        if (value.length < 5) {
            if (/[A-Z]+/.test(value) && /[a-z]+/.test(value)) forca = 13;
            if (/[\d]+/.test(value) && /[a-z]+/.test(value)) forca = 23
            if (/[A-Z]+/.test(value) && /[a-z]+/.test(value) && /[\d]+/.test(value)) forca = 32;
            if (/[a-z]+/.test(value) && /[\d]+/.test(value) && /[@!#$%&*/\\]+/.test(value)) forca = 40

        } else {
            if (/[A-Z]+/.test(value) && /[a-z]+/.test(value)) forca = 32;
            if (/[\d]+/.test(value) && /[a-z]+/.test(value)) forca = 42

            if (/[a-z]+/.test(value) && /[\d]+/.test(value) && /[A-Z]+/.test(value)) forca = 55;

            if (/[a-z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[A-Z]+/.test(value)) forca = 75;
            if (/[a-z]+/.test(value) && /[A-Z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[\d]+/.test(value)) forca = 100;
        }

        if (forca < 30)
            $("#progress-bar").css("width", `${forca}%`).addClass("bg-danger");
        else if (forca > 30 && forca <= 68)
            $("#progress-bar").css("width", `${forca}%`).addClass("bg-warning");
        else if (forca > 70)
            $("#progress-bar").css("width", `${forca}%`).addClass("bg-success");
    });

    $("#btnViewPasswd").on("click", function () {
        let icon = $(this).find("#iconPasswd:eq(0)");

        if ($("#passwd:eq(0)").is("[type='password']")) {
            $("#passwd:eq(0)").attr('type', 'text');
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $("#passwd:eq(0)").attr('type', 'password');
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

    $("#btnRegisterCompany").click(function () {
        alertify.dismissAll()
        $("[data-required]").removeClass("formError");

        if (validaForm("#formCompany")) return alertify.error("Preencha os campos em vermelho!");
        if (!$("#termos").is(":checked")) return alertify.alert("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!", "Você precisa aceitar os termos para concluir o cadastro");
        $("#modalPagamento").modal({
            backdrop: false,
            keyboard: true,
            focus: true
        })
    });

    $("input[data-required],select[data-required]").focusout(function () {
        if ($(this).is("#email")) return;
        $(this).removeClass("formError").removeClass("formValid");
        let className = (!$(this).val() || $(this).val().length == 0) ? "formError" : "formValid";
        $(this).addClass(className);
    });


    $('#btnComprar').click(function (e) {
        $("input,select").removeClass("formError");
        if (validaForm("#modalPagamento")) return alertify.error("Preencha os campos em vermelho!");
        $(this).prop("disabled", true);
        let form = $("#formCompany")[0];
        let formPag = $("#formPagamento")[0];
        let data = new FormData(form);
        let data3 = new FormData(formPag)

        let option = {
            method: 'POST',
            mycustomtype: "application/json charset=utf-8",
            url: `${BASE_URL}/manager/addaccountpersonlegal`,
            dataType: "json",
            data,
            processData: false,
            contentType: false,
            complete: () => $(this).prop("disabled", false),
            success: (res) => {
                if (!res.error) {
                    $("#modalPagamento").modal('hide');
                    $("#modalPagamento input,select").val("");
                    alertify.success('Cadastro realizado com sucesso');
                    clearForm();
                } else {
                    if (res.status == 0) alertify.error("Preencha todos os campos!");
                    if (res, status != 0) alertify.error("Não foi possível fazer o cadastro");
                }
            },
            error: (e) => {
                $('#modalPagamento').modal('hide');
                alertify.error("Ocorreu um erro no servidor!");
            }
        };
        reqAjax(option);

    });
})