<?php
namespace Ecomais\Controllers;
use Ecomais\Models\DataException;

class ComponenteElement
{
  public static function navBar(): void
  {
    $urlRegister = BASE_URL . '/cadastro';
    $logo = BASE_URL . '/src/assets/imgs/ecomais-logo-sem-fundo.png';
    $index = BASE_URL;
    echo "
  <header>
  <div class='container' id='nav-container'>
    <!-- add essa class -->
    <nav class='navbar navbar-expand-lg fixed-top navbar-dark'>
      <a class='navbar-brand' href='$index' >
        <img id='logo' src='$logo' alt='ecom'>
      </a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbar-links'
        aria-controls='navbar-links' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse justify-content-end' id='navbar-links'>
        <div class='navbar-nav'>
          <a class='nav-item nav-link item-hover position-relative' id='home-menu' href='$index'>Home</span></a>
          <a class='nav-item nav-link item-hover position-relative' id='about-menu' href='$urlRegister' >Cadastre-se</a>
          <a class='nav-item nav-link item-hover position-relative' id='services-menu' href='#'>Serviços</a>
          <a class='nav-item nav-link item-hover position-relative' id='portfolio-menu' href='#'>Projetos</a>
          <a class='nav-item nav-link item-hover position-relative' id='contact-menu' data-toggle='modal' data-target='#modalLogin' href=''>Entrar</a>
        </div>
      </div> 

    </nav>
  </div>
</header>
<div class='subNavBar'>
</div>";
  }

  public static function modalLogin():void
  {
    $urlRegister =  BASE_URL . '/cadastro';
    $urlRecoverPasswd = BASE_URL . "/recuperarsenha";

    echo "<div class='modal fade' id='modalLogin' role='dialog' aria-labelledby='login' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Login</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <form>
            <div class='form-group col-md-12'>
              <label for='inputEmail3'>Email/CNPJ :</label>
              <input type='email' class='form-control' id='inputEmail'>
            </div>
            <div class='form-group col-md-12'>
              <label for='inputPassword3'>Senha :</label>
              <input type='password' class='form-control' id='inputPwd'>
            </div>
            <div class='form-check'>
              <input type='checkbox' class='form-check-input' id='manterConectado'>
              <label class='form-check-label ' for='dropdownCheck'>
                Mantenha-me conectado
              </label>
            </div>

            <div class='p-3 text-right'>
              <a  href='$urlRegister'> <button type='button' class='btn btn-link'> Cadastre-se </button></a>
              <a href='$urlRecoverPasswd'><button type='button' class='btn btn-link text-danger'>Esqueceu a Senha?</button></a><br>
            </div>
          </form>
          <div class='modal-footer'>
            <button type='button' class='btn btn-primary setLoad' id='btnLogar'>Entrar</button>
          </div>
        </div>
      </div>
    </div>
    </div>";
  }

  public function showImage()
  {
    try {
    } catch (DataException $ex) {
    }
  }
}
