<?php

require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../lib/database.php';

class UserRepository {
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getUsers(): array {
        $statement = $this->connection->getConnection()->query('SELECT * FROM users');
        $result = $statement->fetchAll();
        $users = [];
        foreach($result as $row) {
            $user = new User($row['user_username'], $row['user_password'], $row['user_avatarPath'], $row['user_bannerPath'], $row['user_isAdmin']);
            $user->setId($row['user_id']);
            $users[] = $user;
        }

        return $users;
    }

    public function getUser(int $id): ?User {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM users WHERE user_id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $user = new User($result['user_username'], $result['user_password'], $result['user_avatarPath'], $result['user_bannerPath'], $result['user_isAdmin']);
        $user->setId($result['user_id']);
        return $user;
    }
    public function getUserByUsername(string $name): ?User {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM users WHERE user_username = :name');
        $statement->execute(['name' => $name]);

        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $user = new User($result['user_username'], $result['user_password'], $result['user_avatarPath'], $result['user_bannerPath'], $result['user_isAdmin']);
        $user->setId($result['user_id']);
        return $user;
    }

    public function getUserById(int $id): ?User {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM users WHERE user_id = :id');
        $statement->execute(['id' => $id]);

        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $user = new User($result['user_username'], $result['user_password'], $result['user_avatarPath'], $result['user_bannerPath'], $result['user_isAdmin']);
        $user->setId($result['user_id']);
        return $user;
    }

    public function getUserCount(): int {
        $statement = $this->connection->getConnection()->query('SELECT COUNT(*) as total FROM users');
        $result = $statement->fetch();
    
        return (int) $result['total'];
    }

    public function usernameExists(string $name): bool {
        $statement = $this->connection->getConnection()->prepare('SELECT COUNT(*) FROM users WHERE user_username = ?:name');
        $statement->execute(['name' => $name]);
        return $statement->fetchColumn() > 0;
    }

    public function getPasswordById(int $id): string {
        $statement = $this->connection->getConnection()->prepare('SELECT password FROM users WHERE id = ?:id');
        $statement->execute(['id' => $id]);
        return $statement->fetchColumn();
    }

    public function create(User $user): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('INSERT INTO users (user_username, user_password, user_avatarPath, user_bannerPath, user_isAdmin) VALUES (:name, :pw, :avatar, :banner, :isAdmin)');

        $result = $statement->execute([
            'name' => $user->getUsername(),
            'pw' => $user->getPassword(),
            'avatar' => $user->getAvatarPath(),
            'banner' => $user->getBannerPath(),
            'isAdmin' => $user->isAdmin()
        ]);

        if ($result) {
            $user->setId($this->connection->getConnection()->lastInsertId());
        }

        return $result;
    }

    public function update(User $user): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('UPDATE users SET user_username = :name, user_password = :pw, user_avatarPath = :avatar, user_bannerPath = :banner, user_isAdmin = :isAdmin WHERE user_id = :id');

        return $statement->execute([
            'id' => $user->getId(),
            'name' => $user->getUsername(),
            'pw' => $user->getPassword(),
            'avatar' => $user->getAvatarPath(),
            'banner' => $user->getBannerPath(),
            'isAdmin' => $user->isAdmin()
        ]);
    }

    public function delete(int $id): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM users WHERE user_id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}