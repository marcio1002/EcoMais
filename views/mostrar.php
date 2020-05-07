<?php
require_once __DIR__ . "/../vendor/autoload.php";
$handling = new ControllersServices\AccountHandling();
$bundle = new  Web\Bundles();

if (!$handling->isLogged())  header("location: " . BASE_URL);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mostrar dados do banco</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <?php
  $bundle->bundleCSS([
    "css/materialize",
    "css/alertify",
    "css/style"
    ]);
  ?>
</head>

<body>
  <header>
    <nav>
      <div class="nav-wrapper blue">
        <ul>
          <a href=<?php echo BASE_URL."/manager/logoff";?> class="logoff right">Sair<i class='material-icons right'>input</i></a>
        </ul>
        <ul>
          <li><a href="#">Sass</a></li>
          <li><a href="#">Components</a></li>
          <li><a href="#">JavaScript</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <?php

  use Controllers\ComponenteElement as elem;

  elem::showRegistry();
  echo "<br/>";

  ?>
</body>

</html>