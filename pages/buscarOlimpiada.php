<?php
require_once '../services/Simulado.php';
require_once '../services/Simulado1.php';
require_once '../services/negocioException.php';
require_once '../services/SimuladoDAO.php';
function buscaSimulado($id)
{
    $simulados = SimuladoDAO::listarSimulados();
    $simuladoEncontrado = null;
    foreach ($simulados as $simulado) {
        if ($simulado->getId() === (int)$id) {
            $simuladoEncontrado = $simulado;
            break; // Encontrou uma correspondência, não é necessário continuar o loop
        }
    }
    return $simuladoEncontrado; // Retorna a equipe encontrada ou null se não encontrou nenhuma correspondência
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idSimulado'])) {
    $idSimulado = $_GET['idSimulado'];

    $result = buscaSimulado($idSimulado);
    if($result != null){
        $titulo = $result->getTitulo();
        $criador = $result->getCriador();
        $numLinguagem = $result->getNumLinguagem();
        $numMatematica = $result->getNumMatematica();
        $numCienNatu = $result->getNumCienNatu();
        $numCienHum= $result->getNumCienHum();
        $inicio = $result->getDataInicio();
        $termino = $result->getDataTermino();

        $dadosOlimpiada = array(
            'titulo' => $titulo,
            'criador' => $criador,
            'numLinguagem' => $numLinguagem,
            'numMatematica' => $numMatematica,
            'numCienNatu' => $numCienNatu,
            'numCienHum' => $numCienHum,
            'inicio'=> $inicio,
            'termino'=> $termino
        );
        echo json_encode($dadosOlimpiada);
    } else {
        // Equipe não encontrada, retorna um JSON vazio (ou qualquer outro tratamento apropriado)
        echo json_encode(array('error' => 'Olimpiada não encontrada'));
    }

}
