let forca = 0;
alertify.set('notifier','position', 'top-right');

$("#inputCep").mask("00000000", { placeholder: "_ _ _ _ _ _ _ _", clearIfNotMatch: true });


$("#searchCep").on("click", async function () {
    try {
        alertify.set('notifier','position', 'top-right');
        const res = await searchCep($("#inputCep").val())
        if (res !== null) {
            $("#uf").val(res.uf);
            $("#inputAddres").val(`${res.bairro}, ${res.logradouro}`);
            $("#locality").val(res.localidade);
        } else {
           return alertify.error("Não foi possível buscar o cep informado!")
        }
    } catch (e) {
       return alertify.error('Cep inválido');
    }
});

$("#inputCep").keyup(function (evt) { if (evt.keyCode == 13) $("#searchCep").trigger("click") });



$("#passwd").keypress(function() {
    $("#progress-bar").removeClass().addClass("progress-bar");
    let value = $(this).val();
    forca = 5;
    if (value.length < 5 ) {
        if(/[A-Z]+/.test(value)  &&  /[a-z]+/.test(value) ) forca = 13;
        if( /[\d]+/.test(value) && /[a-z]+/.test(value)) forca = 23
        if(/[A-Z]+/.test(value) && /[a-z]+/.test(value) && /[\d]+/.test(value)) forca = 32;
        if(/[a-z]+/.test(value) && /[\d]+/.test(value) && /[@!#$%&*/\\]+/.test(value) ) forca = 40

    }else {
        if ( /[A-Z]+/.test(value)  &&  /[a-z]+/.test(value)) forca = 32;
        if(/[\d]+/.test(value) &&  /[a-z]+/.test(value)) forca = 42

        if ( /[a-z]+/.test(value) && /[\d]+/.test(value) && /[A-Z]+/.test(value)) forca = 55;

        if (/[a-z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[A-Z]+/.test(value) )  forca = 75;
        if(/[a-z]+/.test(value) && /[A-Z]+/.test(value) && /[@!#$%&*/\\]+/.test(value) && /[\d]+/.test(value)) forca = 100;
    }

    if (forca < 30)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-danger");
    else if (forca > 30 && forca <= 68)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-warning");
    else if (forca > 70)
        $("#progress-bar").css("width", `${forca}%`).addClass("bg-success");
})

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

$("#mesAnoValidade").mask("00/0000",{placeholder:"__/____", clearIfNotMatch: true});
$("#cvvCartao").mask("000",{placeholder:"___", clearIfNotMatch: true});
$("#numCartao").mask("0000 0000 0000 0000",{placeholder:"___ ___ ___ ___", clearIfNotMatch: true});