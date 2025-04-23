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
            redirect("?action=user-create&error=username_taken");
        }
        
        $user = new User($username, $hashPassword, null, null, false);
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