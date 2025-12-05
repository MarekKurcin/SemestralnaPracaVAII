<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Domov</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=attractions">Atrakcie</a></li>
            <li class="breadcrumb-item active">Pridať atrakciu</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-plus-lg"></i> Pridať novú atrakciu</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?page=attractions&action=store" method="POST" 
                          id="attractionForm" novalidate>
                        
                        <div class="mb-3">
                            <label for="nazov" class="form-label">Názov atrakcie *</label>
                            <input type="text" class="form-control" id="nazov" name="nazov" 
                                   value="<?= htmlspecialchars($data['nazov'] ?? '') ?>" 
                                   required minlength="3">
                            <div class="invalid-feedback">Názov musí mať minimálne 3 znaky</div>
                        </div>

                        <div class="mb-3">
                            <label for="typ" class="form-label">Typ atrakcie *</label>
                            <select class="form-select" id="typ" name="typ" required>
                                <option value="">Vyberte typ...</option>
                                <option value="Turistika" <?= ($data['typ'] ?? '') === 'Turistika' ? 'selected' : '' ?>>Turistika</option>
                                <option value="Lyžovanie" <?= ($data['typ'] ?? '') === 'Lyžovanie' ? 'selected' : '' ?>>Lyžovanie</option>
                                <option value="Kultúra" <?= ($data['typ'] ?? '') === 'Kultúra' ? 'selected' : '' ?>>Kultúra</option>
                                <option value="Šport" <?= ($data['typ'] ?? '') === 'Šport' ? 'selected' : '' ?>>Šport</option>
                                <option value="Príroda" <?= ($data['typ'] ?? '') === 'Príroda' ? 'selected' : '' ?>>Príroda</option>
                                <option value="Relax" <?= ($data['typ'] ?? '') === 'Relax' ? 'selected' : '' ?>>Relax</option>
                            </select>
                            <div class="invalid-feedback">Vyberte typ atrakcie</div>
                        </div>

                        <div class="mb-3">
                            <label for="popis" class="form-label">Popis</label>
                            <textarea class="form-control" id="popis" name="popis" rows="5"><?= htmlspecialchars($data['popis'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="obrazok" class="form-label">URL obrázka</label>
                            <input type="url" class="form-control" id="obrazok" name="obrazok" 
                                   value="<?= htmlspecialchars($data['obrazok'] ?? '') ?>"
                                   placeholder="https://...">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Uložiť
                            </button>
                            <a href="index.php?page=attractions" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg"></i> Zrušiť
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
