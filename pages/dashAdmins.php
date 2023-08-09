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
    <link rel="stylesheet" href="../assets/css/tabelaEquipes.css">
    <link rel="stylesheet" href="../assets/css/admEquipes.css">

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
    }else if($admin->getPermissao() === "1"){
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
                </a> <a href="dashAdmins.php" class="nav_link active"> <i class="fas fa-solid fa-user nav_icon"></i> <span class="nav_name">Administradores</span>
                </a> <a href="dashEqui.php" class="nav_link"> <i class="fas fa-solid fa-users nav_icon"></i> <span class="nav_name">Equipes</span>
                </a> <a href="questoes.php" class="nav_link"> <i class="fas fa-solid fa-question nav_icon"></i> <span class="nav_name">Questões</span>
                </a> <a href="comunicacao.php" class="nav_link"><i class="fas fa-solid fa-pager nav_icon"></i> <span class=" nav_name">Comunicação</span>
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
        <h2>Tabela de Administradores</h2>
        <table class="table" id="tabelaEquipes">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Nível de permissão</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../services/negocioException.php';
                require_once '../services/admDao.php';
                $aux = 0;
                $admins = admDAO::listarAdmBD();
                foreach ($admins as $admina) :
                    $aux = $aux + 1; ?>
                    <tr>
                        <td><?php echo $aux; ?></td>
                        <td><?php echo $admina->getNome(); ?></td>
                        <td><?php echo $admina->getUsername(); ?></td>
                        <td><?php echo $admina->getEmail(); ?></td>
                        <td><?php echo $admina->getPermissao(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button id="visualizarDados">Adicionar administrador</button>

    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dados do novo administrador:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Seção esquerda -->
                            <div class="col-md-6">
                                <form action="cadastroAdmins.php" method="post">
                                    <h5>Nome completo</h5>
                                    <input type="text" name="nome_admin" id="nome_admin" class="input-text form-control" placeholder="Nome completo" required>
                                    <br>
                                    <h5>Usuário</h5>
                                    <input type="text" name="usuario_admin" id="usuario_admin" class="input-text form-control" placeholder="Usuário para login" required>
                                    <br>
                                    <h5>E-mail</h5>
                                    <input type="text" name="email_admin" id="email_admin" class="input-text form-control" placeholder="E-mail para login" required>
                                    <br>
                                    <h5>Senha</h5>
                                    <div id="inputSenha">
                                        <input type="password" name="password_admin" id="password_admin" class="form-control" placeholder="Senha de login">
                                        <img id="olhinho" src="https://i.stack.imgur.com/H9Sb2.png" alt="">
                                    </div>


                            </div>

                            <!-- Seção direita -->
                            <div class="col-md-6">
                                <h5>Permissão</h5>
                                <select name="permissao_admin" id="selectPermissao" class="form-control" style="padding: 2px;" required>
                                    <option class="option" value="1">Nível 1</option>
                                    <option class="option" value="2">Nível 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" id="btnAprovar">Cadastrar!</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2010.07.06dev/modernizr.min.js" integrity="sha512-HyO6DE8TAYakYahq831kmrY5Z/6HjP5wucRRPZ9XKDZhjyw5QroAPpvLRRhTSsfFh04OuEYKdcWeqKFTJCvB7g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/tabelaAdm.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <?php

    ?>

</body>

</html>