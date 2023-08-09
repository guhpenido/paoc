<?php

require_once 'Conexao.php';
require_once 'Admin.php';
require_once 'negocioException.php';
require_once 'persistenciaException.php';

class admDAO {

    public static function listarAdmBD() {
        $listaAdmin = array();
        $sql = "SELECT * FROM administradores";
        $com = Conexao::getConnection()->prepare($sql);
        $com->execute();

        while ($row = $com->fetch(PDO::FETCH_ASSOC)) {
            $id = (int)$row["id"];
            $nome = $row["nome"];
            $email = $row["email"];
            $username = $row["usuario"];
            $senha = $row["senha"];
            $permissao = $row["permissao"];

            $a = new Admin($nome, $username, $email, $senha, $permissao);
            $listaAdmin[] = $a;
        }
        
        if (!empty($listaAdmin)) {
            return $listaAdmin;
        }
        
        return null;
    }

    public static function criptografarSenha($senha) {
        return hash('sha256', $senha);
    }

    public static function procurarAdmin($username) {
        $listaAdmins = self::listarAdmBD();

        if (!empty($listaAdmins)) {
            foreach ($listaAdmins as $a) {
                if ($a->getUsername() === $username) {
                    return $a;
                }
            }
        }

        return null;
    }

    public static function cadastrarAdmin($nome, $email, $username, $senhaPura, $permissao) {
        try {
            if (self::procurarAdmin($username) === null || self::listarAdmBD() === null) {
                $senha = $senhaPura;
                $connection = Conexao::getConnection();
                $sql = "INSERT INTO administradores (nome, usuario, email, senha, permissao) VALUES (?, ?, ?, ?, ?)";
                $pstmt = $connection->prepare($sql);
                $pstmt->bindParam(1, $nome, PDO::PARAM_STR);
                $pstmt->bindParam(2, $username, PDO::PARAM_STR);
                $pstmt->bindParam(3, $email, PDO::PARAM_STR);
                $pstmt->bindParam(4, $senha, PDO::PARAM_STR);
                $pstmt->bindParam(5, $permissao, PDO::PARAM_STR);
                $pstmt->execute();
                echo "Administrador cadastrado com sucesso!";
                $pstmt->closeCursor();
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public static function removerAdmin($username) {
        try {
            $admin = self::procurarAdmin($username);
            if ($admin !== null) {
                $sql = "DELETE FROM administradores WHERE usuario = ?";
                $com = Conexao::getConnection()->prepare($sql);
                $com->bindParam(1, $username, PDO::PARAM_STR);
                $com->execute();
                echo "Admin removido com sucesso!";
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public static function logarAdmin($username, $senha) {
        try {
            $sql = "SELECT * FROM administradores WHERE usuario = ?";
            $com = Conexao::getConnection()->prepare($sql);
            $com->bindParam(1, $username, PDO::PARAM_STR);
            $com->execute();
            $row = $com->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                // Verificar a senha criptografada no banco de dados
                if ($row["senha"] === $senha) {
                    $nome = $row["nome"];
                    $email = $row["email"];
                    $usuario = $row["usuario"];
                    $senhaa = $row["senha"];
                    $permissao = $row["permissao"];
                    $a = new Admin($nome, $usuario, $email, $senhaa, $permissao);
                    return $a;
                } else {
                    throw new persistenciaException("Senha incorreta!");
                }
            } else {
                throw new persistenciaException("Usuário não encontrado!");
            }
        } catch (Exception $e) {
            throw new persistenciaException("Erro ao realizar login: " . $e->getMessage());
        }
    }
}
