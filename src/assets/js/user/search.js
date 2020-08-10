$(function(){
  alertify.set('notifier','position','top-right');

  $("#btnSearch").click((e) => {
    if($("#option").val() == null || $("#search").val().length == 0) return;

    let data = {};
    let search = Number($("#option").val());
    let url = "";
    switch(search) {
      case 4:
        data.uf = $("#search").val();
        data.locality = $("#search").val();
        url = "searchcompany";
        break;
      case 5:
        data.name = $("#search").val();
        url = "searchproduct";
        break;
      case 6:
        data.fantasy = $("#search").val();
        url = "searchcompany";
        break;
      case 7:
        data.classification = $("#search").val();
        url = "searchproduct";
        break;
    }  
  
    const options = {
      method: 'POST',
      mycustomtype: "application/json",
      url: `${BASE_URL}/manager/${url}`,
      dataType: "json",
      data,
      success: (res) => {
          if(res.error) return alertify.alert("Informação","Nenhum resultado");
          console.dir(res.data);
      },
      error: err => alertify.error("Ocorreu um erro no servidor")
    }
    reqAjax(options);
  })
})