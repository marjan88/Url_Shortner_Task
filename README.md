# Url_Shortner_Task

In order to install and run the application, run the following commands:

1. cp .env.example .env

2. fill database credentials in .env

3. composer install

4. npm install 

5. php artisan jwt:secret // it will generate JTW secret key

6. php artisan migrate // it fill run the migrations

7. php -S localhost:8000 -t public // run local server

The url shortner application is build in lumen (php micro framework from Laravel) and Vue js. Client and server a separated.
In the storage folder is the POSTMAN collection. IN the home page, all public links are listed. In order to add new links the user needs to register first and login to the application. 
After that he will be able to add and delete links, making the links public or private. Class for generating short urls is MathBasePattern. The class implements UrlPatternInterface class. 
This aproach is opened for change. Developers only needs to create a new Pattern class that implements UrlPatternInterface and map it in the App\Providers\RepositoryServiceProvider

JSON Web Tokens are used to access restricted endpoints. After the login is successful, server return the token that will be saved in the browser storage and used in every request header.

Links unique ID from the DB is converted from base-10 ID to a base-62 ID. base-62 character locations are shuffled from their standard arrangement.
Short url is saved in the db in the column `code`. Latter that unique code is used to fetch the links from the DB and return its original URL.  
