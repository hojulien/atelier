<?php require_once __DIR__ . '/../templates/header.php'; ?>

            <section>
                <div class="title">
                    <h1>user details</h1>
                </div>
                <div class="view-container">
                    <div class="view-options">
                        <div class="view-option key">username</div>
                        <div class="view-option value"><?= $user->getUsername() ?></div>
                    </div>
                    <div class="view-options">
                        <div class="view-option key">avatar</div>
                        <div class="view-option value"><img width="128" height="128" src="<?= $user->getAvatarPath(); ?>" alt="User Avatar"></div>
                    </div>
                    <div class="view-options">
                        <div class="view-option key">banner</div>
                        <div class="view-option value"><img width="auto" height="300" src="<?= $user->getBannerPath(); ?>" alt="User Banner"></div>
                    </div>
                    <div class="view-buttons">
                        <button id="edit"><a href="?action=user-edit&id=<?= $user->getId() ?>">edit account informations ✏️</a></button>
                        <button id="delete"><a onclick="return confirm('delete this user account? all informations linked to it will be deleted as well!');" href="?action=user-delete&id=<?= $user->getId() ?>">delete account ❌</a></button>
                    </div>
                </div>
                <button class="return"><a href="?action=user-list" >back to user list</a></button>

            </section>

<?php require_once __DIR__ . '/../templates/footer.php';