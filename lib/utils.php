<?php
    function redirect(string $action) {
            header('Location: ' . $action);
            exit;
    }

    function isConnected() {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    function isAdmin() {
        if (isset($_SESSION['user']['is_admin'])) {
            return true;
        }
        return false;
    }

    function requireAdmin() {
        if (!isAdmin()) {
            redirect("?action=no-access");
        }
    }

    function imageCheck($file, $minWidth, $minHeight, $folderPath, $defaultPath) {
        // retourne $defaultPath si le fichier n'est pas "set" sous forme de tableau [value, error]
        if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return [$defaultPath, null];
        }

        // si autre erreur, renvoie un message d'erreur
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return [null, 'file upload failed'];
        }   

        $tmp = $file['tmp_name']; // nom temporaire du fichier sur le serveur
        $mime = mime_content_type($tmp); // type du fichier media

        // vérifie si le mime est une image jpeg/png
        if(!in_array($mime, ['image/jpeg', 'image/png'])) {
            return [null, 'only jpeg/png files are allowed.'];
        }

        [$width, $height] = getimagesize($tmp); // récupère la hauteur/largeur du fichier
        // vérifie si la hauteur/largeur récupérée est supérieure aux dimensions minimales
        if ($width < $minWidth || $height < $minHeight) {
            return [null, "image must be at least {$minWidth}x{$minHeight}."];
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . "." . $ext;
        $filePath = $folderPath . $fileName;

        // vérifie si le dossier existe, sinon le crée avec les autorisations nécessaires
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        if (!move_uploaded_file($tmp, $filePath)) {
            return [null, "Failed to save the file."];
        }

        return [$filePath, null];
    }
?>