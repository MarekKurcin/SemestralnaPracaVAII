<?php
require_once __DIR__ . '/../models/Accommodation.php';

class AccommodationController {
    private $model;

    public function __construct() {
        $this->model = new Accommodation();
    }

    /**
     * Zobrazenie zoznamu ubytovaní
     */
    public function index() {
        $accommodations = $this->model->getAll();
        require __DIR__ . '/../views/accommodations/index.php';
    }

    /**
     * Zobrazenie detailu ubytovania
     */
    public function show($id) {
        $accommodation = $this->model->getById($id);
        if (!$accommodation) {
            header('Location: index.php?page=accommodations&error=not_found');
            exit;
        }
        require __DIR__ . '/../views/accommodations/show.php';
    }

    /**
     * Zobrazenie formulára pre vytvorenie
     */
    public function create() {
        require __DIR__ . '/../views/accommodations/create.php';
    }

    /**
     * Uloženie nového ubytovania
     */
    public function store() {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $data = $_POST;
            require __DIR__ . '/../views/accommodations/create.php';
            return;
        }

        $data = [
            'user_id' => $_SESSION['user']['id'] ?? 1,
            'nazov' => htmlspecialchars(trim($_POST['nazov'])),
            'popis' => htmlspecialchars(trim($_POST['popis'])),
            'adresa' => htmlspecialchars(trim($_POST['adresa'])),
            'kapacita' => (int) $_POST['kapacita'],
            'cena_za_noc' => (float) $_POST['cena_za_noc'],
            'vybavenie' => htmlspecialchars(trim($_POST['vybavenie'])),
            'obrazok' => $_POST['obrazok'] ?? null
        ];

        if ($this->model->create($data)) {
            header('Location: index.php?page=accommodations&success=created');
        } else {
            header('Location: index.php?page=accommodations&action=create&error=failed');
        }
        exit;
    }

    /**
     * Zobrazenie formulára pre editáciu
     */
    public function edit($id) {
        $accommodation = $this->model->getById($id);
        if (!$accommodation) {
            header('Location: index.php?page=accommodations&error=not_found');
            exit;
        }
        require __DIR__ . '/../views/accommodations/edit.php';
    }

    /**
     * Aktualizácia ubytovania
     */
    public function update($id) {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $accommodation = $_POST;
            $accommodation['id'] = $id;
            require __DIR__ . '/../views/accommodations/edit.php';
            return;
        }

        $data = [
            'nazov' => htmlspecialchars(trim($_POST['nazov'])),
            'popis' => htmlspecialchars(trim($_POST['popis'])),
            'adresa' => htmlspecialchars(trim($_POST['adresa'])),
            'kapacita' => (int) $_POST['kapacita'],
            'cena_za_noc' => (float) $_POST['cena_za_noc'],
            'vybavenie' => htmlspecialchars(trim($_POST['vybavenie'])),
            'obrazok' => $_POST['obrazok'] ?? null,
            'aktivne' => isset($_POST['aktivne']) ? true : false
        ];

        if ($this->model->update($id, $data)) {
            header('Location: index.php?page=accommodations&success=updated');
        } else {
            header('Location: index.php?page=accommodations&action=edit&id=' . $id . '&error=failed');
        }
        exit;
    }

    /**
     * Vymazanie ubytovania
     */
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: index.php?page=accommodations&success=deleted');
        } else {
            header('Location: index.php?page=accommodations&error=delete_failed');
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

        if (empty($data['adresa']) || strlen(trim($data['adresa'])) < 5) {
            $errors['adresa'] = 'Adresa musí mať minimálne 5 znakov';
        }

        if (empty($data['kapacita']) || (int)$data['kapacita'] < 1 || (int)$data['kapacita'] > 50) {
            $errors['kapacita'] = 'Kapacita musí byť medzi 1 a 50';
        }

        if (empty($data['cena_za_noc']) || (float)$data['cena_za_noc'] <= 0) {
            $errors['cena_za_noc'] = 'Cena musí byť väčšia ako 0';
        }

        return $errors;
    }
}
