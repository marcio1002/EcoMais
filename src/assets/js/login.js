alertify.set('notifier','position','top-center');

$("#inputPwd").keypress(function(evt) { if (evt.keyCode == 13) $('#btnLogar').click(); });

$('#btnLogar').click( function()  {
    $(this).attr("disabled",true);
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
            if (typeof res == undefined || !res) throw new TypeError("Object null");
            if (res.error) {
                if (res.status == 400) {
                    $("#inputEmail").addClass("inputError");
                    $('#inputPwd').addClass("inputError");
                    alertify.error('Preencha todos os campos!');
                } else {
                    alertify.error('Email ou senha inválidos');
                }
                $(this).attr("disabled",false);
            } else {
                // location.href = `${BASE_URL}/product/`;
            }
        },
        error: (er) => {
            $(this).attr("disabled",false);
            alertify.error("Ocorreu um erro no servidor");
        }
    }
    
    if($("#inputEmail").val().length > 0 && $("#inputPwd").val().length > 0) 
        reqAjax(option);
    else  {
        $(this).attr("disabled",false);
        return alertify.warning("Preencha os campos!");
    }
})

$('#container-account-login a').click(function(e) {
    e.preventDefault();
    let conectedLogin = $('#manterConectado').is(":checked") ? 18 : 0;
    window.open(`${$(this).attr("href")}?conectedLogin=${conectedLogin}` ,'janela','width=600, height=600, top=100, left=400, scrollbars=no, status=no, toolbar=no, location=no, menubar=no, resizable=no, fullscreen=no');
});