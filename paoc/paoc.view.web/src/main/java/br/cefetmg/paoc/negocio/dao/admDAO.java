/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package br.cefetmg.paoc.negocio.dao;

import br.cefetmg.paoc.database.Conexao;
import br.cefetmg.paoc.negocio.dto.Admin;
import br.cefetmg.paoc.negocio.excessoes.*;
import br.cefetmg.paoc.negocio.servico.persistenciaException;
import java.io.UnsupportedEncodingException;
import static java.lang.Integer.parseInt;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class admDAO {

    public static List<Admin> listarAdmBD() throws SQLException {
        List<Admin> listaAdmin = new ArrayList<>();
        String sql = "SELECT * FROM administradores";
        Connection com = Conexao.getConnection();
        PreparedStatement stmt = com.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            int id = Integer.parseInt(rs.getString("id"));
            String nome = rs.getString("nome");
            String email = rs.getString("email");
            String username = rs.getString("username");
            String senha = rs.getString("senha");

            Admin a = new Admin(nome, username, email, senha);
            listaAdmin.add(a);
        }
        if (listaAdmin.isEmpty() != true) {
            return listaAdmin;
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

    public static Admin procurarAdmin(String username) throws SQLException {
        List<Admin> listaAdmins = listarAdmBD();

        if (listaAdmins != null) {
            for (Admin a : listaAdmins) {
                if (a.getUsername().equals(username)) {
                    return a;
                }
            }
        }
        return null;
    }

    public static void cadastrarAdmin(String nome, String email, String username, String senhaPura) throws negocioException, SQLException, UnsupportedEncodingException, NoSuchAlgorithmException {
        if (procurarAdmin(username) == null | listarAdmBD() == null) {
            try {
                String senha = criptografarSenha(senhaPura);
                Connection connection = Conexao.getConnection();
                String sql = "INSERT INTO administradores (nome, usuario, email, senha) VALUES (?, ?, ?, ?)";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, nome);
                pstmt.setString(2, username);
                pstmt.setString(3, email);
                pstmt.setString(4, senha);
                pstmt.executeUpdate();
                System.out.println("Administrador cadastrado com sucesso!");
                pstmt.close();
                connection.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public static void removerAdmin(String username) throws SQLException, negocioException {
        if (procurarAdmin(username) != null) {
            Admin a = procurarAdmin(username);
            String sql = "DELETE FROM administradores WHERE username='" + username + "'";
            Connection com = Conexao.getConnection();
            PreparedStatement pstmt = com.prepareStatement(sql);
            pstmt.execute();
            pstmt.close();
            com.close();
        }
    }

    public static Admin logarAdmin(String username, String senha) throws SQLException, UnsupportedEncodingException, NoSuchAlgorithmException, persistenciaException {
        Admin a = null;
        String sql = "SELECT * FROM administradores WHERE usuario='" + username + "' AND senha='" + senha + "'";
        System.out.println("Consultando no BD");
        Connection com = Conexao.getConnection();
        PreparedStatement stmt = com.prepareStatement(sql);
        ResultSet rs = stmt.executeQuery();
        if (rs.next()) {
            System.out.println("Tem usuário.");
            int id = Integer.parseInt(rs.getString("id"));
            String nome = rs.getString("nome");
            String email = rs.getString("email");
            String usuario = rs.getString("usuario");
            String senhaa = rs.getString("senha");
            System.out.println(nome);
            System.out.println(email);
            a = new Admin(nome, username, email, senhaa);

        } else {
            throw new persistenciaException("Usuario ou senha incorretos!");
        }
        return a;
    }
}
