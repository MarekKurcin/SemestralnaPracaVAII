<?php
require_once __DIR__ . '/../models/Attraction.php';

class AttractionController {
    private $model;

    public function __construct() {
        $this->model = new Attraction();
    }

    /**
     * Zobrazenie zoznamu atrakcií
     */
    public function index() {
        $attractions = $this->model->getAll();
        require __DIR__ . '/../views/attractions/index.php';
    }

    /**
     * Zobrazenie detailu atrakcie
     */
    public function show($id) {
        $attraction = $this->model->getById($id);
        if (!$attraction) {
            header('Location: index.php?page=attractions&error=not_found');
            exit;
        }
        require __DIR__ . '/../views/attractions/show.php';
    }

    /**
     * Zobrazenie formulára pre vytvorenie
     */
    public function create() {
        require __DIR__ . '/../views/attractions/create.php';
    }

    /**
     * Uloženie novej atrakcie
     */
    public function store() {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $data = $_POST;
            require __DIR__ . '/../views/attractions/create.php';
            return;
        }

        $data = [
            'nazov' => htmlspecialchars(trim($_POST['nazov'])),
            'popis' => htmlspecialchars(trim($_POST['popis'])),
            'typ' => htmlspecialchars(trim($_POST['typ'])),
            'obrazok' => $_POST['obrazok'] ?? null
        ];

        if ($this->model->create($data)) {
            header('Location: index.php?page=attractions&success=created');
        } else {
            header('Location: index.php?page=attractions&action=create&error=failed');
        }
        exit;
    }

    /**
     * Zobrazenie formulára pre editáciu
     */
    public function edit($id) {
        $attraction = $this->model->getById($id);
        if (!$attraction) {
            header('Location: index.php?page=attractions&error=not_found');
            exit;
        }
        require __DIR__ . '/../views/attractions/edit.php';
    }

    /**
     * Aktualizácia atrakcie
     */
    public function update($id) {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $attraction = $_POST;
            $attraction['id'] = $id;
            require __DIR__ . '/../views/attractions/edit.php';
            return;
        }

        $data = [
            'nazov' => htmlspecialchars(trim($_POST['nazov'])),
            'popis' => htmlspecialchars(trim($_POST['popis'])),
            'typ' => htmlspecialchars(trim($_POST['typ'])),
            'obrazok' => $_POST['obrazok'] ?? null
        ];

        if ($this->model->update($id, $data)) {
            header('Location: index.php?page=attractions&success=updated');
        } else {
            header('Location: index.php?page=attractions&action=edit&id=' . $id . '&error=failed');
        }
        exit;
    }

    /**
     * Vymazanie atrakcie
     */
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: index.php?page=attractions&success=deleted');
        } else {
            header('Location: index.php?page=attractions&error=delete_failed');
        }
        exit;
    }

    /**
     * Validácia dát na strane servera
     */
    private function validate($data) {
        $errors = [];

        if (empty($data['nazov']) || strlen(trim($data['nazov'])) < 3) {
            $errors['nazov'] = 'Názov musí mať minimálne 3 znaky';
        }

        if (empty($data['typ'])) {
            $errors['typ'] = 'Vyberte typ atrakcie';
        }

        return $errors;
    }
}
