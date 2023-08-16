<?php
require_once '../services/admDao.php'; // Inclua o seu arquivo DAO aqui

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome_admin"];
    $usuario = $_POST["usuario_admin"];
    $email = $_POST["email_admin"];
    $senha = $_POST["password_admin"];
    $permissao = $_POST["permissao_admin"];

    // Criptografar a senha antes de salvar no banco de dados

    // Cadastrar o administrador usando o DAO
    try {
        admDAO::cadastrarAdmin($nome, $email, $usuario, $senha, $permissao);
        echo "<script>alert('Administrador cadastrado!');</script>";
        header("Location: dashAdmins.php");
    } catch (Exception $e) {
        echo "Erro ao cadastrar o administrador: " . $e->getMessage();
    }
}
?>