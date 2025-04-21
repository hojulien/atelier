<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php 
    if (isset($_SESSION['admin_id'])) {
        redirect("?");
    } 
?>
                <script src="./assets/scripts/login.js" defer></script>
                <section>
                    <form id="login" action="?action=doLogin" method="POST">
                        <div class="form">
                            <label>Username:</label>
                            <input type="text" name="name" id="name">
                            <div class="error" id="error-name"></div>
                        </div>
                        <div class="form">
                            <label>Password:</label>
                            <input type="password" name="pw">
                        </div>
                        <div>
                            <?php
                                if (isset($_SESSION['error_message'])) {
                                    echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                                    unset($_SESSION['error_message']); 
                                }
                            ?>
                            <button class="form-valid" type="submit">Login</button>
                        </div>
                    </form>
                </section>

<?php require_once __DIR__ . '/templates/footer.php';
