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

    public function view(int $id) {
        // requireAdmin();
        
        $user = $this->userRepo->getUser($id);
        require_once __DIR__ . '/../views/user/view.php';
    }

    public function create() {
        // requireAdmin();
        require_once __DIR__ . '/../views/user/create.php';
    }

    public function add() {
        // requireAdmin();
        $user = new User($_POST['name'], $_POST['pw'], $_POST['avatar'], $_POST['banner'], $_POST['isAdmin']);
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