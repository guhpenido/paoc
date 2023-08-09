<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ADMIN | CEFET-MG</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/937e8004d1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body id="body-pd">
    <?php

    require_once '../services/Admin.php';

    // Resgatar o objeto Admin da sessão
    session_start();
    $admin = $_SESSION["admin"] ?? null;

    if ($admin === null) {
        echo "<script>alert('Você não está logado!')</script>";
        header("Location: loginAdmin.html"); // Redireciona para a página de login
        exit(); // Encerra o script para garantir o redirecionamento correto
    }

    // Verificar se o objeto Admin está presente na sessão

    // Exibir as informações do Admin na página

    ?>
    <header class="header" id="header">
        <div class="header_toggle"> <i class="fas fa-solid fa-bars" id="header-toggle"></i></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <?php
            if ($admin->getPermissao() === "2") {
                echo '
        <div> <a href="#" class="nav_logo"> <i class="fas fa-solid fa-lock  nav_logo-icon"></i> <span class="nav_logo-name">Administrador</span> </a>
            <div class="nav_list"> <a href="dashboard.php" class="nav_link active"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span>
                </a> <a href="dashAdmins.php" class="nav_link"> <i class="fas fa-solid fa-user nav_icon"></i> <span class="nav_name">Administradores</span>
                </a> <a href="dashEqui.php" class="nav_link"> <i class="fas fa-solid fa-users nav_icon"></i> <span class="nav_name">Equipes</span>
                </a> <a href="questoes.php" class="nav_link"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span>
                </a> <a href="comunicacao.php" class="nav_link"><i class="fas fa-solid fa-pager nav_icon"></i> <span class=" nav_name">Comunicação</span>
            </div>
        </div> <a href="../index.html" class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>';
            } else if ($admin->getPermissao() === "1") {
                echo '
        <div> <a href="#" class="nav_logo"> <i class="fas fa-solid fa-lock  nav_logo-icon"></i> <span class="nav_logo-name">Administrador</span> </a>
        <div class="nav_list"> <a href="dashboard.php" class="nav_link active"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span></a>
        </div>
        <a href="questoes.php" class="nav_link"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span></a>
        </div> <a href="../index.html" class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>';
         
            }
            ?>
        </nav>

    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h4>Bem vindo a página de administradores!</h4>
        <h5>Você está logado como: <?php echo $admin->getNome(); ?></h5>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2010.07.06dev/modernizr.min.js" integrity="sha512-HyO6DE8TAYakYahq831kmrY5Z/6HjP5wucRRPZ9XKDZhjyw5QroAPpvLRRhTSsfFh04OuEYKdcWeqKFTJCvB7g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <?php

    ?>

</body>

</html>