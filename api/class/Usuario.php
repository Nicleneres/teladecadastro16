<?php
require_once 'Conexao.php';
class Usuario{
    public $email;
    public $nome;
    public $senha;


    public function cadastrar(){
        $cx = new Conexao();
        $cmdSql = 'INSERT INTO usuario(email, nome, senha) VALUES (:email, :nome, :senha)';
        $this->senha = $this->criptografarSenha($this->senha);
        $dados = [ 
            ':email' => $this->email, 
            ':nome' => $this->nome,
            ':senha' => $this->senha
        ];

        if($cx->insert($cmdSql,$dados)){
            return true;
        }
        else{
            return false;
        }
    }



    private function criptografarSenha($senha): string{
        return password_hash($senha,PASSWORD_BCRYPT,['cost' => 12]);
    }

    private function decriptografarSenha($senha, $criptografia):bool{
        return password_verify($senha, $criptografia);
    }

    public function login($usuario,$senha):bool{
        if($this->consultarPorEmail($usuario) or $this->consultarPorMatricula($usuario)){
            return $this->decriptografarSenha($senha,$this->senha);
        }
        return false;
    }
}