/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package br.cefetmg.paoc.negocio.dto;

public class Equipe {
    private String nome;
    private String curso;
    private String nome_responsavel;
    private String email_responsavel;
    private String nome_capitao;
    private String email_capitao;
    private String matricula_capitao;
    private String nome_int1;
    private String email_int1;
    private String matricula_int1;
    private String nome_int2;
    private String email_int2;
    private String matricula_int2;
    private String nome_int3;
    private String email_int3;
    private String matricula_int3;
    private String nome_int4;
    private String email_int4;
    private String matricula_int4;
    private String nome_int5;
    private String email_int5;
    private String matricula_int5;
    private String status;

    public Equipe(String nome, String curso, String nome_responsavel, String email_responsavel, String nome_capitao, String email_capitao, String matricula_capitao, String nome_int1, String email_int1, String matricula_int1, String nome_int2, String email_int2, String matricula_int2, String nome_int3, String email_int3, String matricula_int3, String nome_int4, String email_int4, String matricula_int4, String nome_int5, String email_int5, String matricula_int5, String status) {
        this.nome = nome;
        this.curso = curso;
        this.nome_responsavel = nome_responsavel;
        this.email_responsavel = email_responsavel;
        this.nome_capitao = nome_capitao;
        this.email_capitao = email_capitao;
        this.matricula_capitao = matricula_capitao;
        this.nome_int1 = nome_int1;
        this.email_int1 = email_int1;
        this.matricula_int1 = matricula_int1;
        this.nome_int2 = nome_int2;
        this.email_int2 = email_int2;
        this.matricula_int2 = matricula_int2;
        this.nome_int3 = nome_int3;
        this.email_int3 = email_int3;
        this.matricula_int3 = matricula_int3;
        this.nome_int4 = nome_int4;
        this.email_int4 = email_int4;
        this.matricula_int4 = matricula_int4;
        this.nome_int5 = nome_int5;
        this.email_int5 = email_int5;
        this.matricula_int5 = matricula_int5;
        this.status = status;
    }

    public String getNome() {
        return nome;
    }

    public String getCurso() {
        return curso;
    }

    public String getNome_responsavel() {
        return nome_responsavel;
    }

    public String getEmail_responsavel() {
        return email_responsavel;
    }

    public String getNome_capitao() {
        return nome_capitao;
    }

    public String getEmail_capitao() {
        return email_capitao;
    }

    public String getMatricula_capitao() {
        return matricula_capitao;
    }

    public String getNome_int1() {
        return nome_int1;
    }

    public String getEmail_int1() {
        return email_int1;
    }

    public String getMatricula_int1() {
        return matricula_int1;
    }

    public String getNome_int2() {
        return nome_int2;
    }

    public String getEmail_int2() {
        return email_int2;
    }

    public String getMatricula_int2() {
        return matricula_int2;
    }

    public String getNome_int3() {
        return nome_int3;
    }

    public String getEmail_int3() {
        return email_int3;
    }

    public String getMatricula_int3() {
        return matricula_int3;
    }

    public String getNome_int4() {
        return nome_int4;
    }

    public String getEmail_int4() {
        return email_int4;
    }

    public String getMatricula_int4() {
        return matricula_int4;
    }

    public String getNome_int5() {
        return nome_int5;
    }

    public String getEmail_int5() {
        return email_int5;
    }

    public String getMatricula_int5() {
        return matricula_int5;
    }

    public String getStatus() {
        return status;
    }

}