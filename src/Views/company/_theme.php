<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/c38519eb78.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href=<?= renderUrl("src/assets/css/themes/themeCompany.css") ?>>
    <?= $this->section("css"); ?>
    <title><?= $title; ?></title>
</head>

<body>
    <div class="d-flex w-12">
        <!-- Menu -->
        <header>
            <nav class="layote-navbar nav sticky-top">
              
                <div class="navigation navbar navbar-light">
                    <!-- Logo -->
                    <p>Logo</p>
                    <ul class="navbar-nav d-flex flex-xl-column flex-grow-1  justify-content-center align-items-sm-center py-3 py-lg-0" role="tablist">
                      
                        <li class="nav-item pb-2">
                            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-create-chat" title="Create chat" role="tab">
                                <i class="far fa-chart-bar"></i>
                            </a>
                        </li>
                        <li class="nav-item pb-2">
                            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-friends" title="Friends" role="tab">
                                <i class="far fa-address-card"></i>
                            </a>
                        </li>
                        <li class="nav-item pb-2 d-xl-block">
                            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="" title="Demos" role="tab">
                                <i class="fas fa-shopping-basket"></i>
                            </a>
                        </li>
                        
                        <!-- Settings -->
                        <li class="nav-item mt-auto">
                            <a class="nav-link position-relative p-0 py-xl-3" href=<?= renderUrl("empresa/configuracoes") ?> title="Settings">
                                <i class="fas fa-cog"></i>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </nav>
        </header>
        <main>
            <?php
            if ($this->section("error")) :
                echo $this->section("error");
            ?>
                <? else: ?>
                <div class="d-flex flex-column container-header">
                    <div class="layote-header py-4 py-lg-6 px-lg-8 text-white sticky-top flex-grow">
                        <div class="header-title text-center">Title</div>
                    </div>
                    <div class="content">
                        <?= $this->section("content"); ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
    <?php
    echo $this->section("scripts");

    echo "<script>
                const BASE_URL = '" . BASE_URL . "';
            </script>";
    ?>
</body>

</html>