<?php
require_once '../services/Simulado.php';
require_once '../services/Simulado1.php';
require_once '../services/negocioException.php';
require_once '../services/SimuladoDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idSimulado'])) {
   $idSimulado = $_GET['idSimulado'];

    // Chamar a função de aprovarEquipe da classe EquipesDAO passando o nome e curso da equipe
    $exclusao = SimuladoDAO::excluirSimuladoPorId($idSimulado);

    if ($exclusao) {
        // A equipe foi aprovada com sucesso
        echo json_encode(array('success' => true));
        
        // Aqui você pode adicionar qualquer tratamento adicional ou resposta que desejar enviar ao cliente
    } else {
        // A equipe não foi encontrada ou não pôde ser aprovada
        echo json_encode(array('success' => false));
        // Aqui você pode adicionar qualquer tratamento adicional ou resposta de erro que desejar enviar ao cliente
    }
}
?>