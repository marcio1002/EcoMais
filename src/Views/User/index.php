<?
$this->layout("_theme", ["title" => "EcoMais - My Home"]);

$this->start("css");
$this->stop();
?>

<!-- Masthead -->
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Encontre os melhores descontos perto da sua casa</h1>
      </div>
      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <form>
          <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
              <div class="input-group">
                <input type="text" class="form-control form-control-lg">
                <div class="input-group-append">
                  <select name="category" id="category" class="custom-select border-left remove-focus" style="height: auto;">
                    <option value="" disabled selected>opção</option>
                    <option value="4">Região</option>
                    <option value="6">Produto</option>
                    <option value="6">Atacados</option>
                    <option value="6">Categoria</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <button type="button" class="btn btn-block btn-lg btn-primary">Pesquisar!</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>

<!-- Mostrar Atacados relevantes -->
<section class="text-center bg-light py-5">
  <div id="showCompany"  class="carousel slide">
    <div class="corousel-inner">
      <div  class="carousel-item active" >
        <div class="row col-12 m-auto" id="container-items">
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow" style="width: 100%;">
              <img class="card-img-top img-fluid" style="max-height: 90%;" src="data:image/png;base64,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" alt="Imagem de capa do card">
              <div class="card-body border-top">
                <h5 class="card-title">Título do card</h5>
                <a href="#" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow" style="width: 100%;">
              <img class="card-img-top img-fluid" style="max-height: 90%;" src="data:image/png;base64,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" alt="Imagem de capa do card">
              <div class="card-body border-top">
                <h5 class="card-title">Título do card</h5>
                <a href="#" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow" style="width: 100%;">
              <img class="card-img-top img-fluid" style="max-height: 90%;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABiVBMVEX////7+/v5+fn19fX/Zhjy8vLBCCTz8/Pv7+////3//v/s7Oz///n///v///fl5eXf39///vL/+/+lAADZ2dnkonrn5+fS0tK7AB//9vvjil3/8NyeAAD0XwP/9NubAAD+9OXocTStAA60ABbtXw353MWDAACPAADsYhPuxKL51bf/8PXtyqvwzNOrAAmoAACjAA7YYRzfkmfmZiH66NGiABb5yQD//b3is73XprDBaHTGYm/RlqGoAB7/5OqiKjmmIDPkeUPjgE3utZHvpHnvtpXmdz3ojFnfnHTthE3JnH7Lk2jep3Tow63Vfk/KhY+jRFHera3LiGL514n74oDiz8q8p6qukJage3/WqJbkr6v83M/WUAD+5o3xzDj/8p3zz0T9343Kbjnx11n//9TowXvfnai9kWX/4HRwAACuZ27k15DWkl3mwcr/7+fwrY2NQ1GWNEKJAB/dtZy7j22zS1j1dzbeZ3m5Q1X7vpCvJzm2GC64NUWtW2rVhpHHU2T4sL3ek575xc27gRwvAAAQBklEQVR4nO2b/X8aR5KHBxAvM7wOIDEjQIx4kRAjMC8jBRAM6AXJG6+FYmvfLms5u7GVnPaIV85yq7MlJ9FfvlXVA0aO7LvPxWBdrp8frKHnhf52VVdV92BB4HA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofzsbERn7oX0wK12Ylfp0iSR8rYwa9OI8qa/Gj/lUlEA44VifTvhyTSZLX/X5qxlgFFMaAZOcPQ/CBScryn/ywY0XT9gDOL4tR6+79gJFAu7G1XKpXlnV0N+ue026RbL55U9T6Nt935CbHZHfCvP75YS2a353d3stlFDTrvtd/S+Xfmq+CYcFbbW/OS8jsjk81B0dhPzmX3tEBAq85le6IgBe3vSqTuO/BiXwDwgaU9Dof9Jo6wDQfNfodiFTNhfHtubm5/CTotFrJziwFBCDmZgcZQ/91uHI3qAXBfA3f0viPQkiWKdygck9/5d/Og8EAG1/KPFHrdN+0zLnjEF/lkNpnMzgc+6Il3xYxgQlAoH4DAuR0ZGgLzyeS8XxCiHvv4Apsw0VdRNOb39vZ+M1cxbouYgXgupwXwzM/c/NPAFGr7qHDZQCetzVVycMLxwdv8orGcvA8j4pMn8fmMzx/89rcPPo/DGNkcd0KipXAHFaLfiQ8PFws+dm7CRCKg6rpZLNYbjVa/2Tz6opetFfzy/cUJHhm5R4+PgcePDMiqnjvhp6AQrOWfz6LE/JpP9MsyUybKxlqvV8DkGDCQ3/3+D3/84k/Avx21N1Ivv9xOLmrGn5MTVHMPnpycPH1y8tVfHsF9t2ecWQMKnRgel1HhXG09QK2iIPqNaiWfzdcOcn4xB5VA5a9xGIneMvD9dyYYU1/L59fk3vxb7uc+f3yy+fXSs682v3r+PThC8C4YERXaIMOt5ZnEHkYbiJG+HCTIueX5g+yh5l9DC+9oVkRK9n43GNRP+18eJLc1n6wtjdDi33y7ufn02bMnm5tPHsCDgndhJqJCD/wN9MhP5/IvyEmhAsDQkwsYlbwRqKKu+4HQ779EU9f+9O8rK6urq2eFfHbXrx0uj6jmvvl68+TZ3/722cnm8X9ogrDguSMKvU4su3eZFbMv0FHlRZqWfoiy2ZyMupLwQcjhMOzHwUcHEHG+20vW4jAEFtnDAig8Xnr2bOlbS6H3Dripze72OKhWlns1JrHgh5yRt/JjvFIz4vghDymEueuijFEVp2JuOTkv59ZGrMe/OT757LMnT549PfkLemnI++nd1GZzsMQH2UC2rLitiTL6ZRYiq7iW39HIcssQaHx7aMwXf/z7eeflaiq1+sWLbC3n92mGRbz3/PjpV5ubXz89fv4QqwbnJ1cI1aYDpx2kCNkPupIsZ4jxCv6Ni+LSdn6dTdFDsImMkzO7bhav66etfr/Zj+9nq7JcrVlUjUePIdZsnhw/fqBBURNzfDqFoxWP3SHhyqm3uLO4JotGhYxY9a2jpoOAP36Qn5cDOCeT8xD9yV1rhvWMMDhrL5svaH/NWvy5l3v0/Pjb4yfPH2FRE4JYOnuF1iphvF6ADvhz+yAoWXkoQk3K6tMX8De7Z/T2K7uyZbk18GRy1+0vG61W/6w5BFeFtJ/dWYoXRuRk7ft/PPjmHw9xo8AR+wROOrmjxpZ74KNxLNn2ezmoQgqUMraXqpQbK5VqDuo4AyNQDQKNbxdPV7+DOAo+enZ2NTxvFfL53fgNluJx2Y9fEfPO3kknd5xw2eSgig0D5L4BC1pJyFE4/c3SIVqt2jOwq/519M19DXImuesuu12Swiq4qbyYzS/fAHcIYNwcsSAKnKnCd7cg3A63Byq2wP0kxEdWrbGJeLCEVq0t+alADcyzFAHBlty1wO62ynJ/roZrRQtcN9KiyhaKLbhnbcKxwDAkMxV66ME9CAiQ98EwBeywJObQXNldplCjq32FGllOtNy1Ytx8rM9Yv0kOQpI3FvI43TNeA5NA0KHWh+VIuWOOT2B4Sa7jDqIgUkavGDJ6aR5sIQqBAtXkUJ75Wb5cXnrnwaI/oMkBP+DTNPiLYxXz0vDNXiBgDlOKy+Uqq+MzOM+SezKql3eobPMFKJZWtYAc363s/CfNzfVClSZpftfwTerDYgiWlODlgfXDnR5VtaGox+P8RAIH3dQ/QaFyQfMIgoWEy9/kXG1NBhPgjIMUbs3H7M7e3n6+usTqgGS28l8kERYbNxT6sSCo5ERYY8HJHsgPxbxej3u2CrF2QU31VLleT7tcmT64a6PfPP872NJv7GTn8jsv5rfBmJUX2H/fGomBsNGT/TkKP9mdHKt5sB6flEhFerbn9/eSVi0bWgCFTscspyEmBhzuQbncEPoZlytSF4RiKp1JN8PYSW2tul+D1cHy4a7BgmogV91e3l8kj/Th8U5PE0Vtfnt5e02++XDSnV0TR2U51jIex2h/bhbqMLM73PhVxW6pKYWPwEsTEGgaJZer1GIX+eV4DjC08RQT5bgRl+mjiMd0Bt9saL53vkCEFUb2QANvP8wml3O4Tzz+7ulrlEZvUfB79GGmqwtmV3Epr3RBOgNblorvue9nLeKo7ec7iD5jbV3D0kB72DNu6pdwMopT29+XJAn1SSLrltRMk3OWIdCAc6pDsOVr88OP+O9fIWGWCd9yU1gV2LBM04yQ31iVxvpZTyhb0JcGBJp0C7JGG5LG660zyPOCZELUaRWbW1tbfRrwcLE/vBi2TBglsH0d1knFPpy80iHd0FVwQbMFnwS9dblR7vbhUD/DE5SFzNbFRqKNjcKHX0X+UoWjMlSiFXlXaYNPknNGBsLgApPG5RVORL1fLpVSq21FUUpnqNBsJtLtZjPVgT6GG91IOpEqtzNKpg0nBwlFSW9tJTJKBK6Fqa1kXl2mhqpgpuDEVZjuSGc2Xm2k+tQN5/teRf5ySCAYqNi/aJfLbcX1+s3A1ME5lTY45ynYstTA68yjtCu9VT+9VKwWs5NRugNBuFgpCuF+RFE6p/UtHJAtONmCEXKl26/gMecqTurM0DQvU0WhDpErAwMmtRIupVM3Gx24G824MLW3xSzJS/2NTHr1Errfvni58nL4Gno61IVwE3q6gYFGvcq4MlsQerClDC36RcZVRqUtcNNWhA1InTm3EL4CqZmmWWy70mfqMONSunC2CTMcs1BpgEZmD5ZOW3rrD/CY6JQVwohm3pj6D4oyVPViv4sdBPdS0QhUnTYiLhf2UscWPOiXYAys6GFusOTJsij0X++wUKxerZ6bdRCTPgXZW4lB2IpcYTRrn7649MMKDmHMNqUlBnsjIZ0ryqUq1COuEnZ07JwmdE65CovUZeoRtRyFBR1E3WuwZ0ggTLmA6KFiFt0AnwPbUSiW1GKYROGYmO22ruOJc1Vo3HO5UjhgXXgMFhSe6LS2MkihKB1llFVTvYDJhGFu7Io0a1DYIMIacBCopQ5d3LCyiNllvkkHJHU02+jsBjosmLCZaglFvL0pCTjP0QP0LniNCXEgNrUtRXrnIgrFYacVht6nKbKpl9awo9el0aogmYmneVRnDSMnxdlH8jGLonOPr0JOQW25Lqj91abKstApDQWME9bA9+AcrEKnt+HG3kiAKFg/QGpIUflilpkrYguzFMw+tIPVAuHP8lrMGuSklxgP0bnTDQxLcFXbsvAbUPv6x0ZnBbMgOQdkIbBrgkZgEMF4Y4vhu+QpKbQ53E52WEyMzDJyRRWUutB0esrywzB0DY1pvmbRA8HAqVCKwyyahg6bGI4udNqOpGmorK40i1hUvGLS62UrRAutNPqKNwRr/enFUrfTQzvaTWXU6ZFzjmYNimdehwfYgqGkZCnUL9CeEjtQXkGHizgNz0CzWxBVDKuXdWZQilMwimhsZuNhZgh3BoNT3FKk10pBO016mk0wOX5grkgBg0yHgSZyLbClBrYUN8iGVOmhxdKo0MRACXULuwrPekEh1vDo4KIoUgTLvBGEnzJsnsMt8DRRiE7PSUmh24MrGfAc8izmiq6uymx5D02H0YIUvrFa0IbYVUAli2OEur5nRV5qgbRoC8JptOEWXSm10OshC1EhQTbsp/GPbbq7wiCRvLQ5CibMl7YkFhfSP6n66arCph3GQGpBI6AVJPX6vIwF0Ja1DoG6R71+ZYViTwjzvPUBCttVuBKCmfoGBgy+TFfr7RKOyEJoiiZkCu2sDEmzFD5yRRhh3I667K78hF1q/3Tafa2wlg3MJ8rrZrOTav9I8bV5etTGk5luB3exlCNVFIIhfBqO10X9+rSzSkXtq+th6rJNV16WM5SCYp6pbppa+QL9joU3ckXyySLtuJU6A2lIlXSqeT1qGdBBJhOByhmqUjhMdK8v8KpM+Z8ZK0BFQ/BgtQnDo5RSqU69SGuxVLdvNnHsXEqGKsJgdLq7wuxXCMKgzOIgcJ64F1mhw3o3ESn3seI6T8DSCdZy45Z6NxKJlIcNmLnqWaKUTkBpUhwmIolhsbUaiaTQHWJBnOB6vw2XXsJCEUsD5aJhSoJ+BbeUEk38FnvMOVUnHSmkQEMrU6l4fV0sSrQjoZtF6A9EO33QaJiYLK0WOijqKm4SwFK40SjiSRVOQrIsAjqsrGMLQey4pBehWa1foQlLP9K3wi0t9kABd/anu1PDFEL8V4b0+QObEh/arxB/dtYb9XoXrJ5L9ZedxrhEmsAWwzAz3VcXbB7qR+nMUJgU4Q2NXtF43daBNOqId/z2xh7yjg9vPhdKMWDBQxZvQNFGpQ7uCHjG+2xQkAbd0/VRgaoazBZmswPLGsERdDuIUCwYwp8eOoOxWCgI4dZmX4jFguMWOHB4gtFYNBjEXzXZPdFYaMHpcCx42P0LsaDTA9BAmV2YAcUNKwKF4MH4E1S7NxbzOqe/743pgs0sHfriiIaiRIgsAB9wc9objEZjsSgcBccteEBHeBWcDFqXB0f3O51OqAg9XozUqSaL0bQBEltYwLvxgc4ZCKSqxjl2ziAq89yG89bW9+G0XMHtJIWR9ukbqtp1DJ6jr4AxmMXLJxv7PRDT6MBXXvjNhNv5P+HWq9zWT5+hJrRRPVHCFJjCGhB81PoKumgGm/r4wsLtDcHU8oZiC2+H/5dh/dIBRg9n+aCbzmTSbfRRWwz1TVw0dYH0Us3hdHphcgTZd9s/AuzX0CiRIqfZap61TFwzR0PkmxMXzUQiTpi3zmX7KLBnw+C5aTMAd8YhGQVjbkqAE9fMRiL+5GIs7+M+Ghagb58YIoGz/6me9d8IPro+gc1y5wIrEWwLsegs0sPtHbFNyW/oxaQTAhklQK976jXa7KEZ4HR6vJQj3DN9rz0b2A/H3DNNgLPGCmQsAc4wgM6Q0f9Wm10CnD22qUUyDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOBwOh8PhcDgcDofD4XA4HA6Hw+FwOP9v+Behn2hJnleicwAAAABJRU5ErkJggg==" alt="Imagem de capa do card">
              <div class="card-body border-top">
                <h5 class="card-title">Título do card</h5>
                <a href="#" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow" style="width: 100%;">
              <img class="card-img-top img-fluid" style="max-height: 90%;" src="data:image/png;base64,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" alt="Imagem de capa do card">
              <div class="card-body border-top">
                <h5 class="card-title">Título do card</h5>
                <input type="hidden" value="">
                <a href="#" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a href="#showCompany" class="carousel-control-prev" role="button" data-slide="prev">
        <span aria-hidden="true"><img src="https://img.icons8.com/material/48/000000/circled-chevron-left--v1.png" /></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a href="#showCompany" class="carousel-control-next" role="button" data-slide="next">
        <span aria-hidden="true"><img src="https://img.icons8.com/material/48/000000/circled-chevron-right--v1.png" /></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div>

  </div>
