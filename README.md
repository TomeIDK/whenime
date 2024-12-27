## Sources
Manage save button state based on original data: https://chatgpt.com/share/673db74e-7288-800b-b259-63b53fd0dc29  
Jikan Setup: https://chatgpt.com/share/673dd63e-d798-800b-b461-3b882ec0c341  
Auto-add schedule item: https://chatgpt.com/share/67699eec-b664-800b-b8cd-679335d08fc4  
Time settings helper: https://chatgpt.com/share/6769a636-cb00-800b-a3a8-e341f0ff88e8  
XSS, CSRF, Cors Explanation: https://chatgpt.com/share/673fa303-4d44-800b-8bf5-7d8fc91b1d05  
Jikan handler + retryer: https://chatgpt.com/share/676d9631-353c-800b-9344-d4e68fa6850a  



## Documentation

### How to add a new setting
1. Update `config/settings.php` by adding the new setting to the `defaults` array
   ```  
   'defaults' => [
    'timezone' => 'UTC',
    'time_format' => '24h',
    'new_setting' => 'default_value',
    ],  
    ```
2. Run `CreateUserSettings.php` Seeder  
    ```
   php artisan db:seed --class=CreateUserSettings
    ```
3. Update `Settings.php` Model
   ```
   protected $fillable = [
       'user_id', 
       'timezone', 
       'time_format',
       'new_setting',
    ];
   ```
4. If needed, create a database migration
   ```
   php artisan make:migration add_{new_setting}_to_settings_table
   php artisan migrate
   ```

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
- [x] Enkel admins kunnen andere gebruikers verheffen tot admin en deze rechten afnemen
- [x] Enkel admins kunnen manueel een nieuwe gebruiker aanmaken

#### Profielpagina
- [x] Elke gebruiker heeft een publieke profielpagina toegankelijk voor iedereen
- [x] Ingelogde gebruikers kunnen hun eigen data aanpassen
- [x] Profiel bevat de volgende gegevens:
  - [x] Username
  - [x] Verjaardag
  - [x] Profielfoto (op webserver bewaard)
  - [x] "Over mij" tekst

#### Laatste nieuwtjes
- [x] Admins kunnen nieuwsitems toevoegen, wijzigen en verwijderen
- [x] Bezoekers kunnen alle nieuwtjes en een detail per nieuwtje bekijken
- [x] Nieuwsitems bevatten:
  - [x] Titel
  - [x] Afbeelding (opgeslagen op de server)
  - [x] Content
  - [x] Publicatiedatum

#### FAQ pagina
- [x] FAQ-pagina bevat vragen en antwoorden, gegroepeerd per categorie
- [x] Admins kunnen categorieën en vraag/antwoorden toevoegen, wijzigen en verwijderen
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
  - [x] Minstens één one-to-many relatie
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

