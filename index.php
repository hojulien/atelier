<?php

require_once __DIR__ . '/controllers/UserController.php';

$userC = new UserController();

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($action) {
    case('home'):
        require_once __DIR__ . '/views/home.php';
        break;
    // users
    case('user-list'):
        $userC->home();
        break;
    case('user-view'):
        $userC->view($id);
        break;
    case('user-create'):
        $userC->create();
        break;   
    case('user-add'):
        $userC->add();
        break;
    case('user-edit'):
        $userC->edit($id);
        break;
    case('user-update'):
        $userC->update();
        break;
    case('user-delete'):
        $userC->delete($id);
        break;
    default:
        $_SESSION['error'] = "Erreur 404";
        require_once __DIR__ . '/views/404.php';
}
 
?>