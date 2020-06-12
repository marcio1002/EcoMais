<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <link rel="stylesheet" href=<?= renderUrl("src/assets/css/modalLogin.css");?> >
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>
    <title>Document</title>
</head>

<body>
    
    <div class='' id='modalLogin' role='dialog' aria-labelledby='login' aria-hidden='false'>
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
                            <label for='inputEmail3'>Email ou CNPJ :</label>
                            <input type='email' class='form-control border-bottom-solid-1px' id='inputEmail'>
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
                            <a href='$urlRegister'> <button type='button' class='btn btn-link'> Cadastre-se </button></a>
                            <a href='$urlRecoverPasswd'><button type='button' class='btn btn-link text-danger'>Esqueceu a Senha?</button></a><br>
                        </div>
                    </form>
                    <div class="col-12">
                        <div class="button-login text-center">
                            <button type='button' class='btn font-weigth-800 font-size-1-5em' id='btnLogar'>Entrar</button>
                        </div>
                    </div>

                    <div class="pt-3">
                        <div>
                            <a title='Entrar com facebook' href='$authUrl' style='padding: 11px;background: linear-gradient(to top left,#348ADA,#4097E7);color: #fff;border-radius: 50px;font-size: 1.5em; text-decoration:none;font-weight:800;font-family: arial;'><i class='fab fa-facebook' style='font-size: 25px;vertical-align: middle;'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>