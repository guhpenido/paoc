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
    <link rel="stylesheet" href="../assets/css/questoes.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

</head>

<body id="body-pd">
    <?php

    require_once '../services/Admin.php';

    // Resgatar o objeto Admin da sessão
    session_start();
    $admin = $_SESSION["admin"] ?? null;

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
            <div class="nav_list"> <a href="dashboard.php" class="nav_link"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span>
                </a> <a href="dashAdmins.php" class="nav_link"> <i class="fas fa-solid fa-user nav_icon"></i> <span class="nav_name">Administradores</span>
                </a> <a href="dashEqui.php" class="nav_link "> <i class="fas fa-solid fa-users nav_icon"></i> <span class="nav_name">Equipes</span>
                </a> <a href="questoes.php" class="nav_link active"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span>
                </a> <a href="comunicacao.php" class="nav_link"><i class="fas fa-solid fa-pager nav_icon"></i> <span class=" nav_name">Comunicação</span></a>
            </div>
        </div> <a href="../index.html" class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>';
            } else if ($admin->getPermissao() === "1") {
                echo '
        <div> <a href="#" class="nav_logo"> <i class="fas fa-solid fa-lock  nav_logo-icon"></i> <span class="nav_logo-name">Administrador</span> </a>
        <div class="nav_list"> <a href="dashboard.php" class="nav_link"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span></a>
        </div>
        <a href="questoes.php" class="nav_link active"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span></a>
        </div> <a href="../index.html" class="nav_link "> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>';
         
            }
            ?>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="container mt-5">
        <button type="button" id="abreModal" class="btn btn-primary btn-lg btn-block">Adicionar questão</button>



        <div class="container mt-5">
        <h2>Tabela de questões:</h2>
        <table class="table" id="tabelaEquipes">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Área</th>
                    <th scope="col">Nível</th>
                    <th scope="col">Autor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../services/negocioException.php';
                require_once '../services/QuestaoDAO.php';
                $aux = 0;
                $questoes = QuestaoDAO::listarQuestoes();
                foreach ($questoes as $questao) :
                    $aux = $aux + 1; ?>
                    <tr>
                        <td><?php echo $aux; ?></td>
                        <td><?php echo $questao->getArea(); ?></td>
                        <td><?php echo $questao->getNivel(); ?></td>
                        <td><?php echo $questao->getAutor(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <div class="modal fade bd-example-modal-lg" id="modalQuestoes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="questaoForm" action="enviaQuestao.php" method="post">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="area_questao" class="form-label">Área de competência:</label>
                                            <select name="area_questao" id="area_questao" class="form-control" style="padding: 2px;" required>
                                                <option class="option" value="Linguagem e suas Tecnologias">Linguagem e suas Tecnologias</option>
                                                <option class="option" value="Matemática e suas Tecnologias">Matemática e suas Tecnologias</option>
                                                <option class="option" value="Ciências da Natureza e suas Tecnologias">Ciências da Natureza e suas Tecnologias</option>
                                                <option class="option" value="Ciências Humanas e Sociais Aplicadas">Ciências Humanas e Sociais Aplicadas</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nivel_questao" class="form-label">Nível de dificuldade:</label>
                                            <select name="nivel_questao" id="nivel_questao" class="form-control" style="padding: 2px;" required>
                                                <option class="option" value="Fácil">Fácil</option>
                                                <option class="option" value="Médio">Médio</option>
                                                <option class="option" value="Difícil">Difícil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tempo_questao" class="form-label">Tempo (em segundos):</label>
                                            <input type="text" name="tempo_questao" class="form-control" id="tempo_questao" placeholder="50">
                                        </div>
                                        <div class="mb-3">
                                            <label for="criador_questao" class="form-label">Criador da questão:</label>
                                            <input type="text" name="criador_questao" class="form-control" id="criador_questao" placeholder="" value="<?php echo $admin->getNome(); ?>" readonly>
                                        </div>
                                    </div>
                                    <h6 id="tituloCorpo">Corpo da questão:</h6>
                                    <div id="editor-container"></div>
                                    <br><input type="hidden" id="hidden-editor" name="questionText">
                                    
                                    <br><br>
                                    <div class="col-md-6">
                                        <h6 id="tituloCorpo">Alternativas (não numerar nem letrar):</h6>
                                        <div class="mb-3">
                                            <label for="alter1_questao" class="form-label">Alternativa 1:</label>
                                            <input type="text" name="alter1_questao" class="form-control" id="alter1_questao" placeholder="Coloque aqui uma das alternativas.">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alter2_questao" class="form-label">Alternativa 2:</label>
                                            <input type="text" name="alter2_questao" class="form-control" id="alter2_questao" placeholder="Coloque aqui uma das alternativas.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <div class="mb-3">
                                            <label for="alter3_questao" class="form-label">Alternativa 3:</label>
                                            <input type="text" name="alter3_questao" class="form-control" id="alter3_questao" placeholder="Coloque aqui uma das alternativas.">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alter4_questao" class="form-label">Alternativa 4:</label>
                                            <input type="text" name="alter4_questao"class="form-control" id="alter4_questao" placeholder="Coloque aqui uma das alternativas.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 id="tituloCorpo">Resolução:</h6>
                                        <div class="mb-3">
                                            <label for="resp_questao" class="form-label">Alternativa correta:</label>
                                            <select name="resp_questao" id="resp_questao" class="form-control" style="padding: 2px;" required>
                                                <option class="option" value="Alternativa 1">Alternativa 1</option>
                                                <option class="option" value="Alternativa 2">Alternativa 2</option>
                                                <option class="option" value="Alternativa 3">Alternativa 3</option>
                                                <option class="option" value="Alternativa 4">Alternativa 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="btnAprovar">Cadastrar!</button>
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
        <script src="../assets/js/questoes.js"></script>

        <?php

        ?>

</body>

</html>