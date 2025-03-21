<?php
require_once '../services/Equipe.php';
require_once '../services/negocioException.php';
require_once '../services/equipes.php';
require_once './emailAprova.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nomeEquipe']) && isset($_GET['cursoEquipe'])) {
    $nomeEquipe = $_GET['nomeEquipe'];
    $cursoEquipe = $_GET['cursoEquipe'];

    // Chamar a função de aprovarEquipe da classe EquipesDAO passando o nome e curso da equipe
    $aprovacao = EquipesDAO::aprovarEquipe($nomeEquipe, $cursoEquipe);

    if ($aprovacao) {
        // A equipe foi aprovada com sucesso
        echo json_encode(array('success' => true));
        EmailAprova::emailAprova($nomeEquipe, $cursoEquipe);
        
        // Aqui você pode adicionar qualquer tratamento adicional ou resposta que desejar enviar ao cliente
    } else {
        // A equipe não foi encontrada ou não pôde ser aprovada
        echo json_encode(array('success' => false));
        // Aqui você pode adicionar qualquer tratamento adicional ou resposta de erro que desejar enviar ao cliente
    }
}
?>