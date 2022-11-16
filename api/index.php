<?php
header('Content-type: application/json');
$dadosRecebidos = file_get_contents('php://input');

$dadosRecebidos = json_decode($dadosRecebidos);

$result = [
    'result' => false,
    'data' => '',
    'error' =>''     
];

require_once 'class/Usuario.php';
if($dadosRecebidos->acao == 'cadastrar'){
    $usuario = new Usuario();
    $usuario->email = $dadosRecebidos->email;
    $usuario->senha = $dadosRecebidos->senha;
    $usuario->nome = $dadosRecebidos->nome; 
    
    if($usuario->cadastrar()){
        $result['result'] = true;
        $result['data'] = $usuario;
    }
    else{        
        $result['result'] = false;
        $result['error'] = 'Erro de  cadastro';
    }
}


// if($dadosRecebidos['acao'] == 'alterar'){
//     $usuario = new usuarioinistrador();
//     $usuario->matricula = $dadosRecebidos['matricula'];
//     $usuario->email = $dadosRecebidos['email'];
//     $usuario->senha = $dadosRecebidos['senha'];
//     $usuario->nome = $dadosRecebidos['nome'];    

//     if($usuario->alterar()){
//         $result['result'] = true;
//         $result['data'] = $usuario;
//     }
//     else
//     {
//         if(!$usuario->consultarPorMatricula($dadosRecebidos['matricula'])){
//             $result['error'] = 'Matrícula não encontrada';
//         }
//         else{
//             $result['error'] = 'Erro de alteração inesperado';
//         }
//     }
// }
// if($dadosRecebidos['acao'] == 'alterarSenha'){
//     $usuario = new usuarioinistrador();
//     $usuario->matricula = $dadosRecebidos['matricula'];
//     $usuario->senha = $dadosRecebidos['senha'];           
//     if($usuario->alterarSenha()){
//         $usuario->consultarPorMatricula($dadosRecebidos['matricula']);
//         $result['result'] = true;
//         $result['data'] = $usuario;
//     }
//     else
//     {
//         if(!$usuario->consultarPorMatricula($dadosRecebidos['matricula'])){
//             $result['error'] = 'Matrícula não encontrada';
//         }
//         else{
//             $result['error'] = 'Erro inesperado';
//         }
//     }
// }
// if($dadosRecebidos['acao'] == 'delete'){
//     $usuario = new usuarioinistrador();
//     if($usuario->delete($dadosRecebidos['matricula'])){
//         $result['result'] = true;        
//     }
//     else
//     {
//         if(!$usuario->consultarPorMatricula($dadosRecebidos['matricula'])){
//             $result['error'] = 'Matrícula não encontrada';
//         }
//         else{
//             $result['error'] = 'Erro inesperado';
//         }
//     }               
    
// }
// elseif($dadosRecebidos['acao'] == 'consutarTodos'){
//     $usuario = new usuarioinistrador();
//     $filtro = $dadosRecebidos['filtro'];
//     $dados = $usuario->consultarTodos($filtro);                
//     if($dados){
//         $result['result'] = true;
//         $result['data'] = $dados;
//     }            
// }
// elseif($dadosRecebidos['acao'] == 'consutarPorEmail'){
//     $usuario = new usuarioinistrador();
//     $email = $dadosRecebidos['email'];        
//     $result['result'] = false;                  
//     $result['data'] = "";                  
//     if($usuario->consultarPorEmail($email)){
//         $result['result'] = true;
//         $result['data'] = $usuario;
//     }        
// }
// elseif($dadosRecebidos['acao'] == 'consutarPorMatricula'){
//     $usuario = new usuarioinistrador();
//     $matric = $dadosRecebidos['matricula'];
//     $result['result'] = false;                  
//     $result['data'] = "";                  
//     if($usuario->consultarPorMatricula($matric)){
//         $result['result'] = true;
//         $result['data'] = $usuario;
//     }        
// }
// elseif($dadosRecebidos['acao'] == 'logar'){
//     $usuario = new usuarioinistrador();
//     $usuario = $dadosRecebidos['usuario'];
//     $senha = $dadosRecebidos['senha'];
//     $result['result'] = false;                  
//     $result['data'] = "";                  
//     if($usuario->login($usuario,$senha)){
//         $result['result'] = true;
//         $result['data'] = $usuario;
//     }        
// }

echo json_encode($result);