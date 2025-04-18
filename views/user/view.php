<?php require_once __DIR__ . '/../templates/header.php'; ?>

            <section>
                <div class="title">
                    <h1>Détails du client</h1>
                </div>
                <div class="view-container">
                    <div class="view-options">
                        <div class="view-option key">Username</div>
                        <div class="view-option value"><?= $user->getUsername() ?></div>
                    </div>
                    <div class="view-options">
                        <div class="view-option key">Avatar</div>
                        <div class="view-option value"><img width="128" height="128" src="<?= $user->getAvatarPath(); ?>" alt="User Avatar"></div>
                    </div>
                    <div class="view-buttons">
                        <button id="edit"><a href="?action=user-edit&id=<?= $user->getId() ?>">Modifier les informations du client ✏️</a></button>
                        <button id="delete"><a onclick="return confirm('Voulez-vous supprimer ce client? Attention, tous les comptes bancaires et contrats associés à ce client seront également supprimés!');" href="?action=user-delete&id=<?= $user->getId() ?>">Supprimer le profil client ❌</a></button>
                    </div>
                </div>
                <button class="return"><a href="?action=user-list" >Retour à la liste</a></button>

            </section>

<?php require_once __DIR__ . '/../templates/footer.php';