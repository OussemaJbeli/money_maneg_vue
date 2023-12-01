## Requirements
 - PHP 8.2 or higher
 - Node JS 20 or higher

---
## Installation

  This might take awhile but I'm pretty sure this is worth it. So let's get started.

  1. Clone the repository

     ```git clone https://github.com/OussemaJbeli/taleb.git```

  2. Install dependencies

      ```
      composer install
      npm install
      ```
  
  3. Copy .env.example to .env

      ``` cp .env.example .env ```
  
  4. Generate key application

      ``` php artisan key:generate ```
  
  5. Configure your database in .env
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=root
      DB_PASSWORD=
      ```
  6. Run migrations and initial seeder

      ``` php artisan migrate```
  
  7. Run web server 
  
      ``` php artisan serve ```

  8. Run vite server 
  
      ``` npm run dev ```
