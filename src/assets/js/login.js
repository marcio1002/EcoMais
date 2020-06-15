$('#btnLogar').click(() => {

    const person = {
        email: $("#inputEmail").val(),
        passwd: $('#inputPwd').val(),
        conectedLogin: $('#manterConectado').is(":checked") ? 18 : 0
    };
    option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/login`,
        dataType: "json",
        data: person,
        success: (res) => {
            console.table(res);
            if (typeof res == undefined || !res) throw new TypeError("Object null");
            if (res.error) {
                if (res.status == 400) {
                    $("#inputEmail").addClass("inputError");
                    $('#inputPwd').addClass("inputError");
                    alertify.error('Preencha todos os campos!');
                } else {
                    alertify.error('Email ou senha inválidos');
                }
            } else {
                // location.href = `${BASE_URL}/product/`;
            }
        }
    }
    
    if($("#inputEmail").val().length > 0 && $("#inputPwd").val().length > 0) 
        reqAjax(option);
    else 
        return alertify.error("Preencha os campos!");
})