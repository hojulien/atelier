<?php

require_once __DIR__ . '/../Playlist.php';
require_once __DIR__ . '/../../lib/database.php';

class PlaylistMapRepository {
    public DatabaseConnection $connection;

    public function __construct() {
        $this->connection = new DatabaseConnection();
    }

    public function addMapToPlaylist(int $playlistId, int $mapId): bool {
        // INSERT IGNORE ignore l'insertion si la valeur existe déjà
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT IGNORE INTO playlist_maps (playlist_id, map_id) VALUES (:playlistId, :mapId)');

        return $statement->execute([
            'playlistId' => $playlistId,
            'mapId' => $mapId
        ]);
    }

    public function removeMapFromPlaylist(int $playlistId, int $mapId): bool {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM playlist_maps WHERE playlist_id = :playlistId AND map_id = :mapId');
            
        return $statement->execute([
            'playlistId' => $playlistId,
            'mapId' => $mapId
        ]);
    }

    public function getMapIdsFromPlaylist(int $playlistId): array {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT map_id FROM playlist_maps WHERE playlist_id = :playlistId'
        );
        $statement->execute(['playlistId' => $playlistId]);

        $rows = $statement->fetchAll();
        return array_column($rows, 'map_id');
    }
}