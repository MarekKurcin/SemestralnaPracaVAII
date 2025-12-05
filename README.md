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



## Autor

Marek Kurcin - VAII 2024/2025
