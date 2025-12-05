<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-compass"></i> Atrakcie v okolí</h1>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['rola'] === 'admin'): ?>
            <a href="index.php?page=attractions&action=create" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Pridať atrakciu
            </a>
        <?php endif; ?>
    </div>

    <!-- Hlášky -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php
            switch ($_GET['success']) {
                case 'created': echo 'Atrakcia bola úspešne pridaná.'; break;
                case 'updated': echo 'Atrakcia bola úspešne aktualizovaná.'; break;
                case 'deleted': echo 'Atrakcia bola úspešne vymazaná.'; break;
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filter podľa typu -->
    <div class="mb-4">
        <div class="btn-group" role="group">
            <a href="index.php?page=attractions" 
               class="btn btn-outline-primary <?= empty($_GET['typ']) ? 'active' : '' ?>">Všetky</a>
            <a href="index.php?page=attractions&typ=Turistika" 
               class="btn btn-outline-primary <?= ($_GET['typ'] ?? '') === 'Turistika' ? 'active' : '' ?>">
                <i class="bi bi-signpost"></i> Turistika
            </a>
            <a href="index.php?page=attractions&typ=Lyžovanie" 
               class="btn btn-outline-primary <?= ($_GET['typ'] ?? '') === 'Lyžovanie' ? 'active' : '' ?>">
                <i class="bi bi-snow"></i> Lyžovanie
            </a>
            <a href="index.php?page=attractions&typ=Kultúra" 
               class="btn btn-outline-primary <?= ($_GET['typ'] ?? '') === 'Kultúra' ? 'active' : '' ?>">
                <i class="bi bi-bank"></i> Kultúra
            </a>
        </div>
    </div>

    <!-- Zoznam atrakcií -->
    <div class="row g-4">
        <?php if (empty($attractions)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Zatiaľ nie sú k dispozícii žiadne atrakcie.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($attractions as $attr): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card attraction-card h-100">
                        <div class="card-img-top attraction-image" 
                             style="background-color: #4a9c2d;">
                            <span class="attraction-badge"><?= htmlspecialchars($attr['typ'] ?? 'Iné') ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($attr['nazov']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($attr['popis'] ?? '', 0, 100)) ?>...</p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="index.php?page=attractions&action=show&id=<?= $attr['id'] ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['rola'] === 'admin'): ?>
                                    <div>
                                        <a href="index.php?page=attractions&action=edit&id=<?= $attr['id'] ?>" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="confirmDelete(<?= $attr['id'] ?>, 'attraction')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
