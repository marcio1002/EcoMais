alertify.set('notifier','position','top-center');

$("#inputPwd").keypress(function(evt) { if (evt.keyCode == 13) $('#btnLogar').click(); });

$("#value").keypress(function() {
    if(!isNaN(parseInt($("#value").val()))) {
        $("#value").mask("00.000.000/0000-00",{ placeholder: "00.000.000/0000-00", clearIfNotMatch: true, });
    }else {
        $("#value").unmask();
    }
})

$('#btnLogar').click( function()  {
    $(this).attr("disabled",true);
    const data = {
        value: $("#value").val(),
        passwd: $('#inputPwd').val(),
        conectedLogin: $('#manterConectado').is(":checked") ? 18 : 0
    };
    option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/login`,
        dataType: "json",
        data,
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
                console.info(res.data)
                if(res.data == 11)  location.href = `${BASE_URL}/user`;
                if(res.data == 10 ) location.href = `${BASE_URL}/empresa`
            }
        },
        error: (er) => {
            $(this).attr("disabled",false);
            alertify.error("Ocorreu um erro no servidor");
        }
    }
    
    if($("#value").val().length > 0 && $("#inputPwd").val().length > 0) 
        reqAjax(option);
    else  {
        $(this).attr("disabled",false);
        return alertify.warning("Preencha os campos!");
    }
})

$('#container-account-login a').click(function(e) {
    e.preventDefault();
    let conectedLogin = $('#manterConectado').is(":checked") ? 18 : 0;
    location.href = `${$(this).attr("href")}?conectedLogin=${conectedLogin}`;
});