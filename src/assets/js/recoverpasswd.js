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



$("#btnrRcoverPwd").click(() => {

    let data = {
        option: $("#checkChave").val(),
        value: $("#recoverpwd").val(),
    };

    option = {
        method: 'PUT',
        mycustomtype: "application/json",
        url: `${BASE_URL}/manager/recoverpwd`,
        dataType: "json",
        data: data,
        success: (res) => {
            if (typeof res == undefined || !res) throw new TypeError("Object null");
            console.log(res);
        },
        error: (err) => {
            alertify.error("OCorreu um erro no servidor");
        }
    }

    if($("#checkChave").val() == 0){
        if(!isValidEmail( $("#recoverpwd").val() )) return $("#recoverpwd").addClass("inputError");
    } 

    if($("#recoverpwd").val() == "") return $("#recoverpwd").addClass("inputError");
    
    $("#recoverpwd").removeClass("inputError");
    reqAjax(option);

})