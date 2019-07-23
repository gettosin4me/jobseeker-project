# Jobseeker
## guide to installation

1. Download / Clone the project
2. [Install composer] (https://getcomposer.org/download)
3. Run "Composer install"
4. Run migration "./vendor/bin/doctrine-migrations migrate" for database migration
5. Create a .env file on the project root and paste the content below

```
APP_NAME=appName

DB_HOST=localhost
DB_USER=dbUser
DB_PASSWORD=
DB_NAME=dbname
DB_PORT=3306
```
   
6. On browser, goto http://localhost/{folder_name}