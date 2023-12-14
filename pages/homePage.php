<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Olímpiada do Conhecimento | CEFET-MG</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/937e8004d1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sobre.css">
    <link rel="stylesheet" href="../assets/css/homePage.css">

</head>

<body>
    <?php

    require_once '../services/Equipe.php';

    // Resgatar o objeto Admin da sessão
    session_start();
    $equipe = $_SESSION["equipe"] ?? null;

    if ($equipe === null) {
        echo "<script>alert('Você não está logado!')</script>";
        header("Location: login.html"); // Redireciona para a página de login
        exit(); // Encerra o script para garantir o redirecionamento correto
    }

    // Verificar se o objeto Admin está presente na sessão

    // Exibir as informações do Admin na página

    ?>
    <!-- Carregando -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <header>
        <!-- Cabeçalho -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="../index.html"><img src="../assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="homePage.php">Início</a></li>
                                                <li class="button-header"><a href="login.html" class="btn btn3">Sair</a></li>
                                                <li class="button-header"><a href="minhaEquipe.php" class="btn btn3"><?php echo $equipe->getNome(); ?></a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br><br>
    <main>
        <div class="bg-light">
            <div class="container py-5">
                <div class="row h-100 align-items-center py-5">
                    <div class="col-lg-6">
                        <h1 class="display-4">Última notícia:</h1>
                        <p class="lead text-muted mb-0">A Olimpíada está chegando!! <a href="#" class="text-muted">
                                <u>Saiba mais.</u></a></p>
                        </p>
                    </div>

                </div>
            </div>
        </div>



        <div class="bg-light py-5">
            <div class="container py-5">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-4 font-weight-light">Olimpíadas:</h2>
                        <p class="font-italic text-muted">Essas são todas as olimpíadas para qual sua equipe está cadastrada.</p>
                    </div>
                </div>

                <div class="row text-center">
                    <!-- Team item-->
                    <?php
                    require_once '../services/negocioException.php';
                    require_once '../services/SimuladoDAO.php';

                    $olimpiadas = SimuladoDAO::listarSimulados();
                    $currentDateTime = new DateTime();

                    foreach ($olimpiadas as $olimpiada) :
                        $dataInicio = DateTime::createFromFormat('d/m/Y - H:i', $olimpiada->getDataInicio());
                        $dataTermino = DateTime::createFromFormat('d/m/Y - H:i', $olimpiada->getDataTermino());

                        // Verificar se a data de início já começou e a data de término ainda é válida
                        if ($currentDateTime >= $dataInicio && $currentDateTime <= $dataTermino) :
                    ?>
                            <div class="rounded shadow-sm py-5 px-4 cardOlimps actveOlimps" >
                                <img src="https://cdn.discordapp.com/attachments/871728576972615680/1184862694478725191/favicon.png?ex=658d8460&is=657b0f60&hm=48fb0df56b917e6fb5b47e2a3f142c46c86057f26c729c4d9b558964ae165115&" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                                <h5 class="mb-0"><?php echo $olimpiada->getTitulo(); ?></h5>
                                <span class="small text-uppercase text-muted"><?php echo $olimpiada->getDataInicio(); ?></span>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-hand-pointer"></i></a></li>
                                </ul>
                            </div>
                        <?php
                        else : ?>
                            <div class="rounded shadow-sm py-5 px-4 cardOlimps inative">
                                <img src="https://cdn.discordapp.com/attachments/871728576972615680/1184862694478725191/favicon.png?ex=658d8460&is=657b0f60&hm=48fb0df56b917e6fb5b47e2a3f142c46c86057f26c729c4d9b558964ae165115&" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                                <h5 class="mb-0"><?php echo $olimpiada->getTitulo(); ?></h5>
                                <span class="small text-uppercase text-muted"><?php echo $olimpiada->getDataInicio(); ?></span>
                                <ul class="social mb-0 list-inline mt-3">
                                    <li class="list-inline-item"><a href="#" class="social-link inativeLive"><i class="fa fa-lock"></i></a></li>
                                </ul>
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>

                </div>
            </div>
        </div>
        </div>
    </main>
    <footer>
        <div class="footer-wrappper footer-bg">
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p>
                                        Olimpíadas do Conhecimento | CEFET-MG</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="back-top">
        <a title="Ir para o tipo" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2010.07.06dev/modernizr.min.js" integrity="sha512-HyO6DE8TAYakYahq831kmrY5Z/6HjP5wucRRPZ9XKDZhjyw5QroAPpvLRRhTSsfFh04OuEYKdcWeqKFTJCvB7g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>