$(function () {
    let forca = 0;
    alertify.set('notifier', 'position', 'top-right');

    $("#email").focusout(function (e) {
        if (!isValidEmail($(this).val())) {
            $(this).addClass("formError");
        } else {
            $(this).removeClass("formError");
        }
    });

    $("#btnViewPasswd").on("click", function () {
        let icon = $(this).find("#iconPasswd:eq(0)");

        if ($("#passwd:eq(0)").is("[type='password']")) {
            $("#passwd:eq(0)").prop('type', 'text');
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $("#passwd:eq(0)").prop('type', 'password');
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

    $("#passwd").keypress(function () {
        $("#progress-bar").removeClass().addClass("progress-bar");
        let value = $(this).val();
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
    })

    $("#inputCep")
        .mask("00000000", { placeholder: "_ _ _ _ _ _ _ _", clearIfNotMatch: true })
        .keypress(evt => { if (evt.keyCode == 13) (evt.preventDefault(),$("#searchCep").trigger("click"));});

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

    $("input[data-required],select[data-required]").focusout(function () {
        if ($(this).is("#email")) return;
        $(this).removeClass("formError").removeClass("formValid");
        let className = ($(this).val().length == 0) ? "formError" : "formValid";
        $(this).addClass(className);
    });


    // <--- Functions Server --->

    $('#formUser').on("submit", function (e) {
        e.preventDefault();
        alertify.dismissAll()
        $("[data-required]").removeClass("formError");
        
        if (validaForm()) return alertify.error("Preencha os campos em vermelho!");
        if (!$("#termos").is(":checked")) return alertify.alert("<i class='fas fa-exclamation-triangle text-warning'></i> Aviso!", "Você precisa aceitar os termos para concluir o cadastro")
        $("#btnRegister").prop("disabled", true);

        const data = new FormData(this);
        option = {
            method: 'POST',
            mycustomtype: "application/json charset=utf-8",
            url: `${BASE_URL}/manager/addaccountpersonphysical`,
            dataType: "json",
            data,
            processData: false,
            contentType: false,
            complete: () => $("#btnRegister").prop("disabled", false),
            success: (res) => {
                if (!res.error) {
                    alertify.success('Cadastro realizado com sucesso');
                    clearForm();
                } else {
                    if (res.status == 0) alertify.error("Preencha todos os campos!");
                    if (res, status != 0) alertify.error("Não foi possível fazer o cadastro");
                }
            },
            error: (e) => alertify.error("Ocorreu um erro no servidor!")
        };
        reqAjax(option);

    });
})