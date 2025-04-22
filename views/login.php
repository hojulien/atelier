<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php 
    if (isset($_SESSION['admin_id'])) {
        redirect("?");
    } 
?>
                <script src="./assets/scripts/login.js" defer></script>
                <section class="login-container">
                    <form id="login" class="form-container" action="?action=doLogin" method="POST">
                        <h1>login</h1>
                        <div class="form">
                                <input type="text" name="name" id="name" placeholder="username">
                                <div class="error" id="error-name"></div>
                        </div>
                        <div class="form">
                                <input type="password" name="pw" id="pw" placeholder="password">
                        </div>
                        <div>
                            <p class="login-text">don't have an account?</p>
                            <a href="?action=create-account"><p class="login-text">create an account</p></a>
                        </div>
                        <div>
                                <?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                                        unset($_SESSION['error_message']); 
                                    }
                                ?>
                                <button class="action" type="submit">Login</button>
                        </div>
                    </form>
                </section>

<?php require_once __DIR__ . '/templates/footer.php';
