<?php require_once __DIR__ . '/../templates/header.php'; ?>

            <section>
                <div class="title">
                    <h1>User list</h1>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>username</th>
                                <th>avatar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($users as $user): ?>
                            <tr>
                                <td><?= $user->getId(); ?></td>
                                <td><?= $user->getUsername(); ?></td>
                                <td><img width="128" height="128" src="<?= $user->getAvatarPath(); ?>" alt="User Avatar"></td>
                                <td class="list-options">
                                    <button id="view"><a href="?action=user-view&id=<?= $user->getId() ?>">view 🔎</a></button>
                                    <button id="edit"><a href="?action=user-edit&id=<?= $user->getId() ?>">edit ✏️</a></button>
                                    <button id="delete"><a onclick="return confirm('Delete this user account? All informations linked to it will be deleted as well!');" href="?action=user-delete&id=<?= $user->getId() ?>">delete ❌</a></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

<?php require_once __DIR__ . '/../templates/footer.php';
