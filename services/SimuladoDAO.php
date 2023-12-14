<?php
require_once 'Simulado.php';
require_once 'Simulado1.php';
require_once 'Conexao.php';
require_once 'persistenciaException.php';

class SimuladoDAO
{

    public static function inserirSimulado(Simulado $simulado)
    {
        try {
            $sql = "INSERT INTO simulados (titulo, criador, numLinguagem, numMatematica, numCienNatu, numCienHum, inicio, termino) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $connection = Conexao::getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $simulado->titulo, PDO::PARAM_STR);
            $stmt->bindValue(2, $simulado->criador, PDO::PARAM_STR);
            $stmt->bindValue(3, $simulado->numLinguagem, PDO::PARAM_INT);
            $stmt->bindValue(4, $simulado->numMatematica, PDO::PARAM_INT);
            $stmt->bindValue(5, $simulado->numCienNatu, PDO::PARAM_INT);
            $stmt->bindValue(6, $simulado->numCienHum, PDO::PARAM_INT);
            $stmt->bindValue(7, $simulado->dataInicio, PDO::PARAM_STR);
            $stmt->bindValue(8, $simulado->dataTermino, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Trate a exceção aqui, por exemplo, lançando um objeto de exceção personalizado
            throw new persistenciaException("Erro ao inserir simulado: " . $e->getMessage());
        }
    }

    public static function listarSimulados()
    {
        $listaSimulados = array();
        $sql = "SELECT * FROM simulados";
        $com = Conexao::getConnection()->prepare($sql);
        $com->execute();

        while ($row = $com->fetch(PDO::FETCH_ASSOC)) {
            $dataInicio = new DateTime($row['inicio']);
            $dataTermino = new DateTime($row['termino']);

            $simulado = new Simulado1(
                $row['id'],
                $row['titulo'],
                $row['criador'],
                $row['numLinguagem'],
                $row['numMatematica'],
                $row['numCienNatu'],
                $row['numCienHum'],
                $dataInicio->format('d/m/Y - H:i'),
                $dataTermino->format('d/m/Y - H:i')
            );
            $listaSimulados[] = $simulado;
        }

        if (!empty($listaSimulados)) {
            return $listaSimulados;
        }

        return null;
    }

    public static function excluirSimuladoPorId($id)
    {
        try {
            $sql = "DELETE FROM simulados WHERE id = ?";
            $connection = Conexao::getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new persistenciaException("Erro ao excluir simulado: " . $e->getMessage());
        }
    }
}
