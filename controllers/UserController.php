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
            $_SESSION['input'] = ['name' => $username];
            redirect("?action=user-create");
        }
        
        [$avatarPath, $avatarError] = imageCheck($_FILES['avatar'], 400, 400, './assets/images/avatars/', './assets/images/avatars/default.png');
        if ($avatarError) {
            $_SESSION['error_message'] = $avatarError;
            $_SESSION['input'] = ['name' => $username];
            redirect("?action=user-create");
        }

        [$bannerPath, $bannerError] = imageCheck($_FILES['banner'], 1920, 500, './assets/images/banners/', './assets/images/banners/default.png');
        if ($bannerError) {
            $_SESSION['error_message'] = $bannerError;
            $_SESSION['input'] = ['name' => $username];
            redirect("?action=user-create");
        }

        // si tout est validé, l'utilisateur est crée
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
        $currentUser = $this->userRepo->getUserById($_POST['id']);
        $name = $_POST['name'] ?? $currentUser->getUsername();
        $pw = !empty($_POST['pw']) 
            ? password_hash($_POST['pw'], PASSWORD_DEFAULT) 
            : $currentUser->getPassword();
        $defaultAvatar = isset($_POST['removeAvatar']) && $_POST['removeAvatar'] === '1';
        $defaultBanner = isset($_POST['removeBanner']) && $_POST['removeBanner'] === '1';

        // 1 - si "remove current avatar" est coché, remplace par l'avatar par défaut
        if ($defaultAvatar) {
            $avatarPath = './assets/images/avatars/default.png';
        // 2 - vérifie la validité du nouveau (potentiel) fichier
        } elseif ($_FILES['avatar']['error'] === UPLOAD_ERR_OK && $_FILES['avatar']['size'] > 0) {
            [$avatarPath, $avatarError] = imageCheck($_FILES['avatar'], 400, 400, './assets/images/avatars/', './assets/images/avatars/default.png');
            if ($avatarError) {
                $_SESSION['error_message'] = $avatarError;
                redirect("?action=user-edit&id=" . $_POST['id']);
            }
        } else {
        // 3 - utilise l'image actuelle si rien n'est retourné dans le POST
            $avatarPath = $currentUser->getAvatarPath();
        }

        if ($defaultBanner) {
            $bannerPath = './assets/images/banners/default.png';
        } elseif ($_FILES['banner']['error'] === UPLOAD_ERR_OK && $_FILES['banner']['size'] > 0) {
            [$bannerPath, $bannerError] = imageCheck($_FILES['banner'], 1920, 500, './assets/images/banners/', './assets/images/banners/default.png');
            if ($bannerError) {
                $_SESSION['error_message'] = $bannerError;
                redirect("?action=user-edit&id=" . $_POST['id']);
            }
        } else {
            $bannerPath = $currentUser->getBannerPath(); // keep current one
        }

        $isAdmin = isset($_POST['isAdmin']) ? true : false;

        // if every check is successful
        $user = new User($name, $pw, $avatarPath, $bannerPath, $isAdmin);
        $user->setId($_POST['id']);
        $this->userRepo->update($user);

        redirect("?action=user-list");
    }

    public function delete(int $id) {
        // requireAdmin();
        $this->userRepo->delete($id);

        redirect("?action=user-list");
    }
}