<?php require_once __DIR__ . '/layouts/header.php'; ?>

<!-- Hero sekcia -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1 class="hero-title">Objavte krásy Roháčov</h1>
        <p class="hero-subtitle">Nájdite si dokonalé ubytovanie v srdci Západných Tatier</p>
        
        <!-- Vyhľadávací formulár -->
        <div class="search-box">
            <form action="index.php" method="GET" class="row g-3">
                <input type="hidden" name="page" value="accommodations">
                <div class="col-md-3">
                    <label class="form-label">Dátum príchodu</label>
                    <input type="date" class="form-control" name="datum_od">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dátum odchodu</label>
                    <input type="date" class="form-control" name="datum_do">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Počet osôb</label>
                    <select class="form-select" name="kapacita">
                        <option value="">Všetky</option>
                        <option value="2">2 osoby</option>
                        <option value="4">4 osoby</option>
                        <option value="6">6+ osôb</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Max. cena/noc</label>
                    <input type="number" class="form-control" name="max_cena" placeholder="€">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Hľadať
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Sekcia - Prečo si vybrať nás -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Prečo si vybrať ubytovanie u nás?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-currency-euro"></i>
                    </div>
                    <h4>Férové ceny</h4>
                    <p>Bez vysokých provízií rezervačných portálov. Platíte priamo ubytovateľom.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4>Lokálni poskytovatelia</h4>
                    <p>Podporujete miestnych obyvateľov a získavate autentický zážitok.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-tree"></i>
                    </div>
                    <h4>Krásna príroda</h4>
                    <p>Západné Tatry ponúkajú nezabudnuteľné výhľady a turistické trasy.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcia - Populárne atrakcie -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Objavte okolie</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="attraction-card">
                    <div class="attraction-image" style="background-color: #2c5e1a;">
                        <span class="attraction-badge">Turistika</span>
                    </div>
                    <div class="attraction-content p-3">
                        <h5>Roháčske plesá</h5>
                        <p>Nádherné horské plesá v srdci Západných Tatier</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="attraction-card">
                    <div class="attraction-image" style="background-color: #4a9c2d;">
                        <span class="attraction-badge">Lyžovanie</span>
                    </div>
                    <div class="attraction-content p-3">
                        <h5>Ski Zuberec</h5>
                        <p>Lyžiarske stredisko s modernými vlekmi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="attraction-card">
                    <div class="attraction-image" style="background-color: #87bc63;">
                        <span class="attraction-badge">Kultúra</span>
                    </div>
                    <div class="attraction-content p-3">
                        <h5>Múzeum oravskej dediny</h5>
                        <p>Skanzen prezentujúci tradičnú architektúru</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="index.php?page=attractions" class="btn btn-outline-primary">Zobraziť všetky atrakcie</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
