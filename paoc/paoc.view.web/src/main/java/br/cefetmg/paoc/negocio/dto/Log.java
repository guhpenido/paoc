package br.cefetmg.paoc.negocio.dto;

public class Log {
    private String acao;
    private String autor;
    private String dataHora;
    private int cod;
    private String objeto;

    public Log(String acao, String autor, String dataHora, int cod, String objeto) {
        this.acao = acao;
        this.autor = autor;
        this.dataHora = dataHora;
        this.cod = cod;
        this.objeto = objeto;
    }

    public String getAcao() {
        return acao;
    }

    public String getAutor() {
        return autor;
    }

    public String getDataHora() {
        return dataHora;
    }

    public int getCod() {
        return cod;
    }

    public String getObjeto() {
        return objeto;
    }
    
    
}
