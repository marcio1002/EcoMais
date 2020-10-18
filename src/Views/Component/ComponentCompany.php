<?php

namespace Ecomais\Views\Component;

class ComponentCompany {


  private static function thumbnailCompanyLogo(): string 
  {
    $logo = renderUrl("/src/assets/logos-icons/ecomais-logo.jpg");
return <<<thumbnail
    <div class="flex-grow-1">
      <img src="$logo" alt="logo Ecomais" class="img-fluid">
    </div> 
thumbnail;
  }

  public static function navbar(): string
  {
    $thumbnailCompanyLogo =  static::thumbnailCompanyLogo();
    $dashboard = renderUrl("/empresa");
    $registerProduct =  renderUrl("/empresa/cadastro-de-produtos");
    $perfil = renderUrl("/empresa/perfil");
    $configuration = renderUrl("/empresa/configuracoes");
return <<<navbar
    <header class="h-auto navigation d-none d-lg-block d-xl-block">
            <nav class="company-navigation bg-blue-dark-1 d-flex layout-navbar align-items-center justify-content-around navbar navigation position-fixed z-index-1000">
                $thumbnailCompanyLogo 
                <div>
                    <a class="nav-link nav-hover text-center text-white p-2 mb-4 font-size-1-4em" href="$dashboard" title="DashBoard">
                      <i class="far fa-chart-bar text-weight-800"></i>
                    </a>

                    <a class="nav-link nav-hover text-center text-white p-2 mb-4 font-size-1-4em" href="$registerProduct" title="Cadastro Produtos">
                      <i class="far fa-edit text-weight-800"></i>
                    </a>

                    <a class="nav-link nav-hover text-center text-white p-2 mb-4 font-size-1-4em" href="$perfil" title="Perfil">
                      <i class="far fa-address-card text-weight-800"></i>
                    </a>
                    
                    <a class="nav-link nav-hover text-center text-white p-2 mb-4 font-size-1-4em" href="$configuration" title="Configurações">
                      <i class="fas fa-cogs mr-2 text-weight-800"></i>
                    </a>
                </div>
                <div>
                  <a data-logoff="" class="nav-link p-2 d-inline-flex align-items-center text-white remove-focus pointer text-weight-800" title="Sair">
                    Sair <i class="fas fa-sign-out-alt ml-1 text-light"></i>
                  </a>
                </div>
            </nav>
        </header>
navbar;
  }


  public static  function navBarMobile(): string
  {
    $dashboard = renderUrl("/empresa");
    $registerProduct =  renderUrl("/empresa/cadastro-de-produtos");
    $perfil = renderUrl("/empresa/perfil");
    $configuration = renderUrl("/empresa/configuracoes");

return <<<navbarmobile
  <header class="d-block d-xl-none d-lg-none">
    <nav class="company-navigation nav nav-pills nav-fill fixed-bottom bg-blue-dark-1 shadow-top">
        <a class="nav-item  nav-link py-3 text-light" href="$dashboard" title="DashBoard" role="tab">
            <i class="far fa-chart-bar"></i>
        </a>

        <a class="nav-item nav-link py-3 text-light" href="$registerProduct" title="Cadastrar Produtos" role="tab">
            <i class="far fa-edit"></i>
        </a>

        <a class="nav-item  nav-link py-3 text-light" href="$perfil" title="Perfil" role="tab">
            <i class="far fa-address-card"></i>
        </a>
        <a class="nav-item nav-link py-3 text-light" href="$configuration" title="Configurações">
            <i class="fas fa-cog"></i>
        </a>
    </nav>
  </header>
navbarmobile;
  }

}