package br.cefetmg.paoc.negocio.dao;

import br.cefetmg.paoc.database.Conexao;
import br.cefetmg.paoc.negocio.dto.Equipe;
import br.cefetmg.paoc.negocio.excessoes.negocioException;
import java.io.UnsupportedEncodingException;
import static java.lang.Integer.parseInt;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class EquipesDAO {

    public static List<Equipe> listarEquipesBD() throws SQLException {
        List<Equipe> listaEquipes = new ArrayList<>();
        String sql = "SELECT * FROM equipe";
        Connection com = Conexao.getConnection();
        PreparedStatement stmt = com.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            int id = Integer.parseInt(rs.getString("id"));
            String nome = rs.getString("nome");
            String curso = rs.getString("curso");
            String nome_responsavel = rs.getString("nome_responsavel");
            String email_responsavel = rs.getString("email_responsavel");
            String nome_capitao = rs.getString("nome_capitao");
            String email_capitao = rs.getString("email_capitao");
            String matricula_capitao = rs.getString("matricula_capitao");
            String nome_int1 = rs.getString("nome_int1");
            String email_int1 = rs.getString("email_int1");
            String matricula_int1 = rs.getString("matricula_int1");
            String nome_int2 = rs.getString("nome_int2");
            String email_int2 = rs.getString("email_int2");
            String matricula_int2 = rs.getString("matricula_int2");
            String nome_int3 = rs.getString("nome_int3");
            String email_int3 = rs.getString("email_int3");
            String matricula_int3 = rs.getString("matricula_int3");
            String nome_int4 = rs.getString("nome_int4");
            String email_int4 = rs.getString("email_int4");
            String matricula_int4 = rs.getString("matricula_int4");
            String nome_int5 = rs.getString("nome_int5");
            String email_int5 = rs.getString("email_int5");
            String matricula_int5 = rs.getString("matricula_int5");
            String status = rs.getString("status");

            Equipe u = new Equipe(nome,
                    curso, nome_responsavel,
                    email_responsavel, nome_capitao,
                    email_capitao, matricula_capitao, nome_int1,
                    email_int1, matricula_int1, nome_int2,
                    email_int2, matricula_int2, nome_int3,
                    email_int3, matricula_int3, nome_int4,
                    email_int4, matricula_int4, nome_int5,
                    email_int5, matricula_int5, status
            );
            listaEquipes.add(u);
        }
        if (listaEquipes.isEmpty() != true) {
            return listaEquipes;
        }
        return null;
    }

    public static String criptografarSenha(String senha) throws UnsupportedEncodingException, NoSuchAlgorithmException {
        MessageDigest algorithm = MessageDigest.getInstance("SHA-256");
        byte messageDigest[] = algorithm.digest(senha.getBytes("UTF-8"));

        StringBuilder hexString = new StringBuilder();
        for (byte b : messageDigest) {
            hexString.append(String.format("%02X", 0xFF & b));
        }
        String senhahex = hexString.toString();
        return senhahex;
    }

    public static Equipe procurarEquipe(String nome) throws SQLException {
        List<Equipe> listaEquipes = listarEquipesBD();

        if (listaEquipes != null) {
            for (Equipe e : listaEquipes) {
                if (e.getNome().equals(nome)) {
                    return e;
                }
            }
        }
        return null;
    }

    public static void cadastrarEquipe(String nome, String curso, String nome_responsavel, String email_responsavel, String nome_capitao, String email_capitao, String matricula_capitao, String nome_int1, String email_int1, String matricula_int1, String nome_int2, String email_int2, String matricula_int2, String nome_int3, String email_int3, String matricula_int3, String nome_int4, String email_int4, String matricula_int4, String nome_int5, String email_int5, String matricula_int5) throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (procurarEquipe(nome) == null | listarEquipesBD() == null) {
            String sql = "INSERT INTO equipe "
                    + "(nome, curso, nome_responsavel, email_responsavel, nome_capitao, email_capitao, matricula_capitao, "
                    + "nome_int1, email_int1, matricula_int1, nome_int2, email_int2, matricula_int2, "
                    + "nome_int3, email_int3, matricula_int3, nome_int4, email_int4, matricula_int4, "
                    + "nome_int5, email_int5, matricula_int5, status) "
                    + "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try ( Connection com = Conexao.getConnection();  PreparedStatement pstmt = com.prepareStatement(sql)) {
                pstmt.setString(1, nome);
                pstmt.setString(2, curso);
                pstmt.setString(3, nome_responsavel);
                pstmt.setString(4, email_responsavel);
                pstmt.setString(5, nome_capitao);
                pstmt.setString(6, email_capitao);
                pstmt.setString(7, matricula_capitao);
                pstmt.setString(8, nome_int1);
                pstmt.setString(9, email_int1);
                pstmt.setString(10, matricula_int1);
                pstmt.setString(11, nome_int2);
                pstmt.setString(12, email_int2);
                pstmt.setString(13, matricula_int2);
                pstmt.setString(14, nome_int3);
                pstmt.setString(15, email_int3);
                pstmt.setString(16, matricula_int3);
                pstmt.setString(17, nome_int4);
                pstmt.setString(18, email_int4);
                pstmt.setString(19, matricula_int4);
                pstmt.setString(20, nome_int5);
                pstmt.setString(21, email_int5);
                pstmt.setString(22, matricula_int5);
                pstmt.setString(23, "Pendente");
System.out.println(pstmt.toString());
                pstmt.executeUpdate();

                System.out.println("Registro inserido com sucesso!");
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public static void removerEquipe(String nome) throws SQLException, negocioException {
        if (procurarEquipe(nome) != null) {
            Equipe e = procurarEquipe(nome);
            String sql = "DELETE FROM equipe WHERE nome='" + nome + "'";
            Connection com = Conexao.getConnection();
            PreparedStatement pstmt = com.prepareStatement(sql);
            pstmt.execute();
            pstmt.close();
            com.close();
        }
    }

    //public static Cliente logarCliente(String username, String senha) throws persistenciaException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
    //    Cliente cliente = procurarCliente(username);
    //    if (cliente == null) {
    //        throw new persistenciaException("Username de usuário não encontrado!");
    //    }
    //    if (cliente.getSenha().equals(criptografarSenha(senha))) {
    //        return cliente;
    //   } else {
    //       throw new persistenciaException("Senha incorreta!");
    //    }
    //}
}
