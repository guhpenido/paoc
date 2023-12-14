<?php

class Simulado1 {
    public $id;
    public $titulo;
    public $criador;
    public $numLinguagem;
    public $numMatematica;
    public $numCienNatu;
    public $numCienHum;
    public $dataInicio;
    public $dataTermino;

    public function __construct($id, $titulo, $criador, $numLinguagem, $numMatematica, $numCienNatu, $numCienHum, $dataInicio, $dataTermino) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->criador = $criador;
        $this->numLinguagem = $numLinguagem;
        $this->numMatematica = $numMatematica;
        $this->numCienNatu = $numCienNatu;
        $this->numCienHum = $numCienHum;
        $this->dataInicio = $dataInicio;
        $this->dataTermino = $dataTermino;
    }

    public function getId() {
        return $this->id;
    }
    public function getTitulo() {
        return $this->titulo;
    }

    public function getCriador() {
        return $this->criador;
    }

    public function getNumLinguagem() {
        return $this->numLinguagem;
    }

    public function getNumMatematica() {
        return $this->numMatematica;
    }

    public function getNumCienNatu() {
        return $this->numCienNatu;
    }

    public function getNumCienHum() {
        return $this->numCienHum;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataTermino() {
        return $this->dataTermino;
    }
}
?>
