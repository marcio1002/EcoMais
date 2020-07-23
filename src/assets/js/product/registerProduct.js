$("#registerProduct").click(function() {
  if(!validaForm("#formProduct")) return alertify.error("Preencha os campos em vermelho");
  const data = {
    name: $("#nome").val(),
    price: $("price").val(),
    brand: $("#brand").val(),
    description: $("description").val(),
    quantity: $("#quantity").val(),
    date_start: $("#date_start").val(),
    date_end: $("#date_end").val(),
    classification: $("#classification").val()
  }
  
  const option = {
    method: 'POST',
    mycustomtype: "application/json",
    url: `${BASE_URL}/manager/addproduct`,
    dataType: "json",
    data,
    success: (res) => {
      if(res && !res.error) {
        alertify.success("Produto cadastrado!");
      }else {
        alertify.error("Não foi possível cadastrar esse produto");
      }
    }
  }
});