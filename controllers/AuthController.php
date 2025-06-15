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
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'is_admin' => $user->isAdmin(),
                'avatar' => $user->getAvatarPath(),
                'banner' => $user->getBannerPath()
            ];
            if ($user->isAdmin()){
                redirect("?action=admin-dashboard");
            } else {
                redirect("?");
            }
        } else {
            $_SESSION['error_message'] = "error: wrong username or password.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        redirect("?action=login");
    }
}