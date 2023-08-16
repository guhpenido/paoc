<?php

require_once 'Conexao.php'; // Incluir o arquivo que possui a classe de conexão
require_once 'Equipe.php';
require_once 'Email.php';
class EquipesDAO
{

    public static function listarEquipesBD()
    {
        $listaEquipes = array();
        $sql = "SELECT * FROM equipe";
        $com = Conexao::getConnection()->prepare($sql);
        $com->execute();
        $resultados = $com->fetchAll(PDO::FETCH_ASSOC);

        $primeiroRow = true; // Variável de controle para verificar o primeiro row

        foreach ($resultados as $row) {
            if ($primeiroRow) {
                $primeiroRow = false;
                continue; // Pula para a próxima iteração sem processar o primeiro row
            }

            // Resto do código para processar os dados, igual ao original
            $id = intval($row['id']);
            $nome = $row['nome'];
            $curso = $row['curso'];
            $nome_responsavel = $row['nome_responsavel'];
            $email_responsavel = $row['email_responsavel'];
            $nome_capitao = $row['nome_capitao'];
            $email_capitao = $row['email_capitao'];
            $matricula_capitao = $row['matricula_capitao'];
            $nome_int1 = $row['nome_int1'];
            $email_int1 = $row['email_int1'];
            $matricula_int1 = $row['matricula_int1'];
            $nome_int2 = $row['nome_int2'];
            $email_int2 = $row['email_int2'];
            $matricula_int2 = $row['matricula_int2'];
            $nome_int3 = $row['nome_int3'];
            $email_int3 = $row['email_int3'];
            $matricula_int3 = $row['matricula_int3'];
            $nome_int4 = $row['nome_int4'];
            $email_int4 = $row['email_int4'];
            $matricula_int4 = $row['matricula_int4'];
            $nome_int5 = $row['nome_int5'];
            $email_int5 = $row['email_int5'];
            $matricula_int5 = $row['matricula_int5'];
            $status = $row['status'];

            $equipe = new Equipe($id, $nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5, $status);

            $listaEquipes[] = $equipe;
        }


        if (!empty($listaEquipes)) {
            return $listaEquipes;
        }

        return null;
    }

    public static function criptografarSenha($senha)
    {
        return hash('sha256', $senha); // SHA-256 é o equivalente ao algoritmo usado no Java
    }

    public static function procurarEquipe($nome)
    {
        $listaEquipes = self::listarEquipesBD();

        if ($listaEquipes !== null) {
            foreach ($listaEquipes as $equipe) {
                if ($equipe->getNome() === $nome) {
                    return $equipe;
                }
            }
        }

        return null;
    }

    public static function cadastrarEquipe($nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5)
    {
        if (self::procurarEquipe($nome) === null || self::listarEquipesBD() === null) {
            $sql = "INSERT INTO equipe (nome, curso, nome_responsavel, email_responsavel, nome_capitao, email_capitao, matricula_capitao, nome_int1, email_int1, matricula_int1, nome_int2, email_int2, matricula_int2, nome_int3, email_int3, matricula_int3, nome_int4, email_int4, matricula_int4, nome_int5, email_int5, matricula_int5, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $com = Conexao::getConnection()->prepare($sql);
                $com->bindParam(1, $nome);
                $com->bindParam(2, $curso);
                $com->bindParam(3, $nome_responsavel);
                $com->bindParam(4, $email_responsavel);
                $com->bindParam(5, $nome_capitao);
                $com->bindParam(6, $email_capitao);
                $com->bindParam(7, $matricula_capitao);
                $com->bindParam(8, $nome_int1);
                $com->bindParam(9, $email_int1);
                $com->bindParam(10, $matricula_int1);
                $com->bindParam(11, $nome_int2);
                $com->bindParam(12, $email_int2);
                $com->bindParam(13, $matricula_int2);
                $com->bindParam(14, $nome_int3);
                $com->bindParam(15, $email_int3);
                $com->bindParam(16, $matricula_int3);
                $com->bindParam(17, $nome_int4);
                $com->bindParam(18, $email_int4);
                $com->bindParam(19, $matricula_int4);
                $com->bindParam(20, $nome_int5);
                $com->bindParam(21, $email_int5);
                $com->bindParam(22, $matricula_int5);
                $com->bindValue(23, "Pendente");

                $com->execute();
                $id = "0";
                $equipe = new Equipe($id, $nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5, "Pendente");

                
                echo "Registro inserido com sucesso!";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public static function removerEquipe($nome)
    {
        if (self::procurarEquipe($nome) !== null) {
            $sql = "DELETE FROM equipe WHERE nome=:nome";
            try {
                $com = Conexao::getConnection()->prepare($sql);
                $com->bindParam(':nome', $nome);
                $com->execute();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public static function aprovarEquipe($nome, $curso)
    {
        $equipe = self::procurarEquipePorNomeECurso($nome, $curso);

        if ($equipe !== null) {
            $sql = "UPDATE equipe SET status=:status WHERE nome=:nome AND curso=:curso";
            $status = "Aprovada";
            try {
                $com = Conexao::getConnection()->prepare($sql);
                $com->bindParam(':status', $status);
                $com->bindParam(':nome', $nome);
                $com->bindParam(':curso', $curso);
                $com->execute();
                echo "Equipe aprovada com sucesso!";
                return true;
            } catch (PDOException $e) {
                echo "Erro ao aprovar equipe: " . $e->getMessage();
                return false;
            }
        } else {
            echo "Equipe não encontrada!";
            return null;
        }
    }

    public static function procurarEquipePorNomeECurso($nome, $curso)
    {
        $listaEquipes = self::listarEquipesBD();

        if ($listaEquipes !== null) {
            foreach ($listaEquipes as $equipe) {
                if ($equipe->getNome() === $nome && $equipe->getCurso() === $curso) {
                    return $equipe;
                }
            }
        }

        return null;
    }
}
