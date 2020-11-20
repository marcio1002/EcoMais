$(function () {
  $('.carousel').carousel({ keyboard: true });

  let option = {
    method: 'GET',
    mycustomtype: "application/json charset=utf-8",
    url: `${BASE_URL}/manager/listencompanypro`,
    dataType: "json",
    success: (res) => {
      let item = 0;
      let index = 1;
      
      if (res.data && typeof res.data == "object") {
        if (isMobile()) {
          res.data.forEach((val, index) => {
            $("#container-items").append(`
                <div class="carousel-item ${(index == 1) ? "active" : ''}">
                  <div class="row col-12 m-auto" data-index="${index}">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                      <div class="card shadow bg-dark border-secondary text-light w-100">
                        <img class="card-img-top img-fluid" style="max-height: 90%;" src="${val.imagem ? val.imagem : './src/assets/imgs/logo-atacado-default.jpg'}" alt="Imagem de capa do card">
                        <div class="card-body border-top">
                          <h5 class="card-title">${val.fantasia}</h5>
                          <a href="${BASE_URL}/user/listadeprodutos?id_company=${val.id_empresa}" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`);
          })

        } else {
          let cardsCompany = res.data.map(val => {
            return `
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card shadow bg-dark border-secondary text-light w-100">
                  <img class="card-img-top img-fluid" style="max-height: 100%; height: 20em" src="${val.imagem ? val.imagem : './src/assets/imgs/logo-atacado-default.jpg'}" alt="Imagem de capa do card">
                  <div class="card-body border-top">
                    <h5 class="card-title">${val.fantasia}</h5>
                    <a href="${BASE_URL}/user/listadeprodutos?id_company=${val.id_empresa}" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
                  </div>
                </div>
              </div>
            `
          })

          cardsCompany.forEach(val => {
            item += 1;
            if (item == 1)
              $("#container-items").append(`<div class="carousel-item ${(index == 1) ? "active" : ''}"><div class="row col-12 m-auto" data-index="${index}"></div></div>`);
            if (item <= 4) {
              $(`[data-index='${index}'`).append(val);
            } else {
              index += 1;
              item = 0;
            }
          })
        }
      }
    },
    error: (e) => {
      alertify.error("Ocorreu um erro no servidor!");
    }
  }

  reqAjax(option);
})