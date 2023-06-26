<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import="br.cefetmg.paoc.negocio.dto.Admin" %>
<%@ page import="br.cefetmg.paoc.negocio.dto.Equipe" %>
<%@ page import="br.cefetmg.paoc.negocio.servico.ServicoEquipes" %>
<%@ page import="java.util.List" %>
<%@ page import="java.util.ArrayList" %>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>EQUIPES | CEFET-MG</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="elementos/img/favicon.ico">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/937e8004d1.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="elementos/css/slick.css">
        <link rel="stylesheet" href="elementos/css/dashboard.css">
        <link rel="stylesheet" href="elementos/css/admEquipes.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $(".table-row").click(function () {
                    $(this).next().toggleClass("show");
                    console.log("Clicado");
                });
            });
        </script>
    </head>
    <body id="body-pd">
        <%
           
    // Resgatar o objeto Admin da sessão
    Admin admin = (Admin) request.getSession().getAttribute("admin");
    
    // Verificar se o objeto Admin está presente na sessão
    if (admin != null) {
        String nome = admin.getNome();
        String username = admin.getUsername();
        String email = admin.getEmail();
        // Exibir as informações do Admin na página        
        %>
        <header class="header" id="header">
            <div class="header_toggle"> <i class="fas fa-solid fa-bars" id="header-toggle"></i></i> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="#" class="nav_logo"> <i class="fas fa-solid fa-lock  nav_logo-icon"></i> <span class="nav_logo-name">Administrador</span> </a>
                    <div class="nav_list"> <a href="dashboard.jsp" class="nav_link"> <i class="fas fa-sharp fa-solid fa-house-user nav_icon"></i> <span class="nav_name">Início</span> 
                        </a> <a href="#" class="nav_link"> <i class="fas fa-solid fa-user nav_icon"></i> <span class="nav_name">Administradores</span> 
                        </a> <a href="admEquipes.jsp" class="nav_link active"> <i class="fas fa-solid fa-users nav_icon"></i> <span class="nav_name">Equipes</span> 
                        </a> <a href="#" class="nav_link"><i class="fas fa-solid fa-pager nav_icon""></i> <span class="nav_name">Comunicação</span> 
                    </div>
                </div> <a href=index.html class="nav_link"> <i class="fas fa-solid fa-arrow-right-from-bracket nav_icon"></i> <span class="nav_name">Sair</span> </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light">
            <div class="container">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1>Gerenciar equipes</h1>
                        </div>
                        <div class="panel-body">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>Visualizar</th>
                                        <th>Nome</th>
                                        <th>Curso</th>
                                        <th>Responsável</th>
                                        <th>Capitão</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <%
                                         List<Equipe> equipes = null;
                                         equipes = ServicoEquipes.listarEquipes();
                                         int i = 0;
                                         for(Equipe equipe : equipes){
                                         i++;
                                        
                                    %>
                                    <tr data-toggle="collapse" data-target="#demo<%=i%>" class="accordion-toggle">
                                        <td><button class="btn btn-default btn-xs"><i class="fas fa-solid fa-eye"></i></button></td>
                                        <td><%=equipe.getNome()%></td>
                                        <td><%=equipe.getCurso()%></td>
                                        <td><%=equipe.getNome_responsavel()%></td>
                                        <td><%=equipe.getNome_capitao()%></td>
                                        <td><%=equipe. getStatus()%></td>
                                    </tr>
                                    <%}%>  
                                </tbody>
                            </table>                   
                        </div> 
                        </td>
                        </tr>      
                        </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2010.07.06dev/modernizr.min.js" integrity="sha512-HyO6DE8TAYakYahq831kmrY5Z/6HjP5wucRRPZ9XKDZhjyw5QroAPpvLRRhTSsfFh04OuEYKdcWeqKFTJCvB7g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="./elementos/js/main.js"></script>
<script src="./elementos/js/dashboard.js"></script>
<%
    } else {
        // Se o objeto Admin não estiver presente na sessão, redirecionar para a página de login
        response.sendRedirect("login.html");
    }
%>

</body>
</html>
