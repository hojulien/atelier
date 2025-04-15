<?php

require_once __DIR__ . '/../lib/database.php';

enum SuggestionType: string {
    case Media = 'media';
    case Music = 'music';
}

class Suggestion {
    private ?int $id;
    private SuggestionType $type;
    private string $desc;
    private string $media;
    private int $userId;

    public function __construct(SuggestionType $type, string $desc, string $media, int $userId) {
        $this->type = $type;
        $this->desc = $desc;
        $this->media = $media;
        $this->userId = $userId;
        $this->id = null;
    }

    // GETTERS

    public function getId(): int {
        return $this->id;
    }

    public function getType(): SuggestionType {
        return $this->type;
    }

    public function getDesc(): string {
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

    public function setType(SuggestionType $type): void {
        $this->type = $type;
    }

    public function setDesc(string $desc): void {
        $this->desc = htmlspecialchars($desc);
    }

    public function setMedia(string $media): void {
        $this->media = htmlspecialchars($media);
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

}