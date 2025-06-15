<?php

require_once __DIR__ . '/../Playlist.php';
require_once __DIR__ . '/PlaylistMapRepository.php';
require_once __DIR__ . '/../../lib/database.php';

class PlaylistRepository {
    public DatabaseConnection $connection;
    public PlaylistMapRepository $playlistMapRepo;

    public function __construct() {
        $this->connection = new DatabaseConnection();
        $this->playlistMapRepo = new PlaylistMapRepository();
    }

    public function getPlaylists(): array {
        $statement = $this->connection->getConnection()->query('SELECT * FROM playlists');
        $result = $statement->fetchAll();
        $playlists = [];
        foreach($result as $row) {
            $mapsId = $this->playlistMapRepo->getMapIdsFromPlaylist($row['playlist_id']);
            $playlist = new Playlist($row['playlist_name'], $row['playlist_numberLevels'], $row['playlist_description'], $row['playlist_type'], $row['playlist_userId']);
            $playlist->setId($row['playlist_id']);
            $playlist->setMapsId($mapsId);
            $playlists[] = $playlist;
        }

        return $playlists;
    }

    public function getPlaylist(int $id): ?Playlist {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM playlists WHERE playlist_id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $mapsId = $this->playlistMapRepo->getMapIdsFromPlaylist($id);
        $playlist = new Playlist($result['playlist_name'], $result['playlist_numberLevels'], $result['playlist_description'], $result['playlist_type'], $result['playlist_userId']);
        $playlist->setId($result['playlist_id']);
        $playlist->setMapsId($mapsId);
        
        return $playlist;
    }

    public function getPlaylistCount(): int {
        $statement = $this->connection->getConnection()->query('SELECT COUNT(*) as total FROM playlists');
        $result = $statement->fetch();
    
        return (int) $result['total'];
    }


    public function create(Playlist $playlist): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('INSERT INTO playlists (playlist_name, playlist_numberLevels, playlist_description, playlist_type, playlist_userId) VALUES (:name, :numLevel, :desc, :type, :userId)');

        $result = $statement->execute([
            'name' => $playlist->getName(),
            'numLevel' => $playlist->getNumberLevels(),
            'desc' => $playlist->getDescription(),
            'type' => $playlist->getPlaylistType(),
            'userId' => $playlist->getUserId()
        ]);

        if ($result) {
            $playlist->setId($this->connection->getConnection()->lastInsertId());
        }

        return $result;
    }

    public function update(Playlist $playlist): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('UPDATE playlists SET playlist_name = :name, playlist_numberLevels = :numLevel, playlist_description = :desc, playlist_type = :type, playlist_userId = :userId WHERE playlist_id = :id');

        return $statement->execute([
            'id' => $playlist->getId(),
            'name' => $playlist->getName(),
            'numLevel' => $playlist->getNumberLevels(),
            'desc' => $playlist->getDescription(),
            'type' => $playlist->getPlaylistType(),
            'userId' => $playlist->getUserId()
        ]);
    }

    public function delete(int $id): bool {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM playlists WHERE playlist_id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}