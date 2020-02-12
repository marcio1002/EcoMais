<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="../controller/add.php" method="POST">
        <p>Nome: <input type="text" name="name" /></p>
        <p>Email: <input type="email" name="email" /></p>
        <p>Senha: <input type="password" name="password" id='password' maxlength="8"/> <input type="button" value="Ver" id='btn'/></p>
        <input type="submit" value="Cadastra-se"/>
    </form>
    <script>
        const btn = document.querySelector("#btn");
        const inputPassword = document.querySelector("#password");

        btn.onclick = () => {
            if (inputPassword.type === "password") { 
                inputPassword.setAttribute("type", "text");
                btn.setAttribute("value","Ocultar");
            }else{
                inputPassword.setAttribute("type","password");
                btn.setAttribute("value","Ver");
            }
        }
    </script>
</body>
</html>