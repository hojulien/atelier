<?php

require_once __DIR__ . '/../lib/database.php';

class User {
    private ?int $id;
    private string $username;
    private string $password;
    private ?string $avatarPath;
    private ?string $bannerPath;
    private bool $isAdmin;

    public function __construct(string $username, string $password, ?string $avatarPath, ?string $bannerPath, bool $isAdmin) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setAvatarPath($avatarPath);
        $this->setBannerPath($bannerPath); 
        $this->isAdmin = $isAdmin;
        $this->id = null;
    }

    // GETTERS

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getAvatarPath(): string {
        return $this->avatarPath;
    }

    public function getBannerPath(): string {
        return $this->bannerPath;
    }

    public function isAdmin(): bool {
        return $this->isAdmin;
    }
    
    // SETTERS

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = htmlspecialchars($username);
    }

    public function setPassword(string $password): void {
        $this->password = htmlspecialchars($password);
    }

    public function setAvatarPath(?string $avatarPath): void {
        $this->avatarPath = htmlspecialchars($avatarPath);
    }

    public function setBannerPath(?string $bannerPath): void {
        $this->bannerPath = htmlspecialchars($bannerPath);
    }
}