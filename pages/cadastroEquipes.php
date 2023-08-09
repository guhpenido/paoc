<?php
require_once '../services/Equipe.php';
require_once '../services/negocioException.php';
require_once '../services/servicoEquipes.php';

try {
    $nome = $_POST["nome_equipe"];
    $curso = $_POST["curso"];
    $nome_responsavel = $_POST["nome_responsavel"];
    $email_responsavel = $_POST["email_responsavel"];
    $nome_capitao = $_POST["nome_capitao"];
    $email_capitao = $_POST["email_capitao"];
    $matricula_capitao = $_POST["matricula_capitao"];
    $nome_int1 = $_POST["nome_integrante1"];
    $email_int1 = $_POST["email_integrante1"];
    $matricula_int1 = $_POST["matricula_integrante1"];
    $nome_int2 = $_POST["nome_integrante2"];
    $email_int2 = $_POST["email_integrante2"];
    $matricula_int2 = $_POST["matricula_integrante2"];
    $nome_int3 = $_POST["nome_integrante3"];
    $email_int3 = $_POST["email_integrante3"];
    $matricula_int3 = $_POST["matricula_integrante3"];
    $nome_int4 = $_POST["nome_integrante4"];
    $email_int4 = $_POST["email_integrante4"];
    $matricula_int4 = $_POST["matricula_integrante4"];
    $nome_int5 = $_POST["nome_integrante5"];
    $email_int5 = $_POST["email_integrante5"];
    $matricula_int5 = $_POST["matricula_integrante5"];

    $equipes = ServicoEquipes::listarEquipes();
    if ($equipes != null) {
        $matriculas = array();
        $matriculasBD = array();
        $nomesBD = array();

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
        foreach ($equipes as $equipe) {
            $nm = $equipe->getNome();
            $nomesBD[] = $nm;
        }

        $matriculasExistem = false;
        $nomeExiste = false;
        $cursoMaisDeDois = false;
        foreach ($matriculas as $elemento) {
            if (in_array($elemento, $matriculasBD)) {
                $matriculasExistem = true;
                break;
            }
        }
        if (in_array($nome, $nomesBD)) {
            $nomeExiste = true;
        }

        $contadorCursos = array();
        foreach ($equipes as $equipe) {
            $nomeCurso = $equipe->getCurso();
            $contadorCursos[$nomeCurso] = isset($contadorCursos[$nomeCurso]) ? $contadorCursos[$nomeCurso] + 1 : 1;
        }
        $cursoProcurado = $curso;
        $ocorrencias = isset($contadorCursos[$cursoProcurado]) ? $contadorCursos[$cursoProcurado] : 0;
        if ($ocorrencias >= 2) {
            $cursoMaisDeDois = true;
        }

        if ($matriculasExistem) {
            throw new negocioException("Essas matrículas já estão cadastradas.");
        } else if ($nomeExiste) {
            throw new negocioException("Já existe uma equipe com esse nome.");
        } else if ($cursoMaisDeDois) {
            throw new negocioException("Já existem duas equipes do seu curso.");
        } else {
            // Proceed with the team creation
            ServicoEquipes::cadastrarEquipe($nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5, $curso);
            
            $id = "0";
            $equipe = new Equipe($id, $nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao, $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2, $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4, $nome_int5, $email_int5, $matricula_int5, "Pendente");
            EmailDAO::sendEmail($equipe);

            // Inicia a sessão
            session_start();
            $_SESSION["nomeEquipe"] = $nome;

            // Redireciona para a página de sucesso
            header("Location: sucesso.php");
        }
    }
} catch (negocioException $ex) {
    // Handle custom business logic exceptions
    echo "Erro: " . $ex->getMessage();
} catch (Exception $ex) {
    // Handle other exceptions here
    echo "Ocorreu um erro inesperado: " . $ex->getMessage();
}
