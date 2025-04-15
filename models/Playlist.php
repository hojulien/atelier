<?php

require_once __DIR__ . '/../lib/database.php';

enum PlaylistType: string {
    case User = 'user';
    case Admin = 'admin';
}

class Playlist {
    private ?int $id;
    private string $name;
    private int $numberLevels;
    private string $description;
    private PlaylistType $type;
    private int $userId;

    public function __construct(string $name, int $numLevel, string $desc, PlaylistType $type, int $userId) {
        $this->name = $name;
        $this->numberLevels = $numLevel;
        $this->description = $desc;
        $this->type = $type;
        $this->userId = $userId;
        $this->id = null;
    }

    // GETTERS

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumberLevels(): int {
        return $this->numberLevels;
    }

    // écrire une fonction getLength qui dépend de la DB plus tard

    public function getDescription(): string {
        return $this->description;
    }

    public function getType(): PlaylistType {
        return $this->type;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function isAdminPlaylist(): bool {
        return $this->type === PlaylistType::Admin;
    }
    
    // SETTERS

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = htmlspecialchars($name);
    }

    public function setNumberLevels(int $numLevel): void {
        $this->numberLevels = $numLevel;
    }

    public function setDescription(string $desc): void {
        $this->description = htmlspecialchars($desc);
    }

    public function setType(PlaylistType $type): void {
        $this->type = $type;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }
}