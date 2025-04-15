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
                $row['RC'], $row['ARTIST'], $row['TITLE'],
                $row['ARTIST_UNICODE'], $row['TITLE_UNICODE'], $row['SR'], $row['LENGTH'],
                $row['CS'], $row['HP'], $row['AR'], $row['OD'],
                $row['SET_ID'], $row['MAP_ID'], new DateTime($row['SUBMIT_DATE']), new DateTime($row['LAST_UPDATE']), $row['TAGS']);
                $maps[] = $map;
            }
        return $maps;
    }

    public function create(Maps $map): bool {
        $statement = $this->connection->getConnection()
            ->prepare('INSERT INTO maps (RC, ARTIST, TITLE, ARTIST_UNICODE, TITLE_UNICODE, SR, LENGTH, CS, HP, AR, OD, SET_ID, MAP_ID, SUBMIT_DATE, LAST_UPDATE, TAGS)
                       VALUES(:rc, :artist, :title, :artistU, :titleU, :sr, :length, :cs, :hp, :ar, :od, :setId, :mapId, :submitDate, :lastUpdate, :tags)');
                       
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
            'tags' => $map->getTags()
        ]);

        if ($result) {
            $map->setId($this->connection->getConnection()->lastInsertId());
        }

        return $result;
    }

    public function update(Maps $map): bool {
        $statement = $this->connection->getConnection()
        ->prepare('UPDATE maps SET
                    RC = :rc, ARTIST = :artist, TITLE = :title, ARTIST_UNICODE = :artistU, TITLE_UNICODE = :titleU,
                    SR = :sr, LENGTH = :length, CS = :cs, HP = :hp, AR = :ar, OD = :od, SET_ID = :setId, MAP_ID = :mapId,
                    SUBMIT_DATE = :submitDate, LAST_UPDATE = :lastUpdate, TAGS = :tags WHERE ID = :id');
        
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
            'tags' => $map->getTags()
        ]);
    }

    public function delete(int $id): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM maps WHERE ID = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}