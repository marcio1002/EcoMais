/**Globais */
let forca = 0;

$("#newPasswd").keypress(function() {
    $("#progress-bar").removeClass().addClass("progress-bar");
    let value = $(this).val();
    forca = 5;
    if (value.length < 8 ) {
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


$("#newPasswdVerify").keypress(function(e) {
    let key = e.keycode? e.keycode : e.charCode;
    if(key == 13) {
        e.preventDefault();
        $("#btnRecoverPwd").click();
    }
});

$("#btnViewPasswd").on("click", function () {
    let icon = $(this).find("#iconPasswd:eq(0)");

    if ($("#newPasswd:eq(0)").is("[type='password']")) {
        $("#newPasswd:eq(0)").prop('type', 'text');
        icon.removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
        $("#newPasswd:eq(0)").prop('type', 'password');
        icon.removeClass("fa-eye").addClass("fa-eye-slash");
    }
});

$("input").focusout(function() {
    if($(this).val().length > 0) 
        $(this).removeClass("formError")
    else
        $(this).addClass("formError")
})

$("#btnRecoverPwd").click(function() {

    $(".alert").removeClass("alert-success alert-danger").text("");

    if($("#newPasswd").val().length == 0) return $("#newPasswd").addClass("formError");

    if($("#newPasswdVerify").val().length == 0) return $("#newPasswdVerify").addClass("formError");

    if($("#newPasswd").val() !== $("#newPasswdVerify").val()) return alertify.error("As senhas não coincidem");

    if(forca <= 27) return alertify.error("Digite uma senha forte");

    const data = {
        passwd: $("#newPasswd").val(),
        value: $("#value").val() 
    }

    const option = {
        method: 'PUT',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/recoverpasswd`,
        dataType: "json",
        data,
        success: (res) => {
            if (res) 
                if(!res.error) {
                    if(res.token) return location.href = `${BASE_URL}/recuperarsenha/novasenha/${res.token}`;
                    $(".alert").addClass("alert-success").text("Senha atualizada com sucesso");
                } else {
                    $(".alert").addClass("alert-danger").text("Não foi possível atualizar a senha!");
                } 
        },
        error: (err) => {
            alertify.error("Ocorreu um erro no servidor!");
        }
    }
    reqAjax(option);
});