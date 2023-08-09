<?php
$username = $_REQUEST["username"];
$senha = $_REQUEST["senha"];

try {
    require_once '../services/admDao.php';
    require_once '../services/Admin.php';
    require_once '../services/persistenciaException.php';

    // Chama a função de login do admDAO
    $admin = admDAO::logarAdmin($username, $senha);

    // Inicia a sessão
    session_start();

    // Armazena o objeto Admin na sessão
    $_SESSION["admin"] = $admin;

    // Redireciona para a página de sucesso
    header("Location: dashboard.php"); // Replace with the correct path to dashboard.php
    exit;
} catch (persistenciaException $e) {
    // Em caso de falha no login, exibe a mensagem de erro
    $mensagemErro = $e->getMessage();
    session_start();
    $_SESSION["msg"] = $e->getMessage();
    require_once 'erro.php'; // Replace with the correct path to erro.jsp
    exit;
} catch (Exception $e) {
    // Em caso de outras exceções, trata o erro de forma genérica
    $mensagemErro = "Ocorreu um erro inesperado.";
    session_start();
    $_SESSION["msg"] = $e->getMessage();
    require_once 'erro.php'; // Replace with the correct path to erro.jsp
    exit;
}
?>
