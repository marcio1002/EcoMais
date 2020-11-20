$(function () {
    alertify.set('notifier', 'position', 'top-center')


    $("#inputPwd").keypress(function (evt) { 
        if (evt.keyCode == 13) {
            evt.preventDefault()
            $('#btnLogar').trigger("click")
        } 
    })

    $("#user").keypress(function () {
        if (!isNaN(parseInt($(this).val())))
            $(this).mask("00.000.000/0000-00", { placeholder: "00.000.000/0000-00", clearIfNotMatch: true, })
        else
            $(this).unmask()
    })

    $('#btnLogar').click(function () {
        alertify.dismissAll()
        $(this).attr("disabled", true)

        if ($("#user").val().length == 0 && $("#inputPwd").val().length == 0) {
            $(this).attr("disabled", false)
            return alertify.warning("Preencha os campos!")
        }

        const data = {
            value: $("#user").val(),
            passwd: $('#inputPwd').val(),
            conectedLogin: $('#manterConectado').is(":checked") ? 18 : 0
        }
        const options = {
            method: 'POST',
            mycustomtype: "application/json",
            url: `${BASE_URL}/manager/login`,
            dataType: "json",
            data,
            complete: e => $(this).attr("disabled", false),
            success: (res) => {
                if (res.error) {
                    if (res.status == 400) {
                        $("#inputEmail").addClass("formError")
                        $('#inputPwd').addClass("formError")
                        alertify.warning('Preencha todos os campos!')
                    } else {
                        alertify.error('Email ou senha inválidos')
                    }

                } else {
                    if (res.data == 11) location.href = `${BASE_URL}/user`
                    if (res.data == 10) location.href = `${BASE_URL}/company`
                }
            },
            error: err => alertify.error("Erro no servidor")
        }

        reqAjax(options)
    })

    $('#container-account-login').click(function (e) {
        e.preventDefault()
        let connectedLogin = $('#manterConectado').is(":checked") ? 18 : 0
        location.replace(`${$(this).find("a").prop("href")}?connectedLogin=${connectedLogin}`)
    })

})