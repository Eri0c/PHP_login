<?php
// Verifica se aconteceu um POST
if($_SERVER['REQUEST_METHOD'] !== 'POST'){//Se usuario tentar acessar login_submit, sem que seja atraves do formulario POST, será redirecionado para a pagina de login.
    header('Location: index.php?rota=login');
    exit; 
}

// Vai buscar os dados do POST
$usuario = $_POST['text_usuario'] ?? null;
$senha = $_POST['text_senha'] ?? null;

//Verifica se os dados estão preenchidos 
if(empty($usuario) || empty($senha)){ //Basta que um dos dois nao exista para ter um erro
    header('Location: index.php?rota=login');
    exit;
}

// A class da base de dados já está carregada no index.php
$db = new database();
$params = [
    ':usuario' => $usuario//definindo os parametros para o pdo
];
$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";//Filtrando a informação passada pelo campo usuario que sera inserido na DataBase Evitando um texto malicioso
$result =$db->query($sql, $params);

// Verifica se aconteceu um erro
if($result['status'] === 'error'){
    header('Location: index.php?rota=404');
    exit;
}

//Verifica se o usuario existe
if(count($result['data']) === 0 ){
    //Erro na sessão
    $_SESSION['error'] = 'Usuario ou senha inválidos';

    header('Location: index.php?rota=login');
    exit;
}

//Verifica se a senha  existe
if(!password_verify($senha, $result['data'][0]->senha)){
    //Erro na sessão
    $_SESSION['error'] = 'Usuario ou senha inválidos';

    header('Location: index.php?rota=login');
    exit;
}

// Define a sessão do usuário
$_SESSION['usuario'] = $result['data'][0]->usuario;

// redirecionar para a pagina inicial 
header('Location: index.php?rota=home');
