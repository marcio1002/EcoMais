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
    $(".alert").removeClass("alert-success").removeClass("alert-danger");

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
        data,
        success: (res) => {
            if (res) 
                if(!res.error) {
                    if(res.token) return location.href = `${BASE_URL}/recuperarsenha/novasenha/${res.token}`;
                    $(".alert")
                        .addClass("alert-success")
                        .text("Enviado com sucesso! verifique seu e-mail")
                        .append(`<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>`);
                } else {
                    $(".alert")
                        .addClass("alert-danger")
                        .text("Verifique os dados!")
                        .append(`<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>`);;
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