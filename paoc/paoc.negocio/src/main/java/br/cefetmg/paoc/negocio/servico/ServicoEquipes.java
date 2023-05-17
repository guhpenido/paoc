package br.cefetmg.paoc.negocio.servico;

import br.cefetmg.paoc.negocio.dao.EquipesDAO;
import br.cefetmg.paoc.negocio.dto.Equipe;
import br.cefetmg.paoc.negocio.excessoes.negocioException;
import java.io.UnsupportedEncodingException;
import java.security.NoSuchAlgorithmException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class ServicoEquipes {

    public static void cadastrarEquipe(String nome, String curso, String nome_responsavel, String email_responsavel, String nome_capitao, String email_capitao, int matricula_capitao, String nome_int1, String email_int1, int matricula_int1, String nome_int2, String email_int2, int matricula_int2, String nome_int3, String email_int3, int matricula_int3, String nome_int4, String email_int4, int matricula_int4, String nome_int5, String email_int5, int matricula_int5, String status) throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (nome.isEmpty()) {
            throw new negocioException(319, "Insira o nome!");
        }
        int i =  0;
        while(i < listarEquipes().size()){
        List<String> listaCursos = new ArrayList<>();
        listaCursos.add(listarEquipes().get(i).getCurso());     
    }
        if(curso = listarEquipes().)
        try {
            ClientesDAO.cadastrarCliente(nome, nascimento, cpf, rg, endereco, telefone, email, usuario, senha);
        } catch (negocioException | SQLException ex) {
            throw new negocioException(315, ex.getMessage());
        }
    }

    public static List<Equipe> listarEquipes() throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (EquipesDAO.listarEquipesBD() == null) {
            throw new negocioException(315, "Não existem clientes cadastrados!");
        }

        return EquipesDAO.listarEquipesBD();
    }
}
