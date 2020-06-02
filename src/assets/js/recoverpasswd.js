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

    let data = {
        option: $("#checkChave").val(),
        value: $("#recoverpwd").val(),
        name: $("#username").val()
    };

    option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/recoverpwd`,
        dataType: "json",
        data: data,
        success: (res) => {
            if (res) 
                if(!res.error) {
                    var token = '';
                    for (var i = 80; i > 0; --i) token += (Math.floor(Math.random()*256)).toString(16);
                    location.href = `${BASE_URL}/recuperarsenha/novasenha/${token}`
                }
            
        },
        error: (err) => {
            alertify.error("Ocorreu um erro no servidor");
        }
    }

    if($("#checkChave").val() == 0) if(!isValidEmail( $("#recoverpwd").val() )) return $("#recoverpwd").addClass("formError");
    
    if($("#username").val().length == 0) return $("#username").addClass("formError");
    if($("#recoverpwd").val().length == 0 ) return $("#recoverpwd").addClass("formError");
    
    $("#recoverpwd").removeClass("formError");
    reqAjax(option);

})