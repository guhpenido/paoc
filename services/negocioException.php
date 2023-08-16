<?php
class negocioException extends Exception {
    private $codigo;

    public function __construct($str, $codigo = 0) {
        parent::__construct($str);
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }
}
?>
