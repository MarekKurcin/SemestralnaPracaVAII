<?php
/**
 * Apartmány pod Roháčmi - Hlavný vstupný bod aplikácie
 * MVC Router
 */

session_start();

// Načítanie kontrolérov
require_once __DIR__ . '/controllers/AccommodationController.php';
require_once __DIR__ . '/controllers/AttractionController.php';
require_once __DIR__ . '/controllers/AuthController.php';

// Získanie parametrov z URL
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Router
switch ($page) {
    case 'home':
        require_once __DIR__ . '/views/home.php';
        break;
    
    // Ubytovanie
    case 'accommodations':
        $controller = new AccommodationController();
        
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'show':
                $controller->show($id);
                break;
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                $controller->edit($id);
                break;
            case 'update':
                $controller->update($id);
                break;
            case 'delete':
                $controller->delete($id);
                break;
            default:
                $controller->index();
        }
        break;
    
    // Atrakcie
    case 'attractions':
        $controller = new AttractionController();
        
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'show':
                $controller->show($id);
                break;
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                $controller->edit($id);
                break;
            case 'update':
                $controller->update($id);
                break;
            case 'delete':
                $controller->delete($id);
                break;
            default:
                $controller->index();
        }
        break;
    
    // Autentifikácia
    case 'login':
        $controller = new AuthController();
        
        if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->loginForm();
        }
        break;
    
    case 'register':
        $controller = new AuthController();
        
        if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->registerForm();
        }
        break;
    
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
    // 404 - Stránka nenájdená
    default:
        http_response_code(404);
        require_once __DIR__ . '/views/layouts/header.php';
        echo '<div class="container py-5 text-center">';
        echo '<h1 class="display-1">404</h1>';
        echo '<p class="lead">Stránka nebola nájdená</p>';
        echo '<a href="index.php" class="btn btn-primary">Späť na domov</a>';
        echo '</div>';
        require_once __DIR__ . '/views/layouts/footer.php';
}
