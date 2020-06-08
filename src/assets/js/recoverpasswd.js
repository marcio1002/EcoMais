$("#checkChave").change(function () {
    if ($(this).is(":checked")) {
        $("#recover-label").html("Cole a chave de acesso aqui");
        $(this).attr("value", "1");
    }
    else {
        $("#recover-label").html("Digite o email:");
        $(this).attr("value", "0");
    }
})



$("#btnRecoverPwd").click(() => {

    $("input").removeClass("formError");
    $("").removeClass("alert-success").removeClass("alert-danger");

    let func = ($("#checkChave").val() == 0) ? "recoverByMail" : "recoverByKey";

    let data = {
        value: $("#recoverpwd").val(),
        name: $("#username").val()
    };

    option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/${func}`,
        dataType: "json",
        data: data,
        success: (res) => {
            console.table(res);
            if (res) 
                if(!res.error) {
                    if(res.token) return location.href = `${BASE_URL}/recuperarsenha/novasenha/t=${res.token}`;
                    $(".alert").addClass("alert-success").text("Enviado com sucesso! verifique seu e-mail");
                } else {
                    $(".alert").addClass("alert-danger").text("Verifique os dados!");
                }
            
        },
        error: (err) => {
            
            alertify.error("Ocorreu um erro no servidor!");
        }
    }

    if($("#checkChave").val() == 0) if(!isValidEmail( $("#recoverpwd").val() )) return $("#recoverpwd").addClass("formError");
    
    if($("#username").val().length == 0) return $("#username").addClass("formError");
    if($("#recoverpwd").val().length == 0 ) return $("#recoverpwd").addClass("formError");
    
    $("#recoverpwd").removeClass("formError");
    reqAjax(option);

})