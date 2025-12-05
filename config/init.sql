-- Vytvorenie databázy pre aplikáciu Apartmány pod Roháčmi
-- Spustiť v PostgreSQL

-- Vytvorenie ENUM typov
CREATE TYPE user_role AS ENUM ('turista', 'ubytovatel', 'admin');
CREATE TYPE reservation_status AS ENUM ('cakajuca', 'potvrdena', 'zrusena', 'dokoncena');

-- Tabuľka používateľov
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    heslo VARCHAR(255) NOT NULL,
    meno VARCHAR(100) NOT NULL,
    priezvisko VARCHAR(100) NOT NULL,
    telefon VARCHAR(20),
    rola user_role DEFAULT 'turista',
    datum_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabuľka ubytovaní
CREATE TABLE accommodations (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    nazov VARCHAR(255) NOT NULL,
    popis TEXT,
    adresa VARCHAR(255) NOT NULL,
    kapacita INTEGER NOT NULL,
    cena_za_noc DECIMAL(10, 2) NOT NULL,
    vybavenie TEXT,
    aktivne BOOLEAN DEFAULT true,
    obrazok VARCHAR(255),
    datum_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabuľka atrakcií
CREATE TABLE attractions (
    id SERIAL PRIMARY KEY,
    nazov VARCHAR(255) NOT NULL,
    popis TEXT,
    typ VARCHAR(100),
    obrazok VARCHAR(255),
    datum_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabuľka rezervácií
CREATE TABLE reservations (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    accommodation_id INTEGER REFERENCES accommodations(id) ON DELETE CASCADE,
    datum_od DATE NOT NULL,
    datum_do DATE NOT NULL,
    pocet_osob INTEGER NOT NULL,
    celkova_cena DECIMAL(10, 2) NOT NULL,
    stav reservation_status DEFAULT 'cakajuca',
    datum_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabuľka hodnotení
CREATE TABLE reviews (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    accommodation_id INTEGER REFERENCES accommodations(id) ON DELETE CASCADE,
    hodnotenie INTEGER CHECK (hodnotenie >= 1 AND hodnotenie <= 5),
    komentar TEXT,
    datum_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Spojovacia tabuľka ubytovanie-atrakcia
CREATE TABLE accommodation_attractions (
    id SERIAL PRIMARY KEY,
    accommodation_id INTEGER REFERENCES accommodations(id) ON DELETE CASCADE,
    attraction_id INTEGER REFERENCES attractions(id) ON DELETE CASCADE,
    vzdialenost_km DECIMAL(5, 2),
    UNIQUE(accommodation_id, attraction_id)
);

-- Vloženie testovacích dát
INSERT INTO users (email, heslo, meno, priezvisko, telefon, rola) VALUES
('admin@apartmany.sk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'Systému', '+421900000000', 'admin'),
('ubytovatel@test.sk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ján', 'Novák', '+421901234567', 'ubytovatel'),
('turista@test.sk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Peter', 'Horvát', '+421909876543', 'turista');

INSERT INTO accommodations (user_id, nazov, popis, adresa, kapacita, cena_za_noc, vybavenie) VALUES
(2, 'Chata Roháče', 'Útulná horská chata s výhľadom na Roháče', 'Zuberec 123', 6, 89.00, 'WiFi, Parkovisko, Krb, TV, Kuchyňa'),
(2, 'Apartmán Zuberec', 'Moderný apartmán v centre obce', 'Zuberec 456', 4, 65.00, 'WiFi, Parkovisko, TV, Kuchyňa, Balkón');

INSERT INTO attractions (nazov, popis, typ) VALUES
('Roháčske plesá', 'Nádherné horské plesá v srdci Západných Tatier', 'Turistika'),
('Ski Zuberec', 'Lyžiarske stredisko s modernými vlekmi', 'Lyžovanie'),
('Múzeum oravskej dediny', 'Skanzen prezentujúci tradičnú oravskú architektúru', 'Kultúra');
