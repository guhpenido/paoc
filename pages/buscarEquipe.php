<?php
require_once '../services/Equipe.php';
require_once '../services/negocioException.php';
require_once '../services/servicoEquipes.php';
function buscaEquipePeloNomeeCurso($nome, $curso)
{
    $equipes = ServicoEquipes::listarEquipes();
    $equipeEncontrada = null;
    foreach ($equipes as $equipe) {
        if ($equipe->getNome() === $nome && $equipe->getCurso() === $curso) {
            $equipeEncontrada = $equipe;
            break; // Encontrou uma correspondência, não é necessário continuar o loop
        }
    }
    return $equipeEncontrada; // Retorna a equipe encontrada ou null se não encontrou nenhuma correspondência
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nomeEquipe']) && isset($_GET['cursoEquipe'])) {
    $nomeEquipe = $_GET['nomeEquipe'];
    $cursoEquipe = $_GET['cursoEquipe'];

    $result = buscaEquipePeloNomeeCurso($nomeEquipe, $cursoEquipe);
    if($result != null){
        $nome = $result->getNome();
        $curso = $result->getCurso();
        $nome_responsavel = $result->getNomeResponsavel();
        $email_responsavel = $result->getEmailResponsavel();
        $nome_capitao = $result->getNomeCapitao();
        $email_capitao = $result->getEmailCapitao();
        $matricula_capitao = $result->getMatriculaCapitao();
        $nome_int1 = $result->getNomeInt1();
        $email_int1 = $result->getEmailInt1();
        $matricula_int1 = $result->getMatriculaInt1();
        $nome_int2 = $result->getNomeInt2();
        $email_int2 = $result->getEmailInt2();
        $matricula_int2 = $result->getMatriculaInt2();
        $nome_int3 = $result->getNomeInt3();
        $email_int3 = $result->getEmailInt3();
        $matricula_int3 = $result->getMatriculaInt3();
        $nome_int4 = $result->getNomeInt4();
        $email_int4 = $result->getEmailInt4();
        $matricula_int4 = $result->getMatriculaInt4();
        $nome_int5 = $result->getNomeInt5();
        $email_int5 = $result->getEmailInt5();
        $matricula_int5 = $result->getMatriculaInt5();
        $status = $result->getStatus();
        $dadosEquipe = array(
            'nome' => $nome,
            'curso' => $curso,
            'nome_responsavel' => $nome_responsavel,
            'email_responsavel' => $email_responsavel,
            'nome_capitao' => $nome_capitao,
            'email_capitao' => $email_capitao,
            'matricula_capitao' => $matricula_capitao,
            'nome_int1' => $nome_int1,
            'email_int1' => $email_int1,
            'matricula_int1' => $matricula_int1,
            'nome_int2' => $nome_int2,
            'email_int2' => $email_int2,
            'matricula_int2' => $matricula_int2,
            'nome_int3' => $nome_int3,
            'email_int3' => $email_int3,
            'matricula_int3' => $matricula_int3,
            'nome_int4' => $nome_int4,
            'email_int4' => $email_int4,
            'matricula_int4' => $matricula_int4,
            'nome_int5' => $nome_int5,
            'email_int5' => $email_int5,
            'matricula_int5' => $matricula_int5,
            'status' => $status
        );
        echo json_encode($dadosEquipe);
    } else {
        // Equipe não encontrada, retorna um JSON vazio (ou qualquer outro tratamento apropriado)
        echo json_encode(array('error' => 'Equipe não encontrada'));
    }

}
