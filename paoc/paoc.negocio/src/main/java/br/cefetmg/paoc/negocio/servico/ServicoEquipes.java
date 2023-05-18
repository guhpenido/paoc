package br.cefetmg.paoc.negocio.servico;

import br.cefetmg.paoc.negocio.dao.EquipesDAO;
import br.cefetmg.paoc.negocio.dto.Equipe;
import br.cefetmg.paoc.negocio.excessoes.negocioException;
import java.io.UnsupportedEncodingException;
import java.security.NoSuchAlgorithmException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class ServicoEquipes {

    public static void cadastrarEquipe(String nome, String curso, String nome_responsavel, String email_responsavel, String nome_capitao, String email_capitao, String matricula_capitao, String nome_int1, String email_int1, String matricula_int1, String nome_int2, String email_int2, String matricula_int2, String nome_int3, String email_int3, String matricula_int3, String nome_int4, String email_int4, String matricula_int4, String nome_int5, String email_int5, String matricula_int5, String status) throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (nome.isEmpty()) {
            throw new negocioException(319, "Insira o nome!");
        }
        List<Equipe> equipes = null;
        if (listarEquipes() != null) {
            equipes = listarEquipes();
        }
        if (equipes != null) {
            List<String> matriculas = new ArrayList();
            List<String> matriculasBD = new ArrayList();
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
            for (String elemento : matriculas) {
                if (matriculasBD.contains(elemento)) {
                    //
                }
            }
            Map<String, Integer> contadorCursos = new HashMap<>();
            for (Equipe equipe : equipes) {
                String nomeCurso = equipe.getCurso();
                contadorCursos.put(nomeCurso, contadorCursos.getOrDefault(nomeCurso, 0) + 1);
            }
            String cursoProcurado = curso;
            int ocorrencias = contadorCursos.getOrDefault(cursoProcurado, 0);
            if (ocorrencias >= 2) {
                throw new negocioException(319, "Limite de cursos atingidos");
            }
        }
        try {
            EquipesDAO.cadastrarEquipe(nome, curso, nome_responsavel, email_responsavel, nome_capitao, email_capitao, matricula_capitao, nome_int1, email_int1, matricula_int1, nome_int2, email_int2, matricula_int2, nome_int3, email_int3, matricula_int3, nome_int4, email_int4, matricula_int4, nome_int5, email_int5, matricula_int5);
        } catch (negocioException | SQLException ex) {
            throw new negocioException(315, ex.getMessage());
        }
    }

    public static List<Equipe> listarEquipes() throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (EquipesDAO.listarEquipesBD() == null) {
            throw new negocioException(315, "Não existem equipes cadastradas!");
        }
        return EquipesDAO.listarEquipesBD();
    }
}
