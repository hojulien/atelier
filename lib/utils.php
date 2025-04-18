<?php
    function redirect(string $action) {
            header('Location: ' . $action);
            exit;
    }
?>