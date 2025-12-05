# Apartmány pod Roháčmi

Webová aplikácia pre správu a rezerváciu ubytovania v okolí Zuberca a Západných Tatier.

## Popis projektu

Aplikácia Apartmány pod Roháčmi je webová platforma, ktorej cieľom je sústrediť ponuku ubytovania od miestnych poskytovateľov zo Zuberca na jednom mieste. Systém umožní jednotlivým ubytovateľom prezentovať svoje objekty bez nutnosti platiť vysoké poplatky veľkým rezervačným portálom.

## Štruktúra projektu

```
apartmany-rohace/
├── config/
│   ├── database.php        # Konfigurácia databázy
│   └── init.sql            # SQL script pre vytvorenie tabuliek
├── controllers/
│   ├── AccommodationController.php
│   ├── AttractionController.php
│   └── AuthController.php
├── models/
│   ├── Accommodation.php
│   ├── Attraction.php
│   └── User.php
├── views/
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   ├── accommodations/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── show.php
│   ├── attractions/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── show.php
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   └── home.php
├── public/
│   ├── css/
│   │   └── style.css       # Vlastné CSS (20+ pravidiel)
│   └── js/
│       └── app.js          # JavaScript validácia + funkcie
├── index.php               # Hlavný vstupný bod (router)
└── README.md
```

## Technológie

- **Backend:** PHP 8+
- **Databáza:** PostgreSQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Framework CSS:** Bootstrap 5.3
- **Ikony:** Bootstrap Icons

## Splnené požiadavky pre Checkpoint 2

- [x] Projekt uložený v GIT repozitári
- [x] Minimálne 10 vlastných CSS pravidiel (20+ v style.css)
- [x] Základné rozloženie webu
- [x] Responzívny dizajn (mobil, tablet, desktop)
- [x] CRUD operácie pre Ubytovanie (Create, Read, Update, Delete)
- [x] CRUD operácie pre Atrakcie (Create, Read, Update, Delete)
- [x] Validácia formulárov na strane klienta (JavaScript)
- [x] Validácia formulárov na strane servera (PHP)
- [x] Netriviálny JavaScript (animácie, password strength, interaktívne prvky)

## Inštalácia

1. Naklonujte repozitár:
```bash
git clone <url-repozitara>
cd apartmany-rohace
```

2. Vytvorte PostgreSQL databázu:
```sql
CREATE DATABASE apartmany_rohace;
```

3. Spustite SQL script pre vytvorenie tabuliek:
```bash
psql -U postgres -d apartmany_rohace -f config/init.sql
```

4. Upravte prihlasovacie údaje v `config/database.php`

5. Spustite PHP server:
```bash
php -S localhost:8000
```

6. Otvorte prehliadač na adrese `http://localhost:8000`

## Testovacie účty

| Email | Heslo | Rola |
|-------|-------|------|
| admin@apartmany.sk | password | Admin |
| ubytovatel@test.sk | password | Ubytovateľ |
| turista@test.sk | password | Turista |

## CRUD Operácie

### Ubytovanie (Accommodation)
- **Create:** Pridanie nového ubytovania (formulár s validáciou)
- **Read:** Zobrazenie zoznamu a detailu ubytovania
- **Update:** Úprava existujúceho ubytovania
- **Delete:** Vymazanie ubytovania

### Atrakcie (Attraction)
- **Create:** Pridanie novej atrakcie (len admin)
- **Read:** Zobrazenie zoznamu a detailu atrakcií
- **Update:** Úprava atrakcie (len admin)
- **Delete:** Vymazanie atrakcie (len admin)

## Autor

Marek Kurcin - VAII 2024/2025
