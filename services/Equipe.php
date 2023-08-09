<?php  
class Equipe {
    private $id;
    private $nome;
    private $curso;
    private $nome_responsavel;
    private $email_responsavel;
    private $nome_capitao;
    private $email_capitao;
    private $matricula_capitao;
    private $nome_int1;
    private $email_int1;
    private $matricula_int1;
    private $nome_int2;
    private $email_int2;
    private $matricula_int2;
    private $nome_int3;
    private $email_int3;
    private $matricula_int3;
    private $nome_int4;
    private $email_int4;
    private $matricula_int4;
    private $nome_int5;
    private $email_int5;
    private $matricula_int5;
    private $status;

    public function __construct(
        $id, $nome, $curso, $nome_responsavel, $email_responsavel, $nome_capitao, $email_capitao, $matricula_capitao,
        $nome_int1, $email_int1, $matricula_int1, $nome_int2, $email_int2, $matricula_int2,
        $nome_int3, $email_int3, $matricula_int3, $nome_int4, $email_int4, $matricula_int4,
        $nome_int5, $email_int5, $matricula_int5, $status
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->curso = $curso;
        $this->nome_responsavel = $nome_responsavel;
        $this->email_responsavel = $email_responsavel;
        $this->nome_capitao = $nome_capitao;
        $this->email_capitao = $email_capitao;
        $this->matricula_capitao = $matricula_capitao;
        $this->nome_int1 = $nome_int1;
        $this->email_int1 = $email_int1;
        $this->matricula_int1 = $matricula_int1;
        $this->nome_int2 = $nome_int2;
        $this->email_int2 = $email_int2;
        $this->matricula_int2 = $matricula_int2;
        $this->nome_int3 = $nome_int3;
        $this->email_int3 = $email_int3;
        $this->matricula_int3 = $matricula_int3;
        $this->nome_int4 = $nome_int4;
        $this->email_int4 = $email_int4;
        $this->matricula_int4 = $matricula_int4;
        $this->nome_int5 = $nome_int5;
        $this->email_int5 = $email_int5;
        $this->matricula_int5 = $matricula_int5;
        $this->status = $status;
    }
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getNomeResponsavel() {
        return $this->nome_responsavel;
    }

    public function getEmailResponsavel() {
        return $this->email_responsavel;
    }

    public function getNomeCapitao() {
        return $this->nome_capitao;
    }

    public function getEmailCapitao() {
        return $this->email_capitao;
    }

    public function getMatriculaCapitao() {
        return $this->matricula_capitao;
    }

    public function getNomeInt1() {
        return $this->nome_int1;
    }

    public function getEmailInt1() {
        return $this->email_int1;
    }

    public function getMatriculaInt1() {
        return $this->matricula_int1;
    }

    public function getNomeInt2() {
        return $this->nome_int2;
    }

    public function getEmailInt2() {
        return $this->email_int2;
    }

    public function getMatriculaInt2() {
        return $this->matricula_int2;
    }

    public function getNomeInt3() {
        return $this->nome_int3;
    }

    public function getEmailInt3() {
        return $this->email_int3;
    }

    public function getMatriculaInt3() {
        return $this->matricula_int3;
    }

    public function getNomeInt4() {
        return $this->nome_int4;
    }

    public function getEmailInt4() {
        return $this->email_int4;
    }

    public function getMatriculaInt4() {
        return $this->matricula_int4;
    }

    public function getNomeInt5() {
        return $this->nome_int5;
    }

    public function getEmailInt5() {
        return $this->email_int5;
    }

    public function getMatriculaInt5() {
        return $this->matricula_int5;
    }

    public function getStatus() {
        return $this->status;
    }
}

?>