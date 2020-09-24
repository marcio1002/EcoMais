$("#btnEnv").click(function() {
  option = {
      method: 'POST',
      mycustomtype: "application/json",
      url: `${BASE_URL}/manager/newsletter`,
      dataType: "json",
      data: { newsletter: $("#emailNewsLetter").val().trim() },
      success: (response) => {
          if (response.res) {
            $("#emailNewsLetter").val("");
            alertify.success("Obrigado! <br/>Agora você recebera nossa newsletter").delay(5);
          }
      },
  }

  if ($("#emailNewsLetter").val().length > 0) reqAjax(option)
})