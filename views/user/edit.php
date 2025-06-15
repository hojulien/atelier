<?php require_once __DIR__ . '/../templates/header.php'; ?>
            <script src="./assets/scripts/userform.js" defer></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.getElementById('removeAvatar').addEventListener('change', function () {
                        document.getElementById('avatar').disabled = this.checked;
                    });
                    document.getElementById('removeBanner').addEventListener('change', function () {
                        document.getElementById('banner').disabled = this.checked;
                    });
                });
            </script>
            <section>
                <div class="title">
                    <h1>User edit</h1>
                </div>
                <form id="formUser" action="?action=user-update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                    <div class="form">
                        <label for="name">username:</label>
                        <input type="text" id="name" name="name" value="<?= $user->getUsername() ?>">
                        <div class="error" id="error-name"></div>
                    </div>
                    <div class="form">
                        <label for="avatar">avatar (400x400 min)</label>
                        <input type="file" name="avatar" id="avatar" accept=".jpg, .jpeg, .png">
                        <label for="removeAvatar">remove current avatar</label>
                        <input type="checkbox" id="removeAvatar" name="removeAvatar" value="1">
                    </div>
                    <div class="form">
                        <label for="avatar">banner (1920x500 min)</label>
                        <input type="file" name="banner" id="banner" accept=".jpg, .jpeg, .png">
                        <label for="removeBanner">remove current banner</label>
                        <input type="checkbox" id="removeBanner" name="removeBanner" value="1">
                    </div>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']): ?>
                        <div class="form">
                            <label for="isAdmin">administrator</label>
                            <input type="checkbox" id="isAdmin" name="isAdmin" value="1" 
                                <?= $user->isAdmin() ? 'checked' : '' ?>>
                        </div>
                    <?php endif; ?>
                    <button class="form-valid" type="submit">update user</button>
                </form>
                
                <button class="return"><a href="?action=user-list" >return to user list</a></button>
            </section>

<?php require_once __DIR__ . '/../templates/footer.php';