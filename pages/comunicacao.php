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
    <link rel="stylesheet" href="../assets/css/comunicacao.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
    } else if ($admin->getPermissao() === "1") {
        echo "<script>alert('Você não tem permissão para usar essa página!')</script>";
        header("Location: dashboard.php"); // Redireciona para a página de login
        exit();
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
            <div class="nav_list"> <a href="dashboard.php" class="nav_link "> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span>
                </a> <a href="dashAdmins.php" class="nav_link"> <i class="fas fa-solid fa-user nav_icon"></i> <span class="nav_name">Administradores</span>
                </a> <a href="dashEqui.php" class="nav_link"> <i class="fas fa-solid fa-users nav_icon"></i> <span class="nav_name">Equipes</span>
                </a> <a href="questoes.php" class="nav_link"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span>
                </a> <a href="comunicacao.php" class="nav_link active"><i class="fas fa-solid fa-pager nav_icon"></i> <span class=" nav_name">Comunicação</span></a>
            </div>
        </div> <a href="../index.html" class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>';
            } else if ($admin->getPermissao() === "1") {
                echo '
        <div> <a href="#" class="nav_logo"> <i class="fas fa-solid fa-lock  nav_logo-icon"></i> <span class="nav_logo-name">Administrador</span> </a>
        <div class="nav_list"> <a href="dashboard.php" class="nav_link active"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span>
        </div>
        </div> <a href="../index.html" class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>
         <a href="questoes.php" class="nav_link"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span></a>';
            }
            ?>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="container mt-5">
        <h2>Formulário de comunicação:</h2>
        <button type="button" id="comuEquipe" class="btn btn-primary btn-lg btn-block">Comunicar com equipes</button>
        <button type="button" id="comuIndividual" class="btn btn-primary btn-lg btn-block">Comunicar individualmente</button>
        <!--<button type="button" id="comuResponsaveis" class="btn btn-primary btn-lg btn-block">Comunicar com os responsáveis</button>
        <button type="button" id="comuAdms" class="btn btn-primary btn-lg btn-block">Comunicar com os administradores</button>-->
        <button type="button" id="comuGeral" class="btn btn-primary btn-lg btn-block">Enviar comunidado geral</button>
    </div>

    <div class="modal fade bd-example-modal-lg modalEquipe" id="modalEquipe" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comunicação com equipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="comuEquipe.php" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="equipe_destinataria" class="form-label">Equipe destinatária:</label>
                                        <select name="equipe_destinataria" id="equipe_destinataria" class="form-control" style="padding: 2px;" required>
                                            <?php
                                            require_once '../services/Equipe.php';
                                            require_once '../services/negocioException.php';
                                            require_once '../services/servicoEquipes.php';
                                            $aux = 0;
                                            $equipes = ServicoEquipes::listarEquipes();
                                            foreach ($equipes as $equipe) : ?>
                                                <option class="option" value="<?php echo $equipe->getNome() ?>"><?php echo $equipe->getNome() . " | " . $equipe->getCurso() ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nivel_questao" class="form-label">Remetente:</label>
                                        <input type="text" name="rem_email" class="form-control" id="tempo_questao" placeholder="50" value="<?php echo $admin->getNome(); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="assunto_msg" class="form-label">Assunto:</label>
                                        <input type="text" name="assunto_msg" class="form-control" id="assunto_msg" placeholder="Assunto do e-mail:">
                                    </div>
                                </div>
                                <h6 id="tituloCorpo">Corpo do e-mail:</h6>
                                <div id="editor-container-equipe"></div>
                                <br><input type="hidden" id="hidden-editor1" name="questionText">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" id="btnAprovar">Enviar!</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade bd-example-modal-lg modalIndividual" id="modalIndividual" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Comunicação com equipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="comuIndividual.php" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dest_nome" class="form-label">Nome do destinatário:</label>
                                        <input type="text" name="dest_nome" class="form-control" id="dest_nome" placeholder="Nome completo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dest_email" class="form-label">E-mail do destinatário:</label>
                                        <input type="email" name="dest_email" class="form-control" id="dest_email" placeholder="exemplo@dominio.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="remetente_ind" class="form-label">Remetente:</label>
                                            <input type="text" name="remetente_ind" class="form-control" id="remetente_ind" placeholder="50" value="<?php echo $admin->getNome(); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="assunto_email" class="form-label">Assunto:</label>
                                            <input type="text" name="assunto_email" class="form-control" id="assunto_email" placeholder="Assunto">
                                        </div>
                                    </div>
                                </div>
                                <h6 id="tituloCorpo">Corpo do e-mail:</h6>
                                <div id="editor-container-individual"></div>
                                <br><input type="hidden" id="hidden-editor2" name="questionTextInd">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Enviar!</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade bd-example-modal-lg modalGeral" id="modalGeral" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Comunicação para todos os membros, responsáveis e administradores.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="comuGeral.php" method="post">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dest_nome" class="form-label">Destinatário:</label>
                                        <input type="text" name="dest" class="form-control" id="dest" placeholder="Nome completo" value="Todos os cadastrados" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="remetente_gera" class="form-label">Remetente:</label>
                                            <input type="text" name="remetente_gera" class="form-control" id="remetente_gera" placeholder="50" value="<?php echo $admin->getNome(); ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="assunto_emailGeral" class="form-label">Assunto:</label>
                                            <input type="text" name="assunto_emailGeral" class="form-control" id="assunto_emailGeral" placeholder="Assunto">
                                        </div>
                                    </div>
                                </div>
                                <h6 id="tituloCorpo">Corpo do e-mail:</h6>
                                <div id="editor-container-geral"></div>
                                <br><input type="hidden" id="hidden-editor3" name="questionTextGer">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Enviar!</button>
                            </div>
                    </form>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="../assets/js/comunicacao.js"></script>
    <?php

    ?>

</body>

</html>