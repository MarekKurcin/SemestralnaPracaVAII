<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Domov</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=accommodations">Ubytovanie</a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($accommodation['nazov']) ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Hlavný obsah -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="accommodation-detail-image" 
                     style="background-color: #2c5e1a;">
                </div>
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($accommodation['nazov']) ?></h1>
                    <p class="text-muted">
                        <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($accommodation['adresa']) ?>
                    </p>
                    
                    <hr>
                    
                    <h5>Popis</h5>
                    <p><?= nl2br(htmlspecialchars($accommodation['popis'] ?? 'Bez popisu')) ?></p>
                    
                    <hr>
                    
                    <h5>Vybavenie</h5>
                    <div class="accommodation-features-detail">
                        <?php 
                        $features = explode(',', $accommodation['vybavenie'] ?? '');
                        foreach ($features as $feature): 
                            $feature = trim($feature);
                            if (!empty($feature)):
                        ?>
                            <span class="badge bg-primary me-2 mb-2">
                                <i class="bi bi-check-lg"></i> <?= htmlspecialchars($feature) ?>
                            </span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bočný panel -->
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 100px;">
                <div class="card-body">
                    <div class="price-display text-center mb-3">
                        <span class="h2 text-primary"><?= number_format($accommodation['cena_za_noc'], 0) ?>€</span>
                        <span class="text-muted">/ noc</span>
                    </div>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-people text-primary"></i> 
                            Max. <strong><?= $accommodation['kapacita'] ?></strong> osôb
                        </li>
                    </ul>

                    <hr>

                    <!-- Rezervačný formulár -->
                    <form action="index.php?page=reservations&action=create" method="GET" id="reservationForm">
                        <input type="hidden" name="accommodation_id" value="<?= $accommodation['id'] ?>">
                        
                        <div class="mb-3">
                            <label for="datum_od" class="form-label">Dátum príchodu</label>
                            <input type="date" class="form-control" id="datum_od" name="datum_od" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="datum_do" class="form-label">Dátum odchodu</label>
                            <input type="date" class="form-control" id="datum_do" name="datum_do" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="pocet_osob" class="form-label">Počet osôb</label>
                            <select class="form-select" id="pocet_osob" name="pocet_osob" required>
                                <?php for ($i = 1; $i <= $accommodation['kapacita']; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?> <?= $i == 1 ? 'osoba' : ($i < 5 ? 'osoby' : 'osôb') ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="mb-3 total-price-box d-none" id="totalPriceBox">
                            <strong>Celková cena:</strong>
                            <span class="h4 text-primary" id="totalPrice">0€</span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-calendar-check"></i> Rezervovať
                        </button>
                    </form>

                    <?php if (isset($_SESSION['user']) && 
                        ($_SESSION['user']['id'] == $accommodation['user_id'] || $_SESSION['user']['rola'] === 'admin')): ?>
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="index.php?page=accommodations&action=edit&id=<?= $accommodation['id'] ?>" 
                               class="btn btn-outline-warning flex-fill">
                                <i class="bi bi-pencil"></i> Upraviť
                            </a>
                            <button type="button" class="btn btn-outline-danger flex-fill" 
                                    onclick="confirmDelete(<?= $accommodation['id'] ?>, 'accommodation')">
                                <i class="bi bi-trash"></i> Vymazať
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Výpočet celkovej ceny
    const pricePerNight = <?= $accommodation['cena_za_noc'] ?>;
    
    document.getElementById('datum_od').addEventListener('change', calculateTotal);
    document.getElementById('datum_do').addEventListener('change', calculateTotal);
    
    function calculateTotal() {
        const dateFrom = new Date(document.getElementById('datum_od').value);
        const dateTo = new Date(document.getElementById('datum_do').value);
        
        if (dateFrom && dateTo && dateTo > dateFrom) {
            const nights = Math.ceil((dateTo - dateFrom) / (1000 * 60 * 60 * 24));
            const total = nights * pricePerNight;
            
            document.getElementById('totalPrice').textContent = total + '€';
            document.getElementById('totalPriceBox').classList.remove('d-none');
        }
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
