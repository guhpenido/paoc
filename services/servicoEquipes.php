<?php
require_once 'equipes.php';
require_once 'Equipe.php';
require_once 'negocioException.php';

class ServicoEquipes {

    public static function cadastrarEquipe($nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5, $status) {
        try {
            if (empty($nome)) {
                throw new negocioException(319, "Insira o nome!");
            }
            $equipes = self::listarEquipes();
            if ($equipes !== null) {
                $matriculas = array();
                $matriculasBD = array();
                $matriculas[] = $matricula_capitao;
                $matriculas[] = $matricula_int1;
                $matriculas[] = $matricula_int2;
                $matriculas[] = $matricula_int3;
                $matriculas[] = $matricula_int4;
                $matriculas[] = $matricula_int5;

                foreach ($equipes as $equipe) {
                    $mat1 = $equipe->getMatriculaInt1();
                    $mat2 = $equipe->getMatriculaInt2();
                    $mat3 = $equipe->getMatriculaInt3();
                    $mat4 = $equipe->getMatriculaInt4();
                    $mat5 = $equipe->getMatriculaInt5();
                    $matCAP = $equipe->getMatriculaCapitao();

                    $matriculasBD[] = $mat1;
                    $matriculasBD[] = $mat2;
                    $matriculasBD[] = $mat3;
                    $matriculasBD[] = $mat4;
                    $matriculasBD[] = $mat5;
                    $matriculasBD[] = $matCAP;
                }

                foreach ($matriculas as $elemento) {
                    if (in_array($elemento, $matriculasBD)) {
                        //
                    }
                }

                $contadorCursos = array();
                foreach ($equipes as $equipe) {
                    $nomeCurso = $equipe->getCurso();
                    $contadorCursos[$nomeCurso] = isset($contadorCursos[$nomeCurso]) ? $contadorCursos[$nomeCurso] + 1 : 1;
                }

                $cursoProcurado = $curso;
                $ocorrencias = isset($contadorCursos[$cursoProcurado]) ? $contadorCursos[$cursoProcurado] : 0;
                if ($ocorrencias >= 2) {
                    throw new negocioException(319, "Limite de cursos atingidos");
                }
            }

            try {
                EquipesDAO::cadastrarEquipe($nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5);

            } catch (negocioException $ex) {
                echo "Caught negocioException: " . $ex->getMessage() . "\n";
                throw new negocioException(315, $ex->getMessage());
            }
        } catch (negocioException $ex) {
            throw new negocioException($ex->getCode(), $ex->getMessage());
        }
    }

    public static function listarEquipes() {
        try {
            $equipes = EquipesDAO::listarEquipesBD();
            if ($equipes === null) {
                throw new negocioException(315, "Não existem equipes cadastradas!");
            }
            return $equipes;
        } catch (negocioException $ex) {
            throw new negocioException(315, $ex->getMessage());
        }
    }
}
?>
