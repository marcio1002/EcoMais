<?php require_once "../controller/connection.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mostrar dados do banco</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 70%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      width: 70%;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <?php
  

  try {
    $result = $account->showRegistry("usuarios", [], "id_usuarios = 2", 1);

    echo "<table >
            <tr>
                <th>Nome<th>
                <th>Email</th>
                <th>Senha</th>
            </tr>";
    while ($array_result = mysqli_fetch_array($result)) {
      echo "
            <tr>
                <td>$array_result[nome]</td>
                <td>$array_result[email]</td>
                <td>$array_result[password]</td>
            </tr>
            ";
    }
    echo "</table>";

    $account->connectionClose();
  } catch (Exception $error) {

    echo "Erro:" . $error->getMessage();
  }
  ?>
</body>

</html>