<?php
require_once '../services/Questao.php';
require_once '../services/Questao1.php';
require_once '../services/negocioException.php';
require_once '../services/QuestaoDAO.php';

function buscaQuestaoPorId($id)
{
    $questoes = QuestaoDAO::listarQuestoes();
    $questaoEncontrada = null;

    foreach ($questoes as $questao) {
        // Ajuste na comparação de IDs (considerando que o ID seja um inteiro)
        if ($questao->getId() === (int)$id) {
            $questaoEncontrada = $questao;
            break; // Encontrou uma correspondência, não é necessário continuar o loop
        }
    }

    return $questaoEncontrada; // Retorna a equipe encontrada ou null se não encontrou nenhuma correspondência
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idQuestao'])) {
    $idQuestao = $_GET['idQuestao'];

    $result = buscaQuestaoPorId($idQuestao);

    if ($result != null) {
        // Debugging: Adicione essas linhas para verificar o que está sendo retornado
        // var_dump($result);
        // echo json_encode($result);

        $id = $result->getId();
        $area = $result->getArea();
        $nivel = $result->getNivel();
        $tempo = $result->getTempo();
        $corpo = $result->getCorpoQuestao();
        $alt1 = $result->getAlternativa1();
        $alt2 = $result->getAlternativa2();
        $alt3 = $result->getAlternativa3();
        $alt4 = $result->getAlternativa4();
        $altCorreta = $result->getAlternativaCorreta();
        $autor = $result->getAutor();

        $dadosQuestao = array(
            'id' => $id,
            'area' => $area,
            'nivel' => $nivel,
            'tempo' => $tempo,
            'corpo' => $corpo,
            'alt1' => $alt1,
            'alt2' => $alt2,
            'alt3' => $alt3,
            'alt4' => $alt4,
            'altCorreta' => $altCorreta,
            'autor' => $autor,
        );

        echo json_encode($dadosQuestao);
    } else {
        // Equipe não encontrada, retorna um JSON vazio (ou qualquer outro tratamento apropriado)
        echo json_encode(array('error' => 'Questao não encontrada'));
    }
}