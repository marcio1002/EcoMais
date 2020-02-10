<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste da api</title>
</head>
<body>
    <form action='setdatabase.php' method="POST">
        <p>Nome: <input type="text" name='name'/> </p>
        <p>Email: <input type="email" name='email'/> </p>
        <p>Password: <input type="password" name="password" id="password"/><input type="button" value="Show" id="show"/></p>
        <input type="submit" value="Cadastrar" />
    </form>
    <script>
        const password = document.querySelector("#password");
        const btn = document.querySelector("#show");
         
        btn.onclick = () => {
            if(password.type == "password"){
                password.setAttribute("type","text");
            }else {
                password.setAttribute("type","password");
            }
        }

    </script>
</body>
</html>