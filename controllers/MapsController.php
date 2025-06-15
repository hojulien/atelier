<?php

require_once __DIR__ . '/../models/repositories/MapsRepository.php';
require_once __DIR__ . '/../models/Maps.php';
require_once __DIR__ . '/../lib/utils.php';

class MapsController {
    private MapsRepository $mapsRepo;

    public function __construct() {
        $this->mapsRepo = new MapsRepository();
    }

    public function home() {
        // requireAdmin();
        $Mapss = $this->mapsRepo->getMaps();
        require_once __DIR__ . '/../views/maps/list.php';
    }

    public function view(int $id) {
        // requireAdmin();
        
        $maps = $this->mapsRepo->getMap($id);
        require_once __DIR__ . '/../views/maps/view.php';
    }

    public function create() {
        // requireAdmin();
        require_once __DIR__ . '/../views/maps/create-account.php';
    }

    public function add() {
        $map = new Maps(
            $_POST['maps_rc'], $_POST['maps_artist'], $_POST['maps_title'], $_POST['maps_artistUnicode'], $_POST['maps_titleUnicode'],
            $_POST['maps_sr'], $_POST['maps_length'], $_POST['maps_cs'], $_POST['maps_hp'], $_POST['maps_ar'], $_POST['maps_od'],
            $_POST['maps_setId'], $_POST['maps_mapId'], new DateTime($_POST['maps_submitDate']), new DateTime($_POST['maps_lastUpdated']),
            $_POST['maps_tags'], $_POST['maps_background']
        );
        $this->mapsRepo->create($map);

        redirect("?action=home");
    }

    public function edit(int $id) {
        // requireAdmin();
        $maps = $this->mapsRepo->getMap($id);
        require_once __DIR__ . '/../views/maps/edit.php';
    }

    public function update() {
        // requireAdmin();
        $mapId = $_POST['id'];
        $map = new Maps(
            $_POST['maps_rc'], $_POST['maps_artist'], $_POST['maps_title'], $_POST['maps_artistUnicode'], $_POST['maps_titleUnicode'],
            $_POST['maps_sr'], $_POST['maps_length'], $_POST['maps_cs'], $_POST['maps_hp'], $_POST['maps_ar'], $_POST['maps_od'],
            $_POST['maps_setId'], $_POST['maps_mapId'], new DateTime($_POST['maps_submitDate']), new DateTime($_POST['maps_lastUpdated']),
            $_POST['maps_tags'], $_POST['maps_background']
        );
        $map->setId($mapId);
        $this->mapsRepo->update($map);

        redirect("?action=maps-list");
    }

    public function delete(int $id) {
        // requireAdmin();
        $this->mapsRepo->delete($id);

        redirect("?action=maps-list");
    }
}