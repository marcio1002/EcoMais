$(function () {
  $('.carousel').carousel({ keyboard: true });

  let option = {
    method: 'GET',
    mycustomtype: "application/json charset=utf-8",
    url: `${BASE_URL}/manager/listencompanypro`,
    dataType: "json",
    success: (res) => {
      let item = 0;
      let index = 0;

      if (res.data && typeof res.data == "object") {
        res.data.forEach(val => {
          item += 1;
          index += 1;

          if (isMobile()) {
            $("#container-items").append(`
              <div class="carousel-item ${(index == 1) ? "active" : ''}">
                <div class="row col-12 m-auto" data-index="${index}">
                  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card shadow bg-dark border-secondary text-light w-100">
                      <img class="card-img-top img-fluid" style="max-height: 90%;" src="${val.imagem ? val.imagem : 'data:image/png;base64,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'}" alt="Imagem de capa do card">
                      <div class="card-body border-top">
                        <h5 class="card-title">${val.fantasia}</h5>
                        <a href="${BASE_URL}/usuario/listadeprodutos?id_company=${val.id_empresa}" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>`);

          } else {

            if (item == 1) {

              $("#container-items").append(`<div class="carousel-item ${(index == 1) ? "active" : ''}"><div class="row col-12 m-auto" data-index="${index}"></div></div>`);
            }
            if (item <= 4) {
              $(`[data-index='${index}'`).append(`   
                      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card shadow bg-dark border-secondary text-light w-100">
                          <img class="card-img-top img-fluid" style="max-height: 90%;" src="${val.imagem ? val.imagem : 'data:image/png;base64,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'}" alt="Imagem de capa do card">
                          <div class="card-body border-top">
                            <h5 class="card-title">${val.fantasia}</h5>
                            <a href="${BASE_URL}/usuario/listadeprodutos?id_company=${val.id_empresa}" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
                          </div>
                        </div>
                      </div>
                    `);
            } else {
              item = 0;
            }
          }
        });
      }
    },
    error: (e) => {
      alertify.error("Ocorreu um erro no servidor!");
    }
  }

  reqAjax(option);
})