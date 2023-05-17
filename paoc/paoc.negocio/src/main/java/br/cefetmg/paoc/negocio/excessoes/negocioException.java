package br.cefetmg.paoc.negocio.excessoes;

public class negocioException extends Exception {
    private int codigo;
    
    public negocioException(String str){
        super(str);
        codigo = 0;
    }
    
    public negocioException(int codigo, String str) {
        super(str);
        this.codigo = codigo;
    }
    
     public int getCodigo() {
        return codigo;
    }
}
