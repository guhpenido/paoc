<?php
require_once '../services/Questao.php';
require_once '../services/Questao1.php';
require_once '../services/negocioException.php';
require_once '../services/QuestaoDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idQuestao'])) {
    $idQuestao = $_GET['idQuestao'];

    // Chamar a função de aprovarEquipe da classe EquipesDAO passando o nome e curso da equipe
    $exclusao = QuestaoDAO::excluirQuestaoPorId($idQuestao);

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