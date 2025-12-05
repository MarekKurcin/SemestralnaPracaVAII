<?php
require_once __DIR__ . '/../config/database.php';

class Attraction {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    /**
     * Získať všetky atrakcie
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM attractions ORDER BY datum_vytvorenia DESC");
        return $stmt->fetchAll();
    }

    /**
     * Získať atrakciu podľa ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM attractions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Vytvoriť novú atrakciu
     */
    public function create($data) {
        $sql = "INSERT INTO attractions (nazov, popis, typ, obrazok) 
                VALUES (:nazov, :popis, :typ, :obrazok)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nazov' => $data['nazov'],
            'popis' => $data['popis'],
            'typ' => $data['typ'],
            'obrazok' => $data['obrazok'] ?? null
        ]);
    }

    /**
     * Aktualizovať atrakciu
     */
    public function update($id, $data) {
        $sql = "UPDATE attractions 
                SET nazov = :nazov, popis = :popis, typ = :typ, obrazok = :obrazok
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'nazov' => $data['nazov'],
            'popis' => $data['popis'],
            'typ' => $data['typ'],
            'obrazok' => $data['obrazok'] ?? null
        ]);
    }

    /**
     * Vymazať atrakciu
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM attractions WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Získať atrakcie podľa typu
     */
    public function getByType($typ) {
        $stmt = $this->db->prepare("SELECT * FROM attractions WHERE typ = :typ ORDER BY nazov");
        $stmt->execute(['typ' => $typ]);
        return $stmt->fetchAll();
    }

    /**
     * Získať atrakcie pre konkrétne ubytovanie
     */
    public function getForAccommodation($accommodationId) {
        $sql = "SELECT a.*, aa.vzdialenost_km 
                FROM attractions a
                JOIN accommodation_attractions aa ON a.id = aa.attraction_id
                WHERE aa.accommodation_id = :accommodation_id
                ORDER BY aa.vzdialenost_km";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['accommodation_id' => $accommodationId]);
        return $stmt->fetchAll();
    }
}
