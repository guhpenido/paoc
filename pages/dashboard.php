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
        <h5>Você está logado como: <?php echo $admin->getNome(); ?></h5><br>
        <button type="button" class="btn btn-primary" id="abrirCriarSimulado">Criar olimpíada!</button>
        <br>
        <br>
        <h1>Olimpíadas criadas:</h1>
        <div class="simulados">
            <?php
            require_once '../services/negocioException.php';
            require_once '../services/SimuladoDAO.php';
            $olimpiadas = SimuladoDAO::listarSimulados();
            foreach ($olimpiadas as $olimpiada) : ?>
                <div class="card" onclick="abreOlimpiada(<?php echo $olimpiada->getId(); ?>)">
                    <div class="img"><img src="https://cdn.discordapp.com/attachments/871728576972615680/1184862694478725191/favicon.png?ex=658d8460&is=657b0f60&hm=48fb0df56b917e6fb5b47e2a3f142c46c86057f26c729c4d9b558964ae165115&" alt=""></div>
                    <div class="textBox">
                        <div class="textContent">
                            <p class="h1"><?php echo $olimpiada->getTitulo(); ?></p>
                            <span class="span"><?php echo $olimpiada->getDataInicio(); ?></span>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg modalCriarSimu" id="modalQuestoes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criação de simulado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="questaoForm" action="criaSimulado.php" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <label for="titulo_olim" class="form-label">Titulo/Nome da olimpíada:</label>
                                <input type="text" name="titulo_olim" class="form-control" id="titulo_olim" placeholder="Titulo da olimpiada" required><br>
                                <br><br>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 id="tituloCorpo">Quantidade de questões:</h6>
                                        <h6>Linguagem e suas Tecnologias:</h6>
                                        <input type="number" name="numLinguagem" class="form-control" id="numLinguagem" placeholder="..." required>
                                        <h6>Matemática e suas Tecnologias:</h6>
                                        <input type="number" name="numMatematica" class="form-control" id="numMatematica" placeholder="..." required>
                                        <h6>Ciências da Natureza e suas Tecnologias:</h6>
                                        <input type="number" name="numCienNatu" class="form-control" id="numCienNatu" placeholder="..." required>
                                        <h6>Ciências Humanas e Sociais Aplicadas:</h6>
                                        <input type="number" name="numCienHum" class="form-control" id="numCienHum" placeholder="..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 id="tituloCorpo">Informações:</h6>
                                        <label for="data_inicio" class="form-label">Inicio:</label>
                                        <input type="datetime-local" name="data_inicio" class="form-control" id="data_inicio" placeholder="" required>
                                        <label for="data_final" class="form-label">Final:</label>
                                        <input type="datetime-local" name="data_final" class="form-control" id="data_final" placeholder="" required>
                                        <label for="criador_questao" class="form-label">Criador do simulado:</label>
                                        <input type="text" name="criador_questao" class="form-control" id="criador_questao" placeholder="" value="<?php echo $admin->getNome(); ?>" readonly>
                                        <label for="equipes" class="form-label">Equipes participantes:</label>
                                        <input type="text" name="equipes" class="form-control" id="equipes" placeholder="" value="Todas as equipes" readonly>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="btnAprovar">Criar olimpíada!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg mostraSimu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Seção esquerda -->
                            <div class="col-md-6">
                                <h4><b>Gerais:</b></h4>
                                <h5>Titulo: <span id="simuTitulo"><b>Matkingos</b></span></h5>
                                <h5>Inicio: <span id="simuInicio"><b>Matkingos</b></span></h5>
                                <h5>Término: <span id="simuTermino"><b>Matkingos</b></span></h5>
                                <h5>Criador: <span id="simuCriador"><b>Matkingos</b></span></h5>
                            </div>
                            <!-- Seção direita -->
                            <div class="col-md-6">
                                <h4><b>Número de questões:</b></h4>
                                <h5>Linguagem e suas Tecnologias: <span id="numLt"><b>Matkingos</b></span></h5>
                                <h5>Matemática e suas Tecnologias: <span id="numMt"><b>Matkingos</b></span></h5>
                                <h5>Ciências da Natureza e suas Tecnologias: <span id="numCn"><b>Matkingos</b></span></h5>
                                <h5>Ciências Humanas e Sociais Aplicadas: <span id="numCh"><b>Matkingos</b></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnExcluir">Excluir!</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
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