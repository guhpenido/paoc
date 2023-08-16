<?php
class Questao {
    public $area;
    public $nivel;
    public $tempo;
    public $corpo_questao;
    public $alternativa1;
    public $alternativa2;
    public $alternativa3;
    public $alternativa4;
    public $alternativa_correta;
    public $autor;

    public function __construct($area, $nivel, $tempo, $corpo_questao, $alternativa1, $alternativa2, $alternativa3, $alternativa4, $alternativa_correta, $autor) {
        $this->area = $area;
        $this->nivel = $nivel;
        $this->tempo = $tempo;
        $this->corpo_questao = $corpo_questao;
        $this->alternativa1 = $alternativa1;
        $this->alternativa2 = $alternativa2;
        $this->alternativa3 = $alternativa3;
        $this->alternativa4 = $alternativa4;
        $this->alternativa_correta = $alternativa_correta;
        $this->autor = $autor;
    }

    
    public function getArea() {
        return $this->area;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function getTempo() {
        return $this->tempo;
    }

    public function getCorpoQuestao() {
        return $this->corpo_questao;
    }

    public function getAlternativa1() {
        return $this->alternativa1;
    }

    public function getAlternativa2() {
        return $this->alternativa2;
    }

    public function getAlternativa3() {
        return $this->alternativa3;
    }

    public function getAlternativa4() {
        return $this->alternativa4;
    }

    public function getAlternativaCorreta() {
        return $this->alternativa_correta;
    }

    public function getAutor() {
        return $this->autor;
    }
}
?>