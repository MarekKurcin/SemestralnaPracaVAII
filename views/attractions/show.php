<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Domov</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=attractions">Atrakcie</a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($attraction['nazov']) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="attraction-detail-image" style="background-color: #4a9c2d;">
                    <span class="attraction-badge attraction-badge-lg"><?= htmlspecialchars($attraction['typ'] ?? 'Iné') ?></span>
                </div>
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($attraction['nazov']) ?></h1>
                    
                    <hr>
                    
                    <h5>Popis</h5>
                    <p><?= nl2br(htmlspecialchars($attraction['popis'] ?? 'Bez popisu')) ?></p>
                    
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['rola'] === 'admin'): ?>
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="index.php?page=attractions&action=edit&id=<?= $attraction['id'] ?>" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Upraviť
                            </a>
                            <button type="button" class="btn btn-danger" 
                                    onclick="confirmDelete(<?= $attraction['id'] ?>, 'attraction')">
                                <i class="bi bi-trash"></i> Vymazať
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-house"></i> Najbližšie ubytovanie</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Hľadáte ubytovanie v blízkosti tejto atrakcie?</p>
                    <a href="index.php?page=accommodations" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Nájsť ubytovanie
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
