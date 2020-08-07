$("#checkChave").change(function () {
    if ($(this).is(":checked")) {
        $("#recover-label").html("Cole a chave de acesso aqui");
        $(this).attr("value", "1");
    }
    else {
        $("#recover-label").html("Digite o email:");
        $(this).attr("value", "0");
    }
});

$("#recoverpwd").keypress(function(e) {
    let key = e.keycode? e.keycode : e.charCode;
    if(key == 13) {
        e.preventDefault();
        $("#btnEnviPwd").click();
    }
})

$("#btnEnviPwd").click(() => {

    $("input").removeClass("formError");

    if($("#username").val().length == 0) return $("#username").addClass("formError");
    if($("#recoverpwd").val().length == 0 ) return $("#recoverpwd").addClass("formError");

    if($("#checkChave").val() == 0) 
        if(!isValidEmail( $("#recoverpwd").val() )) return $("#recoverpwd").addClass("formError");
    

    let func = ($("#checkChave").val() == 0) ? "recoverByMail" : "recoverByKey";

    let data = { value: $("#recoverpwd").val(), name: $("#username").val() };

    option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/${func}`,
        dataType: "json",
        data,
        beforeSend: () => $(this).prop("disabled",true),
        complete: () => $(this).prop("disabled",false),
        success: res => {
            if(res.error) $("#alert").addClass("alert-danger").text("Verifique os dados!");

            if(res.token) return location.href = `${BASE_URL}/recuperarsenha/novasenha/${res.token}`;
                
            $("#alert").addClass("alert-success").text("Enviado com sucesso! verifique seu e-mail");
        },
        error: err => alertify.error("Ocorreu um erro no servidor!")
    }

    reqAjax(option);

})