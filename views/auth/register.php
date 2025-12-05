<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card auth-card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus auth-icon"></i>
                        <h3>Registrácia</h3>
                    </div>

                    <?php if (!empty($errors['register'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($errors['register']) ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?page=register&action=register" method="POST" id="registerForm" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="meno" class="form-label">Meno *</label>
                                <input type="text" class="form-control <?= !empty($errors['meno']) ? 'is-invalid' : '' ?>" 
                                       id="meno" name="meno" 
                                       value="<?= htmlspecialchars($data['meno'] ?? '') ?>" 
                                       required minlength="2">
                                <div class="invalid-feedback">
                                    <?= $errors['meno'] ?? 'Meno musí mať minimálne 2 znaky' ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="priezvisko" class="form-label">Priezvisko *</label>
                                <input type="text" class="form-control <?= !empty($errors['priezvisko']) ? 'is-invalid' : '' ?>" 
                                       id="priezvisko" name="priezvisko" 
                                       value="<?= htmlspecialchars($data['priezvisko'] ?? '') ?>" 
                                       required minlength="2">
                                <div class="invalid-feedback">
                                    <?= $errors['priezvisko'] ?? 'Priezvisko musí mať minimálne 2 znaky' ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" 
                                       id="email" name="email" 
                                       value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    <?= $errors['email'] ?? 'Zadajte platný email' ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="telefon" class="form-label">Telefón</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="telefon" name="telefon" 
                                       value="<?= htmlspecialchars($data['telefon'] ?? '') ?>"
                                       placeholder="+421...">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="heslo" class="form-label">Heslo *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control <?= !empty($errors['heslo']) ? 'is-invalid' : '' ?>" 
                                       id="heslo" name="heslo" required minlength="6">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('heslo')">
                                    <i class="bi bi-eye" id="heslo-icon"></i>
                                </button>
                                <div class="invalid-feedback">
                                    <?= $errors['heslo'] ?? 'Heslo musí mať minimálne 6 znakov' ?>
                                </div>
                            </div>
                            <div class="password-strength mt-2" id="passwordStrength"></div>
                        </div>

                        <div class="mb-3">
                            <label for="heslo_potvrdenie" class="form-label">Potvrdenie hesla *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control <?= !empty($errors['heslo_potvrdenie']) ? 'is-invalid' : '' ?>" 
                                       id="heslo_potvrdenie" name="heslo_potvrdenie" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('heslo_potvrdenie')">
                                    <i class="bi bi-eye" id="heslo_potvrdenie-icon"></i>
                                </button>
                                <div class="invalid-feedback">
                                    <?= $errors['heslo_potvrdenie'] ?? 'Heslá sa nezhodujú' ?>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-person-plus"></i> Zaregistrovať sa
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">Už máte účet? 
                            <a href="index.php?page=login">Prihláste sa</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
