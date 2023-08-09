<?php 
class Log {
    private $acao;
    private $autor;
    private $dataHora;
    private $cod;
    private $objeto;

    public function __construct($acao, $autor, $dataHora, $cod, $objeto) {
        $this->acao = $acao;
        $this->autor = $autor;
        $this->dataHora = $dataHora;
        $this->cod = $cod;
        $this->objeto = $objeto;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getCod() {
        return $this->cod;
    }

    public function getObjeto() {
        return $this->objeto;
    }
}

?>