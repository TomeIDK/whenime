# Installation
This project was developed using WSL. All necessary steps should be performed within your WSL/Linux environment for a smooth setup.  

**Tip**: Clone the project into a subdirectory of `/home/{user}` to avoid potential debugging issues (e.g., `/home/tome/projects`).

## Prerequisites
Before you begin, ensure the following are installed
1. WSL (if using Windows)
2. Composer
3. Node.js
4. MySQL
5. PHP
6. Git
7. A Mailtrap account for handling emails (Or any email delivery service)

## Installation Guide
### 1. Clone the repository
Navigate to your project directory: `cd /home/{user}/projects`

Clone the repository from GitHub: `git clone https://github.com/TomeIDK/whenime.git`

Navigate to the root of the project: `cd whenime`

### 2. Set up .env
Copy the `.env.example` file to `.env`: `cp .env.example .env`

Edit the .env file and update the following configurations:
- Database Configuration:
 ```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=whenime
DB_USERNAME=root
DB_PASSWORD=<your-db-password>
```
- Mailtrap Configuration:
 ```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<your-mailtrap-username>
MAIL_PASSWORD=<your-mailtrap-password>
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Whenime"
```
### 3. Install dependencies
Install PHP dependencies: `composer install`

Install JavaScript dependencies: `npm install`

### 4. Set up the database
Log in to MySQL: `mysql -u root -p`

Create the database: `CREATE DATABASE whenime;`

Exit MySQL: `exit;`

### 5. Start MySQL Service (if not active)
Start the MySQL service: `sudo systemctl start mysql`  
For older systems: `sudo service mysql start`

Verify that the service is active: `sudo systemctl status mysql`

(Optional) Enable MySQL to start at boot: `sudo systemctl enable mysql`

### 6. Run migrations and seeders
Run the following command to reset, set up, and seed the database: `php artisan migrate:fresh --seed`

### 7. Set up storage link
Create a symbolic link for the `public/storage` directory: `php artisan storage:link`

### 8. Add images
Since some directories are excluded from GIT, copy the following folder from the provided [Google Drive link](https://drive.google.com/drive/folders/1nIdL8oa2bCJejK4eanWbPxFotmmzWcr5?usp=sharing):  
- `news_images`
- `profile_pictures`

Place these folders in `/storage/app/public`

### 9. Start the project
Compile the frontend assets: `npm run dev`

Start the development server: `php artisan serve`

### 11. Verify installation
Open your browser and visit the following URL: [http://127.0.0.1:8000/profile/TomeIDK](http://127.0.0.1:8000/profile/TomeIDK)

Verify that the page loads and everything works as expected.

### Congratulations!
You have successfully installed the project!

# Sources
Manage save button state based on original data: https://chatgpt.com/share/673db74e-7288-800b-b259-63b53fd0dc29  
Jikan Setup: https://chatgpt.com/share/673dd63e-d798-800b-b461-3b882ec0c341  
Auto-add schedule item: https://chatgpt.com/share/67699eec-b664-800b-b8cd-679335d08fc4  
Time settings helper: https://chatgpt.com/share/6769a636-cb00-800b-a3a8-e341f0ff88e8  
XSS, CSRF, Cors Explanation: https://chatgpt.com/share/673fa303-4d44-800b-8bf5-7d8fc91b1d05  
Jikan handler + retryer: https://chatgpt.com/share/676d9631-353c-800b-9344-d4e68fa6850a  

# Features
### Normal user
- Search for anime and filter by airing and upcoming releases only
- Add anime to a schedule
- View news
- View FAQ
- Send a contact form
- Create, edit, delete a schedule
- View and edit your profile
- Change timezone and time format settings

### Admins
- Go to admin dashboard
- Manage users (create, edit profile, delete, promote/demote)
- Manage news (create, edit, delete)
- Manage FAQ (create, edit, delete)
- Manage contact forms (delete, read, change status)


# Documentation

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
