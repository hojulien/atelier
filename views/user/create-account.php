<?php require_once __DIR__ . '/../templates/header.php'; ?>

            <section class="flex-center">
                <form id="formUser" class="layout-container create" action="?action=user-add" method="POST" enctype="multipart/form-data">
                        <h1>create an account</h1>
                        <div class="form">
                                <input type="text" name="name" id="name" placeholder="username">
                                <div class="error" id="error-name"></div>
                        </div>
                        <div class="form">
                                <input type="password" name="pw" id="pw" placeholder="password">
                        </div>
                        <div class="form">
                                <h3>upload a profile picture (min 400x400)</h3>
                                <input type="file" name="avatar" id="avatar" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="form">
                                <h3>upload a banner (min 2000x500)</h3>
                                <input type="file" name="banner" id="banner" accept=".jpg, .jpeg, .png">
                        </div>
                        <div>
                                <?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                                        unset($_SESSION['error_message']); 
                                    }
                                ?>
                                <button class="action" type="submit">create</button>
                        </div>
                    </form>
            </section>

<?php require_once __DIR__ . '/../templates/footer.php';