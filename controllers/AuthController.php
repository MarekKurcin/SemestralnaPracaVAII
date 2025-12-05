<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new User();
    }

    /**
     * Zobrazenie prihlasovacieho formulára
     */
    public function loginForm() {
        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Spracovanie prihlásenia
     */
    public function login() {
        $errors = [];

        $email = trim($_POST['email'] ?? '');
        $heslo = $_POST['heslo'] ?? '';

        // Validácia na strane servera
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Zadajte platný email';
        }

        if (empty($heslo)) {
            $errors['heslo'] = 'Zadajte heslo';
        }

        if (!empty($errors)) {
            require __DIR__ . '/../views/auth/login.php';
            return;
        }

        $user = $this->model->login($email, $heslo);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php?page=home&success=logged_in');
        } else {
            $errors['login'] = 'Nesprávny email alebo heslo';
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    /**
     * Zobrazenie registračného formulára
     */
    public function registerForm() {
        require __DIR__ . '/../views/auth/register.php';
    }

    /**
     * Spracovanie registrácie
     */
    public function register() {
        $errors = $this->validateRegistration($_POST);

        if (!empty($errors)) {
            $data = $_POST;
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        // Kontrola či email už existuje
        if ($this->model->emailExists($_POST['email'])) {
            $errors['email'] = 'Tento email je už registrovaný';
            $data = $_POST;
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        $data = [
            'email' => trim($_POST['email']),
            'heslo' => $_POST['heslo'],
            'meno' => htmlspecialchars(trim($_POST['meno'])),
            'priezvisko' => htmlspecialchars(trim($_POST['priezvisko'])),
            'telefon' => htmlspecialchars(trim($_POST['telefon'] ?? '')),
            'rola' => 'turista'
        ];

        if ($this->model->register($data)) {
            header('Location: index.php?page=login&success=registered');
        } else {
            $errors['register'] = 'Registrácia zlyhala, skúste to znova';
            require __DIR__ . '/../views/auth/register.php';
        }
    }

    /**
     * Odhlásenie
     */
    public function logout() {
        session_destroy();
        header('Location: index.php?page=home&success=logged_out');
        exit;
    }

    /**
     * Validácia registračných údajov
     */
    private function validateRegistration($data) {
        $errors = [];

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Zadajte platný email';
        }

        if (empty($data['heslo']) || strlen($data['heslo']) < 6) {
            $errors['heslo'] = 'Heslo musí mať minimálne 6 znakov';
        }

        if ($data['heslo'] !== ($data['heslo_potvrdenie'] ?? '')) {
            $errors['heslo_potvrdenie'] = 'Heslá sa nezhodujú';
        }

        if (empty($data['meno']) || strlen(trim($data['meno'])) < 2) {
            $errors['meno'] = 'Meno musí mať minimálne 2 znaky';
        }

        if (empty($data['priezvisko']) || strlen(trim($data['priezvisko'])) < 2) {
            $errors['priezvisko'] = 'Priezvisko musí mať minimálne 2 znaky';
        }

        return $errors;
    }
}
