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
