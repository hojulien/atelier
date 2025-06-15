<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php 
    if (isset($_SESSION['user']['is_admin'])) {
        redirect("?action=admin-dashboard");
    }
?>

    <section>
        <h1>🚫 Access denied</h1> <br>
        <a href="?"><p>Go back to main page</p></a>
    </section>

<?php require_once __DIR__ . '/templates/footer.php'; ?>