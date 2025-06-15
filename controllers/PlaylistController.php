<?php

require_once __DIR__ . '/../models/repositories/PlaylistRepository.php';
require_once __DIR__ . '/../models/Playlist.php';
require_once __DIR__ . '/../lib/utils.php';

class PlaylistController {
    private PlaylistRepository $playRepo;

    public function __construct() {
        $this->playRepo = new PlaylistRepository();
    }

    public function home() {
        // requireAdmin();
        $playlists = $this->playRepo->getPlaylists();
        require_once __DIR__ . '/../views/playlist/list.php';
    }

    public function view(int $id) {
        // requireAdmin();
        
        $playlist = $this->playRepo->getPlaylist($id);
        require_once __DIR__ . '/../views/playlist/view.php';
    }

    public function create() {
        // requireAdmin();
        require_once __DIR__ . '/../views/playlist/create.php';
    }

    public function add() {
        $playlist = new Playlist($_POST['name'], $_POST['numLevel'], $_POST['desc'], $_POST['type'], $_POST['userId']);
        $this->playRepo->create($playlist);

        redirect("?action=home");
    }

    public function edit(int $id) {
        // requireAdmin();
        $playlist = $this->playRepo->getPlaylist($id);
        require_once __DIR__ . '/../views/playlist/edit.php';
    }

    public function update() {
        // requireAdmin();
        $playlistId = $_POST['id'];
        $playlist = new Playlist($_POST['name'], $_POST['numLevel'], $_POST['desc'], $_POST['type'], $_POST['userId']);
        $playlist->setId($playlistId);
        $this->playRepo->update($playlist);

        redirect("?action=playlist-list");
    }

    public function delete(int $id) {
        // requireAdmin();
        $this->playRepo->delete($id);

        redirect("?action=playlist-list");
    }
}