<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Checklist

### Inhoud
- [x] Maak een website met Laravel (minstens versie 11)
- [x] Zorg voor dynamisch gegevens ophalen en wegschrijven naar een database
- [x] Vermijd het copy/pasten van een complete online tutorial
- [x] Gebruik online informatiebronnen als:
  - [x] Je de code begrijpt en kan uitleggen
  - [x] Correcte bronvermelding toevoegt voor gebruikte code
- [x] Kies zelf het onderwerp van je project (bijv. zaak van familielid, sportclub, muziekfestival)

### Functionele minimum requirements
- [x] Informatieve data-driven website met de volgende features:

#### Login systeem
- [x] Bezoekers kunnen inloggen
- [x] Bezoekers kunnen een nieuwe account aanmaken
- [x] Useraccount kan gewone gebruiker of admin zijn
- [ ] Enkel admins kunnen andere gebruikers verheffen tot admin en deze rechten afnemen
- [ ] Enkel admins kunnen manueel een nieuwe gebruiker aanmaken

#### Profielpagina
- [x] Elke gebruiker heeft een publieke profielpagina toegankelijk voor iedereen
- [x] Ingelogde gebruikers kunnen hun eigen data aanpassen
- [x] Profiel bevat de volgende gegevens:
  - [x] Username
  - [x] Verjaardag
  - [x] Profielfoto (op webserver bewaard)
  - [x] "Over mij" tekst

#### Laatste nieuwtjes
- [ ] Admins kunnen nieuwsitems toevoegen, wijzigen en verwijderen
- [x] Bezoekers kunnen alle nieuwtjes en een detail per nieuwtje bekijken
- [x] Nieuwsitems bevatten:
  - [x] Titel
  - [x] Afbeelding (opgeslagen op de server)
  - [x] Content
  - [x] Publicatiedatum

#### FAQ pagina
- [x] FAQ-pagina bevat vragen en antwoorden, gegroepeerd per categorie
- [ ] Admins kunnen categorieën en vraag/antwoorden toevoegen, wijzigen en verwijderen
- [x] Bezoekers kunnen de FAQ zien

#### Contact pagina
- [x] Bezoekers kunnen een contactformulier invullen
- [x] Admin ontvangt een email met de inhoud van het formulier bij versturen

### Extra features
- [ ] Overzicht van ingevulde contactformulieren voor admins in een admin-panel
- [ ] Gebruikers kunnen commentaar achterlaten op nieuwtjes
- [ ] Gebruikers kunnen berichten posten op andere profielen of privéberichten sturen
- [ ] Gebruikers kunnen FAQ-vragen toevoegen
- [ ] Voeg logische extra features toe passend bij het projectonderwerp

### Technische requirements

#### Views
- [x] Gebruik minstens twee layouts
- [x] Gebruik componenten waar passend
- [x] Gebruik cursus- en oefeningstechnieken

#### Control structures
- [ ] XSS protection
- [ ] CSRF protection
- [ ] Client-side validation

#### Routes
- [ ] Alle routes gebruiken controller methods
- [ ] Routes bevatten benodigde middleware
- [ ] Groepeer routes indien mogelijk

#### Controllers
- [ ] Gebruik controllers voor logica-opdeling
- [ ] Gebruik resource controllers voor CRUD-operaties

#### Models
- [ ] Gebruik Eloquent models per entiteit
- [ ] Maak gebruik van relaties:
  - [ ] Minstens één one-to-many relatie
  - [ ] Minstens één many-to-many relatie

#### Database
- [ ] Database moet werken met `php artisan migrate:fresh --seed`
- [ ] Database bevat alle benodigde basisdata

#### Authentication
- [x] Basisfunctionaliteiten:
  - [x] Log in/out
  - [x] 'Remember me'
  - [x] Registreren
  - [x] Wachtwoord reset bij vergeten wachtwoord
- [x] Voeg één default admin toe (gebruikersnaam: admin, email: admin@ehb.be, wachtwoord: Password!321)

#### Layout
- [x] Zorg voor een duidelijke en professionele layout

#### GIT
- [x] Gebruik een GitHub repo voor het project
- [x] Voeg 'vendor' en 'node_modules' toe aan `.gitignore`
- [x] Voeg een `readme.md` toe met:
  - [ ] Stappen om project te laten werken
  - [ ] Bronvermeldingen
  - [ ] Andere belangrijke projectinformatie

### Inzenden
- [ ] Submit de link naar de GitHub repo via Canvas en zorg voor toegang

