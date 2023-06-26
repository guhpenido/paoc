/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */

import br.cefetmg.paoc.negocio.dto.Equipe;
import br.cefetmg.paoc.negocio.excessoes.negocioException;
import br.cefetmg.paoc.negocio.servico.ServicoEquipes;
import static br.cefetmg.paoc.negocio.servico.ServicoEquipes.listarEquipes;
import jakarta.servlet.RequestDispatcher;
import java.io.IOException;
import java.io.PrintWriter;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;
import java.io.UnsupportedEncodingException;
import java.security.NoSuchAlgorithmException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author gugup
 */
@WebServlet(urlPatterns = {"/CadastroEquipes"})
public class CadastroEquipes extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        response.setContentType("text/html;charset=UTF-8");
        try ( PrintWriter out = response.getWriter()) {
            HttpSession session = request.getSession();
            String nome = request.getParameter("nome_equipe");
            String curso = request.getParameter("curso");
            String nome_responsavel = request.getParameter("nome_responsavel");
            String email_responsavel = request.getParameter("email_responsavel");
            String nome_capitao = request.getParameter("nome_capitao");
            String email_capitao = request.getParameter("email_capitao");
            String matricula_capitao = request.getParameter("matricula_capitao");
            String nome_int1 = request.getParameter("nome_integrante1");
            String email_int1 = request.getParameter("email_integrante1");
            String matricula_int1 = request.getParameter("matricula_integrante1");
            String nome_int2 = request.getParameter("nome_integrante2");
            String email_int2 = request.getParameter("email_integrante2");
            String matricula_int2 = request.getParameter("matricula_integrante2");
            String nome_int3 = request.getParameter("nome_integrante3");
            String email_int3 = request.getParameter("email_integrante3");
            String matricula_int3 = request.getParameter("matricula_integrante3");
            String nome_int4 = request.getParameter("nome_integrante4");
            String email_int4 = request.getParameter("email_integrante4");
            String matricula_int4 = request.getParameter("matricula_integrante4");
            String nome_int5 = request.getParameter("nome_integrante5");
            String email_int5 = request.getParameter("email_integrante5");
            String matricula_int5 = request.getParameter("matricula_integrante5");

            List<Equipe> equipes = null;
            if (listarEquipes() != null) {
                equipes = listarEquipes();
            }
            if (equipes != null) {

                List<String> matriculas = new ArrayList();
                List<String> matriculasBD = new ArrayList();
                List<String> nomesBD = new ArrayList();

                matriculas.add(matricula_capitao);
                matriculas.add(matricula_int1);
                matriculas.add(matricula_int2);
                matriculas.add(matricula_int3);
                matriculas.add(matricula_int4);
                matriculas.add(matricula_int5);

                for (Equipe equipe : equipes) {
                    String mat1 = equipe.getMatricula_int1();
                    String mat2 = equipe.getMatricula_int2();
                    String mat3 = equipe.getMatricula_int3();
                    String mat4 = equipe.getMatricula_int4();
                    String mat5 = equipe.getMatricula_int5();
                    String matCAP = equipe.getMatricula_capitao();

                    matriculasBD.add(mat1);
                    matriculasBD.add(mat2);
                    matriculasBD.add(mat3);
                    matriculasBD.add(mat4);
                    matriculasBD.add(mat5);
                    matriculasBD.add(matCAP);
                }
                for (Equipe equipe : equipes) {
                    String nm = equipe.getNome();
                    nomesBD.add(nm);

                }
                boolean matriculasExistem = false;
                boolean nomeExiste = false;
                boolean cursoMaisDeDois = false;
                for (String elemento : matriculas) {
                    if (matriculasBD.contains(elemento)) {
                        matriculasExistem = true;
                    }
                }
                if (nomesBD.contains(nome)) {
                    nomeExiste = true;
                }
                Map<String, Integer> contadorCursos = new HashMap<>();
                for (Equipe equipe : equipes) {
                    String nomeCurso = equipe.getCurso();
                    contadorCursos.put(nomeCurso, contadorCursos.getOrDefault(nomeCurso, 0) + 1);
                }
                String cursoProcurado = curso;
                int ocorrencias = contadorCursos.getOrDefault(cursoProcurado, 0);
                if (ocorrencias >= 2) {
                    cursoMaisDeDois = true;
                }

                if (matriculasExistem) {
                    session.setAttribute("msg", "Essas matrículas já estão cadastradas.");
                    RequestDispatcher rd = request.getRequestDispatcher("/erroCadastro.jsp");
                    rd.forward(request, response);
                } else if (nomeExiste) {
                    session.setAttribute("msg", "Já existe uma equipe com esse nome.");
                    RequestDispatcher rd = request.getRequestDispatcher("/erroCadastro.jsp");
                    rd.forward(request, response);
                } else if (cursoMaisDeDois) {
                    session.setAttribute("msg", "Já existem duas equipes do seu curso.");
                    RequestDispatcher rd = request.getRequestDispatcher("/erroCadastro.jsp");
                    rd.forward(request, response);
                } else {
                    session.setAttribute("nomeEquipe", nome);
                    RequestDispatcher rd = request.getRequestDispatcher("/sucesso.jsp");
                    rd.forward(request, response);
                    ServicoEquipes.cadastrarEquipe(nome, curso, nome_responsavel, email_responsavel, nome_capitao, email_capitao, matricula_capitao, nome_int1, email_int1, matricula_int1, nome_int2, email_int2, matricula_int2, nome_int3, email_int3, matricula_int3, nome_int4, email_int4, matricula_int4, nome_int5, email_int5, matricula_int5, curso);
                    //envia email
                    
                }
            }
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, UnsupportedEncodingException {
        try {
            processRequest(request, response);
        } catch (negocioException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, UnsupportedEncodingException {
        try {
            processRequest(request, response);
        } catch (negocioException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        } catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(CadastroEquipes.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
