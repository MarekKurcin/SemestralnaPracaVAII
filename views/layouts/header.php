<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartmány pod Roháčmi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Vlastné CSS štýly -->
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigácia -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-house-heart"></i> Apartmány pod Roháčmi
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=accommodations">Ubytovanie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=attractions">Atrakcie</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> 
                                <?= htmlspecialchars($_SESSION['user']['meno']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?page=profile">Môj profil</a></li>
                                <?php if ($_SESSION['user']['rola'] === 'ubytovatel' || $_SESSION['user']['rola'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="index.php?page=accommodations&action=create">Pridať ubytovanie</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['user']['rola'] === 'admin'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="index.php?page=attractions&action=create">Pridať atrakciu</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?page=logout">Odhlásiť sa</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Prihlásenie</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2" href="index.php?page=register">Registrácia</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hlavný obsah -->
    <main class="main-content">
