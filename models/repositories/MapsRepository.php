<?php

require_once __DIR__ . '/../Maps.php';
require_once __DIR__ . '/../../lib/database.php';

class MapsRepository {
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function getMaps(): array {
        $statement = $this->connection->getConnection()->query('SELECT * FROM maps');
        $result = $statement->fetchAll();
        $maps = [];
        foreach ($result as $row) {
            $map = new Maps(
                $row['maps_rc'], $row['maps_artist'], $row['maps_title'],
                $row['maps_artistUnicode'], $row['maps_titleUnicode'], $row['maps_sr'], $row['maps_length'],
                $row['maps_cs'], $row['maps_hp'], $row['maps_ar'], $row['maps_od'],
                $row['maps_setId'], $row['maps_mapId'], new DateTime($row['maps_submitDate']), new DateTime($row['maps_lastUpdated']), $row['maps_tags'], $row['maps_background']);
                $map->setId($row['maps_id']);
                $maps[] = $map;
            }
        return $maps;
    }

    public function getMap(int $id): ?Maps {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM maps WHERE maps_id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $map = new Maps(
            $result['maps_rc'], $result['maps_artist'], $result['maps_title'],
            $result['maps_artistUnicode'], $result['maps_titleUnicode'], $result['maps_sr'], $result['maps_length'],
            $result['maps_cs'], $result['maps_hp'], $result['maps_ar'], $result['maps_od'],
            $result['maps_setId'], $result['maps_mapId'], new DateTime($result['maps_submitDate']), new DateTime($result['maps_lastUpdated']), $result['maps_tags'], $result['maps_background']);

        $map->setId($result['maps_id']);
        return $map;
    }

    public function create(Maps $map): bool {
        $statement = $this->connection->getConnection()
            ->prepare('INSERT INTO maps (maps_rc, maps_artist, maps_title, maps_artistUnicode, maps_titleUnicode, maps_sr, maps_length, maps_cs, maps_hp, maps_ar, maps_od, maps_setId, maps_mapId, maps_submitDate, maps_lastUpdated, maps_tags, maps_background)
                       VALUES(:rc, :artist, :title, :artistU, :titleU, :sr, :length, :cs, :hp, :ar, :od, :setId, :mapId, :submitDate, :lastUpdate, :tags, :bgPath)');
                       
        $result = $statement->execute([
            'rc' => $map->getRC(),
            'artist' => $map->getArtist(),
            'title' => $map->getTitle(),
            'artistU' => $map->getArtistUnicode(),
            'titleU' => $map->getTitleUnicode(),
            'sr' => $map->getSR(),
            'length' => $map->getLength(),
            'cs' => $map->getCS(),
            'hp' => $map->getHP(),
            'ar' => $map->getAR(),
            'od' => $map->getOD(),
            'setId' => $map->getSetId(),
            'mapId' => $map->getMapId(),
            'submitDate' => $map->getSubmitDate(),
            'lastUpdate' => $map->getLastUpdate(),
            'tags' => $map->getTags(),
            'bgPath' => $map->getBackgroundPath()
        ]);

        if ($result) {
            $map->setId($this->connection->getConnection()->lastInsertId());
        }

        return $result;
    }

    public function update(Maps $map): bool {
        $statement = $this->connection->getConnection()
        ->prepare('UPDATE maps SET
                    maps_rc = :rc, maps_artist = :artist, maps_title = :title, maps_artistUnicode = :artistU, maps_titleUnicode = :titleU,
                    maps_sr = :sr, maps_length = :length, maps_cs = :cs, maps_hp = :hp, maps_ar = :ar, maps_od = :od, maps_setId = :setId, maps_mapId = :mapId,
                    maps_submitDate = :submitDate, maps_lastUpdated = :lastUpdate, maps_tags = :tags, maps_background = :bgPath WHERE maps_id = :id');
        
        return $statement->execute([
            'id' => $map->getId(),
            'rc' => $map->getRC(),
            'artist' => $map->getArtist(),
            'title' => $map->getTitle(),
            'artistU' => $map->getArtistUnicode(),
            'titleU' => $map->getTitleUnicode(),
            'sr' => $map->getSR(),
            'length' => $map->getLength(),
            'cs' => $map->getCS(),
            'hp' => $map->getHP(),
            'ar' => $map->getAR(),
            'od' => $map->getOD(),
            'setId' => $map->getSetId(),
            'mapId' => $map->getMapId(),
            'submitDate' => $map->getSubmitDate(),
            'lastUpdate' => $map->getLastUpdate(),
            'tags' => $map->getTags(),
            'bgPath' => $map->getBackgroundPath()
        ]);
    }

    public function delete(int $id): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM maps WHERE maps_id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}