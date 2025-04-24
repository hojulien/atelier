<?php

require_once __DIR__ . '/../models/repositories/UserRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../lib/utils.php';

class UserController {
    private UserRepository $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function home() {
        // requireAdmin();
        $users = $this->userRepo->getUsers();
        require_once __DIR__ . '/../views/user/list.php';
    }

    public function adminHome() {
        requireAdmin();
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function view(int $id) {
        // requireAdmin();
        
        $user = $this->userRepo->getUser($id);
        require_once __DIR__ . '/../views/user/view.php';
    }

    public function create() {
        // requireAdmin();
        require_once __DIR__ . '/../views/user/create-account.php';
    }

    public function add() {
        $username = $_POST['name'];
        $hashPassword = password_hash($_POST['pw'], PASSWORD_DEFAULT);

        // vérifie si l'username existe déjà dans la db
        if ($this->userRepo->usernameExists($username)) {
            $_SESSION['error_message'] = "this username is already taken.";
            redirect("?action=user-create");
        }
        
        [$avatarPath, $avatarError] = imageCheck($_FILES['avatar'], 400, 400, './assets/images/avatars/');
        if ($avatarError) {
            $_SESSION['error_message'] = $avatarError;
            redirect("?action=user-create");
        }

        [$bannerPath, $bannerError] = imageCheck($_FILES['banner'], 2000, 500, './assets/images/banners/');
        if ($bannerError) {
            $_SESSION['error_message'] = $bannerError;
            redirect("?action=user-create");
        }

        // Create and save user
        $user = new User($username, $hashPassword, $avatarPath, $bannerPath, false);
        $this->userRepo->create($user);

        redirect("?action=home");
    }

    public function edit(int $id) {
        // requireAdmin();
        $user = $this->userRepo->getUser($id);
        require_once __DIR__ . '/../views/user/edit.php';
    }

    public function update() {
        // requireAdmin();
        $userId = $_POST['id'];
        $user = new User($_POST['name'], $_POST['pw'], $_POST['avatar'], $_POST['banner'], $_POST['isAdmin']);
        $user->setId($userId);
        $this->userRepo->update($user);

        redirect("?action=user-list");
    }

    public function delete(int $id) {
        // requireAdmin();
        $this->userRepo->delete($id);

        redirect("?action=user-list");
    }
}