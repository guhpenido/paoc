<?php
require_once '../services/Simulado.php';
require_once '../services/SimuladoDAO.php';
 // Certifique-se de incluir o arquivo correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $criador= $_POST['criador_questao'];
    $titulo = $_POST['titulo_olim'];
    $numLinguagem = $_POST['numLinguagem'];
    $numMatematica = $_POST['numMatematica'];
    $numCienNatu = $_POST['numCienNatu'];
    $numCienHum = $_POST['numCienHum'];
    $inicio = $_POST['data_inicio'];
    $termino = $_POST['data_final'];

    // Instanciar o objeto DTO
    $simu = new Simulado($titulo, $criador, $numLinguagem, $numMatematica, $numCienNatu, $numCienHum, $inicio, $termino);

    try {
        SimuladoDAO::inserirSimulado($simu);
        echo "<script>alert('Simulado cadastrado!');</script>";
        header("Location: dashboard.php");
    } catch (Exception $e) {
        echo "Erro ao cadastrar o simulado: " . $e->getMessage();
    }
}
