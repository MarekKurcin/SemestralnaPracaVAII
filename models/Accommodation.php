<?php
require_once __DIR__ . '/../config/database.php';

class Accommodation {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    /**
     * Získať všetky ubytovania
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM accommodations WHERE aktivne = true ORDER BY datum_vytvorenia DESC");
        return $stmt->fetchAll();
    }

    /**
     * Získať ubytovanie podľa ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM accommodations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Vytvoriť nové ubytovanie
     */
    public function create($data) {
        $sql = "INSERT INTO accommodations (user_id, nazov, popis, adresa, kapacita, cena_za_noc, vybavenie, obrazok) 
                VALUES (:user_id, :nazov, :popis, :adresa, :kapacita, :cena_za_noc, :vybavenie, :obrazok)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'user_id' => $data['user_id'],
            'nazov' => $data['nazov'],
            'popis' => $data['popis'],
            'adresa' => $data['adresa'],
            'kapacita' => $data['kapacita'],
            'cena_za_noc' => $data['cena_za_noc'],
            'vybavenie' => $data['vybavenie'],
            'obrazok' => $data['obrazok'] ?? null
        ]);
    }

    /**
     * Aktualizovať ubytovanie
     */
    public function update($id, $data) {
        $sql = "UPDATE accommodations 
                SET nazov = :nazov, popis = :popis, adresa = :adresa, 
                    kapacita = :kapacita, cena_za_noc = :cena_za_noc, 
                    vybavenie = :vybavenie, obrazok = :obrazok, aktivne = :aktivne
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'nazov' => $data['nazov'],
            'popis' => $data['popis'],
            'adresa' => $data['adresa'],
            'kapacita' => $data['kapacita'],
            'cena_za_noc' => $data['cena_za_noc'],
            'vybavenie' => $data['vybavenie'],
            'obrazok' => $data['obrazok'] ?? null,
            'aktivne' => $data['aktivne'] ?? true
        ]);
    }

    /**
     * Vymazať ubytovanie
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM accommodations WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Vyhľadávanie s filtrami
     */
    public function search($filters = []) {
        $sql = "SELECT * FROM accommodations WHERE aktivne = true";
        $params = [];

        if (!empty($filters['kapacita'])) {
            $sql .= " AND kapacita >= :kapacita";
            $params['kapacita'] = $filters['kapacita'];
        }

        if (!empty($filters['max_cena'])) {
            $sql .= " AND cena_za_noc <= :max_cena";
            $params['max_cena'] = $filters['max_cena'];
        }

        if (!empty($filters['vybavenie'])) {
            $sql .= " AND vybavenie ILIKE :vybavenie";
            $params['vybavenie'] = '%' . $filters['vybavenie'] . '%';
        }

        $sql .= " ORDER BY datum_vytvorenia DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
