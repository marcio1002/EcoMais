$(function () {

  $("#date_start").val(datetime.dateNow().split("/").reverse().join("-"));
  $("#time_start").val(datetime.timeNow().substr(0, 5));

  $("#price").keypress(function (e) {
    if ($(this).val().length > 10) return false;
    if (isNaN(Number(e.key)) && e.key != ",") return false;
  });


  $("#formProduct").on("submit", function (e) {
    e.preventDefault();
    if (validaForm("#formProduct")) return alertify.error("Preencha os campos em vermelho");

    const data = new FormData(this);

    const options = {
      method: 'POST',
      mycustomtype: "application/json",
      url: `${BASE_URL}/manager/addproduct`,
      dataType: "json",
      data,
      processData: false,
      contentType: false,
      success: (res) => {
        if (res && !res.error) {
          alertify.success("Produto cadastrado!");
        } else {
          alertify.error("Não foi possível cadastrar esse produto");
        }
      },
      error: () => alertify.error("Erro no servidor tente novamente!")
    }
    reqAjax(options);
  });
})