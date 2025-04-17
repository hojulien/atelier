<?php

use Soap\Sdl;

require_once __DIR__ . '/../Suggestion.php';
require_once __DIR__ . '/../../lib/database.php';

class SuggestionRepository {
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getSuggestions(): array {
        $statement = $this->connection->getConnection()->query('SELECT * FROM suggestions');
        $result = $statement->fetchAll();
        $suggestions = [];
        foreach($result as $row) {
            $suggestion = new Suggestion($row['suggestion_type'], $row['suggestion_description'], $row['suggestion_media'], $row['suggestion_userId']);
            $suggestion->setId($row['suggestion_id']);
            $suggestions[] = $suggestion;
        }

        return $suggestions;
    }

    public function getSuggestion(int $id): ?Suggestion {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM suggestions WHERE suggestion_id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $suggestion = new Suggestion($result['suggestion_type'], $result['suggestion_description'], $result['suggestion_media'], $result['suggestion_userId']);
        $suggestion->setId($result['suggestion_id']);
        return $suggestion;
    }

    public function getSuggestionCount(): int {
        $statement = $this->connection->getConnection()->query('SELECT COUNT(*) as total FROM suggestions');
        $result = $statement->fetch();
    
        return (int) $result['total'];
    }


    public function create(Suggestion $suggestion): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('INSERT INTO suggestions (suggestion_type, suggestion_description, suggestion_media, suggestion_userId) VALUES (:type, :desc, :media, :userId)');

        $result = $statement->execute([
            'type' => $suggestion->getSuggestionType(),
            'desc' => $suggestion->getDescription(),
            'media' => $suggestion->getMedia(),
            'userId' => $suggestion->getUserId()
        ]);

        if ($result) {
            $suggestion->setId($this->connection->getConnection()->lastInsertId());
        }

        return $result;
    }

    public function update(Suggestion $suggestion): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('UPDATE suggestions SET suggestion_type = :type, suggestion_description = :desc, suggestion_media = :media, suggestion_userId = :userId WHERE suggestion_id = :id');

        return $statement->execute([
            'id' => $suggestion->getId(),
            'type' => $suggestion->getSuggestionType(),
            'desc' => $suggestion->getDescription(),
            'media' => $suggestion->getMedia(),
            'userId' => $suggestion->getUserId()
        ]);
    }

    public function delete(int $id): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM suggestions WHERE suggestion_id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}