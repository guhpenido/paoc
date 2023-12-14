<?php
require_once 'Questao.php';
require_once 'Questao1.php';
require_once 'Conexao.php';
require_once 'negocioException.php';
require_once 'persistenciaException.php';

class QuestaoDAO {

    public static function inserirQuestao(Questao1 $questao) {
        try {
            $sql = "INSERT INTO questoes (area, nivel, tempo, corpo_questao, alternativa1, alternativa2, alternativa3, alternativa4, alternativa_correta, autor) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
            $connection = Conexao::getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $questao->area, PDO::PARAM_STR);
            $stmt->bindValue(2, $questao->nivel, PDO::PARAM_STR);
            $stmt->bindValue(3, $questao->tempo, PDO::PARAM_INT);
            $stmt->bindValue(4, $questao->corpo_questao, PDO::PARAM_STR);
            $stmt->bindValue(5, $questao->alternativa1, PDO::PARAM_STR);
            $stmt->bindValue(6, $questao->alternativa2, PDO::PARAM_STR);
            $stmt->bindValue(7, $questao->alternativa3, PDO::PARAM_STR);
            $stmt->bindValue(8, $questao->alternativa4, PDO::PARAM_STR);
            $stmt->bindValue(9, $questao->alternativa_correta, PDO::PARAM_STR);
            $stmt->bindValue(10, $questao->autor, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Trate a exceção aqui, por exemplo, lançando um objeto de exceção personalizado
            throw new persistenciaException("Erro ao inserir questão: " . $e->getMessage());
        }
    }

    public static function listarQuestoes() {
        $listaQuestoes = array();
        $sql = "SELECT * FROM questoes";
        $com = Conexao::getConnection()->prepare($sql);
        $com->execute();

        while ($row = $com->fetch(PDO::FETCH_ASSOC)) {
            $questao = new Questao(
                $row['id'],
                $row['area'],
                $row['nivel'],
                $row['tempo'],
                $row['corpo_questao'],
                $row['alternativa1'],
                $row['alternativa2'],
                $row['alternativa3'],
                $row['alternativa4'],
                $row['alternativa_correta'],
                $row['autor']
            );
            $listaQuestoes[] = $questao;
        }

        if (!empty($listaQuestoes)) {
            return $listaQuestoes;
        }

        return null;
    }

    public static function excluirQuestaoPorId($id) {
        try {
            $sql = "DELETE FROM questoes WHERE id = ?";
            $connection = Conexao::getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new persistenciaException("Erro ao excluir questão: " . $e->getMessage());
        }
    }

}
