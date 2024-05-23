<?php 

// Inicio de sessão
session_start();

// Carregamento das rotas primitivas
$rotas_primitivas = require_once __DIR__ ."/../inc/rotas.php";

// Definição de rota
$rota = $_GET['rota'] ?? 'home';// A variavel ira buscar pela 'rota' se não existir será sempre 'home'

// Verifica se o usuario está logado
if(!isset($_SESSION['usuario']) && $rota !=='login_submit' && $rota !== 'registrar' && $rota !== 'registrar_submit') {
    $rota = "login";
}

// Se o usuario está logado e tenta entrar no loggin..
if(isset($_SESSION['usuario']) && $rota === 'login') {
    $rota = 'home';
}

// se a rota não existe
if(!in_array($rota, $rotas_primitivas)){
    $rota = '404';
}

// Preparação da pagina
$script = null;
switch($rota) {
    case '404':
        $script ='404.php';
        break;

    case   'login':
        $script = 'login.php';
        break;
    case   'login_submit':
        $script = 'login_submit.php';//Receber submissão do formulario
        break;    

    case   'home': 
        $script = 'home.php';   
        break; 
    case    'registrar':
        $script = 'registrar.php';
        break;  
    case    'registrar_submit':
        $script = 'registrar_submit.php';
        break;        
            
}


//Carregamentos de scripts que sempre existirão PERMANENTES
require_once __DIR__ .'/../inc/config.php';
require_once __DIR__ .'/../inc/database.php';



//Apresentação da pagina
require_once __DIR__ .'/../inc/header.php';
require_once __DIR__ ."/../scripts/$script";
require_once __DIR__ .'/../inc/footer.php';