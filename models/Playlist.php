<?php

require_once __DIR__ . '/../lib/database.php';

enum PlaylistType: string {
    case User = 'user';
    case Admin = 'admin';

    public function toString(): string {
        return $this->value;
    }
    
    public static function toEnum(string $type): PlaylistType {
        return self::from($type);
    }
}

class Playlist {
    private ?int $id;
    private string $name;
    private int $numberLevels;
    private string $description;
    private PlaylistType $type;
    private int $userId;
    private array $mapsId = [];

    public function __construct(string $name, int $numLevel, string $desc, string|PlaylistType $type, int $userId) {
        $this->setName($name);
        $this->setNumberLevels($numLevel);
        $this->setDescription($desc);
        $this->setPlaylistType($type);
        $this->setUserId($userId);
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

    public function getPlaylistType(): string {
        return $this->type->toString();
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getMapIds(): array {
        return $this->mapsId;
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

    // setPlaylistType accepte un string OU un PlaylistType
    // selon le type qui est passé en paramètre, effectue différentes actions (menant au même résultat)
    public function setPlaylistType(string|PlaylistType $type): void {
        if (is_string($type)) {
            $this->type = PlaylistType::toEnum($type);
        } else {
            $this->type = $type;
        }
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }
    
    public function setMapsId(array $mapsId): void {
        $this->mapsId = $mapsId;
    }
}