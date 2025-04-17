<?php

require_once __DIR__ . '/../lib/database.php';

enum SuggestionType: string {
    case Media = 'media';
    case Music = 'music';

    public function toString(): string {
        return $this->value;
    }

    public static function toEnum(string $type): SuggestionType {
        return self::from($type);
    }
}

class Suggestion {
    private ?int $id;
    private SuggestionType $type;
    private string $desc;
    private string $media;
    private int $userId;

    public function __construct(string|SuggestionType $type, string $desc, string $media, int $userId) {
        $this->setSuggestionType($type);
        $this->setDescription($desc);
        $this->setMedia($media);
        $this->setUserId($userId);
        $this->id = null;
    }

    // GETTERS

    public function getId(): int {
        return $this->id;
    }

    public function getSuggestionType(): string {
        return $this->type->toString();
    }

    public function getDescription(): string {
        return $this->desc;
    }

    public function getMedia(): string {
        return $this->media;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    // SETTERS

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setSuggestionType(string|SuggestionType $type): void {
        if (is_string($type)) {
            $this->type = SuggestionType::toEnum($type);
        } else {
            $this->type = $type;
        }
    }

    public function setDescription(string $desc): void {
        $this->desc = htmlspecialchars($desc);
    }

    public function setMedia(string $media): void {
        $this->media = htmlspecialchars($media);
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

}