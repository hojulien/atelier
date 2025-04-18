<?php

require_once __DIR__ . '/../lib/database.php';

class Maps {
    private ?int $id;
    private string $rc;
    private string $artist;
    private string $title;
    private string $artistUnicode;
    private string $titleUnicode;
    private float $sr;
    private int $length;
    private float $cs;
    private float $hp;
    private float $ar;
    private float $od;
    private int $setId;
    private int $mapId;
    private DateTime $submitDate;
    private DateTime $lastUpdate;
    private string $tags;
    private string $backgroundPath;

    public function __construct(string $rc, string $artist, string $title, string $artistUnicode, string $titleUnicode, float $sr, int $length, float $cs, float $hp, float $ar, float $od, int $setId, int $mapId, DateTime $submitDate, DateTime $lastUpdate, string $tags, string $bgPath) {
            $this->setRC($rc);
            $this->setArtist($artist);
            $this->setTitle($title);
            $this->setArtistUnicode($artistUnicode);
            $this->setTitleUnicode($titleUnicode);
            $this->setSR($sr);
            $this->setLength($length);
            $this->setCS($cs);
            $this->setHP($hp);
            $this->setAR($ar);
            $this->setOD($od);
            $this->setSetID($setId);
            $this->setMapID($mapId);
            $this->setSubmitDate($submitDate);
            $this->setLastUpdate($lastUpdate);
            $this->setTags($tags);
            $this->setBackgroundPath($bgPath);
            $this->id = null;
        }

        // GETTERS (46-118)

        public function getId(): int {
            return $this->id;
        }

        public function getRC(): string {
            return $this->rc;
        }

        public function getArtist(): string {
            return $this->artist;
        }

        public function getTitle(): string {
            return $this->title;
        }

        public function getArtistUnicode(): string {
            return $this->artistUnicode;
        }

        public function getTitleUnicode(): string {
            return $this->titleUnicode;
        }

        public function getSR(): float {
            return $this->sr;
        }

        public function getLength(): int {
            return $this->length;
        }

        public function getCS(): float {
            return $this->cs;
        }

        public function getHP(): float {
            return $this->hp;
        }

        public function getAR(): float {
            return $this->ar;
        }

        public function getOD(): float {
            return $this->od;
        }

        public function getSetId(): int {
            return $this->setId;
        }

        public function getMapId(): int {
            return $this->mapId;
        }

        public function getSubmitDate(): string {
            return $this->submitDate->format('Y-m-d H:i:s');
        }

        public function getLastUpdate(): string {
            return $this->lastUpdate->format('Y-m-d H:i:s');
        }

        public function getTags(): string {
            return $this->tags;
        }

        public function getBackgroundPath(): string {
            return !empty($this->backgroundPath) ? $this->backgroundPath : './assets/images/default.jpg';
        }

        // SETTERS (120-192)

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setRC(string $rc): void {
            $this->rc = htmlspecialchars($rc);
        }

        public function setArtist(string $artist): void {
            $this->artist = htmlspecialchars($artist);
        }

        public function setTitle(string $title): void {
            $this->title = htmlspecialchars($title);
        }

        public function setArtistUnicode(string $artistUnicode): void {
            $this->artist = htmlspecialchars($artistUnicode);
        }

        public function setTitleUnicode(string $titleUnicode): void {
            $this->title = htmlspecialchars($titleUnicode);
        }
    
        public function setSR(float $sr): void {
            $this->sr = $sr;
        }

        public function setLength(int $length): void {
            $this->length = $length;
        }

        public function setCS(float $cs): void {
            $this->cs = $cs;
        }

        public function setHP(float $hp): void {
            $this->hp = $hp;
        }

        public function setAR(float $ar): void {
            $this->ar = $ar;
        }

        public function setOD(float $od): void {
            $this->od = $od;
        }

        public function setSetID(int $setId): void {
            $this->setId = $setId;
        }

        public function setMapID(int $mapId): void {
            $this->mapId = $mapId;
        }

        public function setSubmitDate(DateTime $submitDate): void {
            $this->submitDate = $submitDate;
        }

        public function setLastUpdate(DateTime $lastUpdate): void {
            $this->lastUpdate = $lastUpdate;
        }

        public function setTags(string $tags): void {
            $this->tags = htmlspecialchars($tags);
        }

        public function setBackgroundPath(string $bgPath): void {
            $this->backgroundPath = htmlspecialchars($bgPath);
        }

}




