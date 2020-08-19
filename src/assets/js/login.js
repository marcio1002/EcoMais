alertify.set('notifier','position','top-center')

$("#inputPwd").keypress(function(evt) { if (evt.keyCode == 13) $('#btnLogar').click() })

$("#value").keypress(function() {
    if(!isNaN(parseInt($(this).val()))) {
        $(this).mask("00.000.000/0000-00",{ placeholder: "00.000.000/0000-00", clearIfNotMatch: true, })
    }else {
        $(this).unmask()
    }
})

$('#btnLogar').click( function()  {
    $(this).attr("disabled",true)
    const data = {
        value: $("#value").val(),
        passwd: $('#inputPwd').val(),
        conectedLogin: $('#manterConectado').is(":checked") ? 18 : 0
    }
    const option = {
        method: 'POST',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/login`,
        dataType: "json",
        data,
        complete: e => $(this).attr("disabled",false),
        success: (res) => {
            if (res.error) {
                if (res.status == 400) {
                    $("#inputEmail").addClass("formError")
                    $('#inputPwd').addClass("formError")
                    alertify.error('Preencha todos os campos!')
                } else {
                    alertify.error('Email ou senha inválidos')
                }

            } else {
                if(res.data == 11)  location.href = `${BASE_URL}/user`
                if(res.data == 10 ) location.href = `${BASE_URL}/empresa`
            }
        },
        error: err => alertify.error("Ocorreu um erro no servidor")
    }
    
    if($("#value").val().length > 0 && $("#inputPwd").val().length > 0) 
        reqAjax(option)
    else  {
        $(this).attr("disabled",false)
        return alertify.warning("Preencha os campos!")
    }
})

$('#container-account-login').click(function(e) {
    e.preventDefault()
    let conectedLogin = $('#manterConectado').is(":checked") ? 18 : 0
    location.replace(`${$("#btnLoginGoogle").prop("href")}?conectedLogin=${conectedLogin}`)
})