<?php

session_start();

require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$userC = new UserController();
$authC = new AuthController();

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($action) {
    case('home'):
        require_once __DIR__ . '/views/home.php';
        break;
    case('login'):
        $authC->login();
        break;
    case('doLogin'):
        $authC->doLogin();
        break;
    case('logout'):
        $authC->logout();
        break;
    // admin
    case('admin-dashboard');
        $userC->adminHome();
        break;
    // users
    case('user-list'):
        $userC->home();
        break;
    case('user-view'):
        $userC->view($id);
        break;
    // case('user-create'):
    //     $userC->create();
    //     break;   
    // case('user-add'):
    //     $userC->add();
    //     break;
    // case('user-edit'):
    //     $userC->edit($id);
    //     break;
    // case('user-update'):
    //     $userC->update();
    //     break;
    // case('user-delete'):
    //     $userC->delete($id);
    //     break;
    // NO ACCESS
    case('no-access'):
        require_once __DIR__ . '/views/no-access.php';
        break;
    default:
        $_SESSION['error'] = "Erreur 404";
        require_once __DIR__ . '/views/404.php';
}
 
?>