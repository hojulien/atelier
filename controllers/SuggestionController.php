<?php

require_once __DIR__ . '/../models/repositories/SuggestionRepository.php';
require_once __DIR__ . '/../models/Suggestion.php';
require_once __DIR__ . '/../lib/utils.php';

class SuggestionController {
    private SuggestionRepository $suggestRepo;

    public function __construct() {
        $this->suggestRepo = new SuggestionRepository();
    }

    public function home() {
        // requireAdmin();
        $suggestions = $this->suggestRepo->getSuggestions();
        require_once __DIR__ . '/../views/suggestion/list.php';
    }

    public function view(int $id) {
        // requireAdmin();
        
        $suggestion = $this->suggestRepo->getSuggestion($id);
        require_once __DIR__ . '/../views/suggestion/view.php';
    }

    public function create() {
        // requireAdmin();
        require_once __DIR__ . '/../views/suggestion/create.php';
    }

    public function add() {
        $suggestion = new Suggestion($_POST['type'], $_POST['desc'], $_POST['media'], $_POST['userId']);
        $this->suggestRepo->create($suggestion);

        redirect("?action=home");
    }

    public function edit(int $id) {
        // requireAdmin();
        $suggestion = $this->suggestRepo->getSuggestion($id);
        require_once __DIR__ . '/../views/suggestion/edit.php';
    }

    public function update() {
        // requireAdmin();
        $suggestionId = $_POST['id'];
        $suggestion = new Suggestion($_POST['type'], $_POST['desc'], $_POST['media'], $_POST['userId']);
        $suggestion->setId($suggestionId);
        $this->suggestRepo->update($suggestion);

        redirect("?action=suggestion-list");
    }

    public function delete(int $id) {
        // requireAdmin();
        $this->suggestRepo->delete($id);

        redirect("?action=suggestion-list");
    }
}