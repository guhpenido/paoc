<?php
require_once '../services/QuestaoDAO.php';
require_once '../services/Questao.php';
require_once '../services/Questao1.php';
 // Certifique-se de incluir o arquivo correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $area = $_POST['area_questao'];
    $nivel = $_POST['nivel_questao'];
    $tempo = $_POST['tempo_questao'];
    $corpoQuestao = $_POST['enunciado_questao'];
    $alternativa1 = $_POST['alter1_questao'];
    $alternativa2 = $_POST['alter2_questao'];
    $alternativa3 = $_POST['alter3_questao'];
    $alternativa4 = $_POST['alter4_questao'];
    $alternativaCorreta = $_POST['resp_questao'];
    $altCorreta = "";
    if($alternativaCorreta === "Alternativa 1"){
        $altCorreta = $alternativa1;
    }else if($alternativaCorreta === "Alternativa 2"){
        $altCorreta = $alternativa2;
    }if($alternativaCorreta === "Alternativa 3"){
        $altCorreta = $alternativa3;
    }if($alternativaCorreta === "Alternativa 4"){
        $altCorreta = $alternativa4;
    }
    $autor = $_POST['criador_questao']; // Substitua pela maneira correta de obter o autor

    /*$uploadDir = '../uploads/'; // Pasta onde você deseja salvar as imagens
    $uploadedFile = $_FILES['imagem'];
    
    $uploadPath = $uploadDir . basename($uploadedFile['name']);
    
    if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
        echo 'Upload de imagem bem-sucedido! Caminho da imagem: ' . $uploadPath;
    } else {
        echo 'Erro ao fazer o upload da imagem.';
    }*/

    // Instanciar o objeto DTO
    $questao = new Questao1(
        $area,
        $nivel,
        $tempo,
        $corpoQuestao,
        $alternativa1,
        $alternativa2,
        $alternativa3,
        $alternativa4,
        $altCorreta,
        $autor
    );

    try {
        QuestaoDAO::inserirQuestao($questao);
        echo "<script>alert('Questão cadastrada!');</script>";
        header("Location: questoes.php");
    } catch (Exception $e) {
        echo "Erro ao cadastrar a questão: " . $e->getMessage();
    }
}
