$(function() {  
  $("[data-logoff]").click(function() {
    let option = {
        method: 'GET',
        mycustomtype: "application/json charset=utf-8",
        url: `${BASE_URL}/manager/logoff`,
        dataType: "json",
        success: (res) => {
            if (!res.error) location.href = `${BASE_URL}/login` 
        },
        error: (e) => alertify.error("Ocorreu um erro no servidor!")
    }
    reqAjax(option)
  })
})