<?php
    function redirect(string $action) {
            header('Location: ' . $action);
            exit;
    }

    function isConnected() {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    function isAdmin() {
        if (isset($_SESSION['admin'])) {
            return true;
        }
        return false;
    }

    function requireAdmin() {
        if (!isAdmin()) {
            redirect("?action=no-access");
        }
    }
?>