</section>

<!-- Icons Grid -->
<section class="features-icons bg-light text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-screen-desktop m-auto text-primary"></i>
          </div>
          <h3>Fully Responsive</h3>
          <p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-layers m-auto text-primary"></i>
          </div>
          <h3>Bootstrap 4 Ready</h3>
          <p class="lead mb-0">Featuring the latest build of the new Bootstrap 4 framework!</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-check m-auto text-primary"></i>
          </div>
          <h3>Easy to Use</h3>
          <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->start("scripts");?>
<script>
  $('.carousel').carousel({  keyboard: true});

  let option = {
    method: 'GET',
        mycustomtype: "application/json charset=utf-8",
        url: `${BASE_URL}/manager/listencompanypro`,
        dataType: "json",
        success: (res) => {
          console.table(res);
          let item = 0;
            $("#container-items").append("<div class='carousel-item active' data-index='1'></div>");

            res.forEach(val => {
              item += 1;

                $("[data-index='1']").appendTo(`   
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                  <div class="card shadow" style="width: 100%;">
                    <img class="card-img-top img-fluid" style="max-height: 90%;" src="${res.imagem ? res.imagem : 'data:image/png;base64,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'}" alt="Imagem de capa do card">
                    <div class="card-body border-top">
                      <h5 class="card-title">${res.fantasia}</h5>
                      <input type="hidden" value="${res.id_empresa}">
                      <a href="#" class="btn btn-block font-weight-bold btn-primary">Visitar</a>
                    </div>
                  </div>
                </div>
                `);
            });
        },
        error: (e) =>  {
            alertify.error("Ocorreu um erro no servidor!");
        }
  }

  reqAjax(option);
</script>
<?php $this->stop();?>