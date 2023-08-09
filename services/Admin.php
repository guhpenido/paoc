<?php
class Admin {
    private $nome;
    private $username;
    private $email;
    private $senha;
    private $permissao;

    public function __construct($nome, $username, $email, $senha, $permissao) {
        $this->nome = $nome;
        $this->username = $username;
        $this->email = $email;
        $this->senha = $senha;
        $this->permissao = $permissao;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }
    public function getPermissao() {
        return $this->permissao;
    }
}
?>