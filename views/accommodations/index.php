<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-house"></i> Ubytovanie</h1>
        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['rola'] === 'ubytovatel' || $_SESSION['user']['rola'] === 'admin')): ?>
            <a href="index.php?page=accommodations&action=create" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Pridať ubytovanie
            </a>
        <?php endif; ?>
    </div>

    <!-- Hlášky -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php
            switch ($_GET['success']) {
                case 'created': echo 'Ubytovanie bolo úspešne pridané.'; break;
                case 'updated': echo 'Ubytovanie bolo úspešne aktualizované.'; break;
                case 'deleted': echo 'Ubytovanie bolo úspešne vymazané.'; break;
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php
            switch ($_GET['error']) {
                case 'not_found': echo 'Ubytovanie nebolo nájdené.'; break;
                default: echo 'Nastala chyba, skúste to znova.';
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filter panel -->
    <div class="card mb-4 filter-card">
        <div class="card-body">
            <form action="index.php" method="GET" class="row g-3">
                <input type="hidden" name="page" value="accommodations">
                <div class="col-md-3">
                    <label class="form-label">Min. kapacita</label>
                    <select class="form-select" name="kapacita">
                        <option value="">Všetky</option>
                        <option value="2" <?= ($_GET['kapacita'] ?? '') == '2' ? 'selected' : '' ?>>2+ osoby</option>
                        <option value="4" <?= ($_GET['kapacita'] ?? '') == '4' ? 'selected' : '' ?>>4+ osoby</option>
                        <option value="6" <?= ($_GET['kapacita'] ?? '') == '6' ? 'selected' : '' ?>>6+ osôb</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Max. cena za noc</label>
                    <input type="number" class="form-control" name="max_cena" 
                           value="<?= htmlspecialchars($_GET['max_cena'] ?? '') ?>" placeholder="€">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Vybavenie</label>
                    <input type="text" class="form-control" name="vybavenie" 
                           value="<?= htmlspecialchars($_GET['vybavenie'] ?? '') ?>" placeholder="napr. WiFi">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Filtrovať
                    </button>
                    <a href="index.php?page=accommodations" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Zoznam ubytovaní -->
    <div class="row g-4">
        <?php if (empty($accommodations)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Zatiaľ nie sú k dispozícii žiadne ubytovania.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($accommodations as $acc): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card accommodation-card h-100">
                        <div class="card-img-top accommodation-image" 
                             style="background-color: #2c5e1a;">
                            <span class="price-badge"><?= number_format($acc['cena_za_noc'], 0) ?>€ / noc</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($acc['nazov']) ?></h5>
                            <p class="card-text text-muted">
                                <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($acc['adresa']) ?>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-people"></i> Max. <?= $acc['kapacita'] ?> osôb
                            </p>
                            <div class="accommodation-features">
                                <?php 
                                $features = explode(',', $acc['vybavenie'] ?? '');
                                foreach (array_slice($features, 0, 3) as $feature): 
                                    $feature = trim($feature);
                                    if (!empty($feature)):
                                ?>
                                    <span class="badge bg-light text-dark"><?= htmlspecialchars($feature) ?></span>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="index.php?page=accommodations&action=show&id=<?= $acc['id'] ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if (isset($_SESSION['user']) && 
                                    ($_SESSION['user']['id'] == $acc['user_id'] || $_SESSION['user']['rola'] === 'admin')): ?>
                                    <div>
                                        <a href="index.php?page=accommodations&action=edit&id=<?= $acc['id'] ?>" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="confirmDelete(<?= $acc['id'] ?>, 'accommodation')">
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
