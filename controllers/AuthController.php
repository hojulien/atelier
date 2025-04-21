<?php

require_once __DIR__ . '/../models/repositories/UserRepository.php';

class AuthController {
    private UserRepository $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function login() {
        require __DIR__ . '/../views/login.php';
    }

    public function doLogin() {
        $name = filter_input(INPUT_POST, 'name');
        $password = filter_input(INPUT_POST, 'pw');

        $user = $this->userRepo->getUserByUsername($name);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            if ($user->isAdmin()){
                $_SESSION['admin'] = true;
                redirect("?action=admin-dashboard");
            } else {
                redirect("?");
            }
        } else {
            $_SESSION['error_message'] = "Erreur: mot de passe ou adresse e-mail incorrect.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['admin']);
        redirect("?action=login");
    }
}