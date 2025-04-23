<?php require_once __DIR__ . '/../templates/header.php'; ?>

            <section class="flex-center">
                <form id="formUser" class="layout-container" action="?action=user-add" method="POST">
                        <h1>create an account</h1>
                        <div class="form">
                                <input type="text" name="name" id="name" placeholder="username">
                                <div class="error" id="error-name"></div>
                        </div>
                        <div class="form">
                                <input type="password" name="pw" id="pw" placeholder="password">
                        </div>
                        <div>
                                <?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                                        unset($_SESSION['error_message']); 
                                    }
                                    if (isset($_GET['error']) && $_GET['error'] === 'username_taken') {
                                        echo '<p class="error">this username is already taken.</p>';
                                    }
                                ?>
                                <button class="action" type="submit">create</button>
                        </div>
                    </form>
            </section>

<?php require_once __DIR__ . '/../templates/footer.php';