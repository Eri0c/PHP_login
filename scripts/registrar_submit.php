<?php 
// Verifica se aconteceu um POST
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
//Se usuario tentar acessar registrar_submit, sem que seja atraves do formulario POST, será redirecionado para a pagina de login.
    header('Location: index.php?rota=login');
    exit; 
}
// Vai buscar os dados do POST
$usuario = $_POST['registro_usuario'] ?? null;
$senha = $_POST['registro_senha'] ?? null;
$email = $_POST['registro_email'] ?? null;

//Verifica se os dados estão preenchidos
if(empty($usuario) || empty($senha) || empty($email)){
    $_SESSION['error'] = 'Todos os campos são obrigatórios';
    header('Location: index.php?rota=registrar');
    exit;    
}

//Validando email
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $_SESSION['error'] = 'Email inválido';
    header('Location: index.php?rota=registrar');
    exit;

//Validando requisitos de senha
}if(strlen($senha) < 8){
    $_SESSION['error'] = 'Senha é muito curta.';
    header('Location: index.php?rota=registrar');
    exit;
}
//Criação da instância da classe database
$db = new database();
$params = [
    ':usuario' =>   $usuario,
    ':email'=> $email
];

// Consulta SQL para veriricar se o usuario ou email ja estão cadastrados
$sql = "SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email";
$result = $db->query($sql, $params);

if($result['status'] === 'success' && count($result['data']) > 0) 
{
    foreach ( $result['data'] as $row){
        if ($row->usuario === $usuario){
            $_SESSION['error'] = 'Este usuário já existe.';
            header('Location: index.php?rota=registrar') ;
            exit;
            
    }else if($row->email === $email){
        $_SESSION['error'] = 'Este email já existe.';
        header('Location: index.php?rota=registrar');
        exit;
    }
    }
      
}


// Se passou port todas as verificações, insere o novo usuário na base de dados
$sql = "INSERT INTO usuarios(usuario,senha,email) VALUES(:usuario, :senha, :email)";
$params = [
    ':usuario' => $usuario,
    ':senha'=> $senha,
    'email'=> $email
];
$result = $db->query($sql, $params);

if($result['status'] === 'success'){
    header('Location: index.php?rota=login');
    $_SESSION['success'] = 'Registro realizado com sucesso!';
    
    exit;
} else{
    $_SESSION['error'] = "Erro ao registrar. Por favor, tente novamente.";
    header('Location: index.php?rota=registrar');
    exit;
}



