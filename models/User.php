<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    /**
     * Registrácia nového používateľa
     */
    public function register($data) {
        $sql = "INSERT INTO users (email, heslo, meno, priezvisko, telefon, rola) 
                VALUES (:email, :heslo, :meno, :priezvisko, :telefon, :rola)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'email' => $data['email'],
            'heslo' => password_hash($data['heslo'], PASSWORD_DEFAULT),
            'meno' => $data['meno'],
            'priezvisko' => $data['priezvisko'],
            'telefon' => $data['telefon'] ?? null,
            'rola' => $data['rola'] ?? 'turista'
        ]);
    }

    /**
     * Prihlásenie používateľa
     */
    public function login($email, $heslo) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($heslo, $user['heslo'])) {
            unset($user['heslo']); // Neposielame heslo do session
            return $user;
        }
        return false;
    }

    /**
     * Získať používateľa podľa ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT id, email, meno, priezvisko, telefon, rola, datum_vytvorenia FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Získať používateľa podľa emailu
     */
    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Aktualizovať profil používateľa
     */
    public function update($id, $data) {
        $sql = "UPDATE users 
                SET meno = :meno, priezvisko = :priezvisko, telefon = :telefon
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'meno' => $data['meno'],
            'priezvisko' => $data['priezvisko'],
            'telefon' => $data['telefon']
        ]);
    }

    /**
     * Kontrola či email existuje
     */
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}
