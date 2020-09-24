<?php

namespace Ecomais\Views\Component;

class ComponentCompany {


  private static function thumbnailCompanyLogo(): string 
  {
    $logo = renderUrl("/src/assets/logos-icons/ecomais-logo.jpg");
return <<<thumbnail
    <div class="">
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
return <<<navbar
    <header class="h-auto navigation d-none d-lg-block d-xl-block">
            <nav class="company-navigation nav flex-column layout-navbar align-content-center navigation navbar bg-light position-fixed z-index-1000">
                $thumbnailCompanyLogo 
                <div class="py-5">
                    <a class="nav-link text-red-wine pointer text-red-wine py-4 font-size-1-4em" href="$dashboard" title="DashBoard">
                        <i class="far fa-chart-bar"></i>
                    </a>

                    <a class="nav-link text-red-wine pointer py-4 font-size-1-4em" href="$registerProduct" title="Cadastrar Produtos">
                        <i class="far fa-edit"></i>
                    </a>

                    <a class="nav-link text-red-wine pointer py-4 font-size-1-4em" href="$perfil" title="Perfil">
                        <i class="far fa-address-card"></i>
                    </a>
                </div>
                <div></div>
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
    <nav class="company-navigation nav nav-pills nav-fill fixed-bottom bg-light">
        <a class="nav-item pointer  nav-link py-4 text-red-wine" href="$dashboard" title="DashBoard" role="tab">
            <i class="far fa-chart-bar"></i>
        </a>

        <a class="nav-item pointer nav-link py-4 text-red-wine" href="$registerProduct" title="Cadastrar Produtos" role="tab">
            <i class="far fa-edit"></i>
        </a>

        <a class="nav-item  pointer nav-link py-4 text-red-wine" href="$perfil" title="Perfil" role="tab">
            <i class="far fa-address-card"></i>
        </a>
        <a class="nav-item pointer nav-link py-4 text-red-wine" href="$configuration" title="Configurações">
            <i class="fas fa-cog"></i>
        </a>
    </nav>
  </header>
navbarmobile;
  }

}